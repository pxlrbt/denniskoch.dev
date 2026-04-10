---
title: "\"We have Tinkerwell at home\""
description: Tinker with your Laravel applications directly from PhpStorm without any plugins
tags: [ "Laravel", "PhpStorm" ]
seo_keywords: [ "Laravel", "Tinker", "Tinkerwell", "PhpStorm" ]
created_at: 2026-04-10
updated_at: 2026-04-10
mastodon_url: https://phpc.social/@denniskoch/116380498244669980
status: ready
---

## Tinkering in Laravel

Since I started using Laravel, it has included the `tinker` command, a REPL shell for PHP with the Laravel application booted. It's the fastest way to run one-off code in your Laravel codebase, such as Eloquent queries. However, it lacks autocompletion and other useful features from your IDE.

For nearly as long, Beyond Code has been developing the [Tinkerwell](https://tinkerwell.app) app. This app offers the same concept but as a separate application. Its benefits include easier code editing and no need to reload the REPL shell after making changes to your codebase. Over the years, Tinkerwell has evolved into a small editor with autocompletion, a separate output pane, support for SSH, Docker, Laravel Vapor, and more, along with history, saved snippets, and other features.

I used Tinkerwell regularly and particularly appreciated the SSH feature and saved snippets for quickly exporting statistics from production applications. However, I was never fond of its autocompletion and missed my keybindings from PhpStorm.

## Tinkering in PhpStorm

At one point, I discovered the [Tinkerwell plugin for PhpStorm](https://plugins.jetbrains.com/plugin/13347-tinkerwell). Despite the less-than-promising reviews, it worked well for me, allowing me to enjoy the best of both worlds: tinkering directly from PhpStorm and switching to Tinkerwell for SSH tinkering.

Eventually, I didn't use the SSH feature that much anymore. Since I was using Tinkerwell exclusively from PhpStorm, I let my license expire. I tried the free [Laravel Tinker](https://plugins.jetbrains.com/plugin/14957-laravel-tinker) plugin, which worked great, but I disliked that it created a `.tinker` folder in my project.

## PhpStorm's Scratch Files

PhpStorm has its own "tinker" feature: Scratch files. I often use them for testing HTTP requests or vanilla PHP code, so I wondered if I could use them for tinkering within the Laravel application as well.

Before running any Laravel code, you need to require the vendor files and bootstrap the application.

```php
// Bootstrap
require '/Users/dkoch/Code/jobstartboerse-2025/vendor/autoload.php';
$app = require '/Users/dkoch/Code/jobstartboerse-2025/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Run your code
```

You can then run any code by clicking the play icon in PhpStorm's top bar.

As a developer, I was reluctant to use my mouse to click that little icon after every change. Additionally, remembering and typing that bootstrap code each time I wanted to tinker was annoying. Fortunately, there's a solution for both issues.

## "We Have Tinkerwell at Home"

Let's address the mouse issue first. In `Settings > Keymap`, you can configure a keybinding for `Run`. I mapped mine to `⌘ + ENTER`. That's all it takes.

To avoid forgetting that code snippet, we can use another PhpStorm feature called Live Templates. Go to `Settings > Editor > Live Template` and create one for PHP. I named mine `tinker`. Add this content:

```php
// Bootstrap
require '$PROJECT_PATH$/vendor/autoload.php';
$app = require '$PROJECT_PATH$/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Run your code
$END$
```

Then click `Edit Variables` and add `PROJECT_PATH` with the value `groovyScript("_editor.getProject().getBasePath()")`, and check the box for "Skip if defined". Apply your settings, and you are ready to tinker in PhpStorm.

![Video demonstrating tinkering in PhpStorm](/assets/images/articles/2027-01-23-you-might-not-need-tinkwell/demo.mp4)

## Wrapping Up

Tinkerwell is an excellent app and worth every penny if you use it regularly, especially with its advanced features. However, it's always great to explore what PhpStorm already offers out of the box. If you don't need the advanced features and prefer working in PhpStorm, this might be the right choice for you.
