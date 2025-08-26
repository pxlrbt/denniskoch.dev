---
title: Fixing Herd with Xdebug forever
description: A short journey into debugging Xdebug issues with Laravel Herd and Fish shell
tags: [ "Herd", "Xdebug" ]
seo_keywords: [ "Herd", "Xdebug", "PHP", "macOS" ]
created_at: 2025-08-19
updated_at: 2025-08-26
---

## My Xdebug Setup Broke &hellip; Again

Every now and then my Xdebug setup stops working. Initially, I blamed Xdebug. However, I could still debug the app through the browser. Running PHP scripts on CLI via `herd debug` or just `XDEBUG_SESSION=1 php` didn't work. I checked every PhpStorm setting for Xdebug and deleted some server configs that had previously caused issues, but nothing worked.

Eventually, I googled for Laravel Herd issues but didn't find one immediately. I checked the Herd documentation again, and everything seemed properly configured. Somehow, I stumbled on an issue I didn't find before, which felt way too familiar. It was about issues with the **Fish shell** that I am using and I recalled that I had fixed this exact problem a year ago.

## So What Happened?

Herd configures the directory where PHP looks for ini files via environment variables and automatically adds them to macOS's default shell, "zsh". With Fish shell, you need set these variables manually. I had done this, but each version has its own environment var, and since PHP8.4 was new, that variable wasn't configured. Therefore, it wasn't loading my properly configured ini files.

## The Quick Fix

I quickly opened my Fish config and added the environment var for PHP 8.4:

```shell
HERD_PHP_84_INI_SCAN_DIR "$HOME/Library/Application Support/Herd/config/php/84/
```

However, I had encountered this issue in the past, and I didn't want to debug this again in a year when PHP8.5 is released. So, I decided to fix it permanently:

```shell
set -x HERD_PHP_85_INI_SCAN_DIR "$HOME/Library/Application Support/Herd/config/php/85/"
set -x HERD_PHP_86_INI_SCAN_DIR "$HOME/Library/Application Support/Herd/config/php/86/"
set -x HERD_PHP_87_INI_SCAN_DIR "$HOME/Library/Application Support/Herd/config/php/87/"
set -x HERD_PHP_88_INI_SCAN_DIR "$HOME/Library/Application Support/Herd/config/php/88/"
set -x HERD_PHP_89_INI_SCAN_DIR "$HOME/Library/Application Support/Herd/config/php/89/"
set -x HERD_PHP_90_INI_SCAN_DIR "$HOME/Library/Application Support/Herd/config/php/90/"
set -x HERD_PHP_91_INI_SCAN_DIR "$HOME/Library/Application Support/Herd/config/php/91/"
```

That should give me some years of peace!

## The Better Solution

While that quick fix works, and I could even add more version to be safe for even longer, it feels dirty. Fortunately, you can use commands and loops inside the config file, so this will fix it forever (hopefully 🤞🏽)

```shell
for version_dir in "$HOME/Library/Application Support/Herd/config/php/"*/
    set php_version (basename $version_dir)

    if test $php_version != ""
        set -x HERD_$php_version\_INI_SCAN_DIR "$HOME/Library/Application Support/Herd/config/php/$php_version/"
    end
end
```

## Changelog

26.08.2025: Removed the "Bonus" section because it only worked with Herd CLI, but not through FPM.
