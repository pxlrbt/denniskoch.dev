---
title: Laravel Boost for Package Development
description: Learn how to configure Laravel Boost with Orchestra Testbench and Workbench for AI-powered Laravel package development. Includes path fixes and MCP server setup
tags: [ "Laravel" ]
seo_keywords: [ "Laravel Boost", "Laravel Package Development", "Laravel Testbench", "Laravel Workbench", "Claude Code Laravel", "orchestral/testbench", "orchestral/workbench", "AI" ]
created_at: 2026-01-26
updated_at: 2026-01-26
mastodon_url: https://phpc.social/@denniskoch/115961212273853138
---

## The Problem

When using AI agents like Claude Code, [Laravel Boost](https://github.com/laravel/boost/) is an essential tool. It's easy to install, offers MCP servers for Laravel and Herd, and provides guidelines for installed Composer packages for AI.

However, while [Testbench](https://packages.tools/testbench) allows you to run Laravel commands via a bundled Laravel app, Laravel Boost does not work out of the box. The problem occurs because Boost looks for files in the bundled app folder `vendor/orchestra/testbench-core/laravel` instead of the package folder.

I explored the source code and found a slightly hacky workaround.

In this example, I am using [Workbench](https://packages.tools/workbench.html) from Testbench. It provides a partial Laravel app skeleton in your package folder, which integrates with the Testbench core.

## Solution

### Fixing Paths for Laravel Boost Commands

Laravel Boost uses `base_path()` in many places. I tried to overwrite the base path globally, but since Testbench lives in the vendor folder, this would break other functionalities. I considered replacing some components, but that would result in numerous overwritten classes, which I wanted to avoid.

Fortunately, it seems that changing the base path only for the Boost commands works. Additionally, we need to adjust the path to `CLAUDE.md`, as the default is a relative path. We can hook into the command execution via the `CommandStarting` event and modify the necessary paths. Place this in a `ServiceProvider` like the `WorkbenchServiceProvider`:

```php
Event::listen(CommandStarting::class, function ($event) {
    if (str_starts_with($event->command, 'boost:')) {
        // Make sure this actually points to your package root!
        app()->setBasePath(realpath(__DIR__.'/../../../'));
        app()->useAppPath(base_path('src'));

        config()->set('boost.code_environments.claude_code.guidelines_path', base_path('CLAUDE.md'));
    }
});
```

### Fixing MCP Servers Support

When installing the MCP servers, Laravel Boost points to the `artisan` file. Initially, I thought about changing the `.mcp.json` config, but it still contains references to `artisan`. Therefore, we need to create that file and pass the commands through to Testbench. Fortunately, someone has already addressed this and shared the solution on [GitHub](https://github.com/laravel/boost/issues/366#issuecomment-3617492581):

```php
#!/usr/bin/env php
<?php

// Set cache driver to array to avoid database connection
putenv('CACHE_STORE=array');
$_ENV['CACHE_STORE'] = 'array';

// Get the path to Testbench
$testbenchPath = __DIR__ . '/vendor/bin/testbench';

// Check if Testbench exists
if (!file_exists($testbenchPath)) {
    fwrite(STDERR, "Error: vendor/bin/testbench not found. Run 'composer install' first.\n");
    exit(1);
}

// Get all command line arguments (skip script name)
$args = array_slice($argv, 1);

// Build the command
$command = escapeshellarg($testbenchPath);
if (!empty($args)) {
    $command .= ' ' . implode(' ', array_map('escapeshellarg', $args));
}

// Execute and pass through exit code
passthru($command, $exitCode);
exit($exitCode);
```

## Wrapping Up

Laravel Boost should now generate guidelines for the correct packages and communicate with the MCP servers properly. The solution feels a bit fragile, so let's hope for official support in the future.
