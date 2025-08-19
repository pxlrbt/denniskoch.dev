<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg" />
    <link rel="me" href="https://phpc.social/@denniskoch">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale= 1.0">

    <link href="/dist/main.css" rel="stylesheet">

    <title><?php echo $title ?? 'Dennis Koch | Freelance Full-Stack-Developer'; ?></title>

    <meta name="description" content="<?php echo $description ?? 'Freelance Developer specializing in Filament and Laravel for custom web applications. With over 12 years of experience, I create tailored solutions that meet unique business needs.'; ?>">
    <meta name="keywords" content="<?php echo $keywords ?? 'Freelance Developer, Full-Stack-Developer, Filament, Laravel, PHP, custom web applications, tailored solutions'; ?>">

    <meta name="fediverse:creator" content="@denniskoch@phpc.social">

    <meta name="author" content="Dennis Koch">
    <meta name="robots" content="<?php echo $robots ?? 'index, follow'; ?>">
    <meta name="theme-color" content="rgba(25.021, 56.75, 72.545)">

    <script
        defer
        src="/stats.js"
        data-website-id="9a996427-0dea-49b7-98ee-9bda77af0960"
        data-host-url="https://cloud.umami.is"
    ></script>

    <?php if($_SERVER['SERVER_NAME'] === 'denniskoch.dev.test'): ?>
        <!-- Browsersync script for development -->
        <script id="__bs_script__">
            document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js'><\/script>".replace("HOST", location.hostname));
        </script>
    <?php endif; ?>
</head>

<body>
    <header>
        <div class="wrapper">
            <nav aria-label="Main Navigation">
                <a href="/" class="logo">
                    <em>Dennis Koch</em>
                </a>

                <ul>
                    <li><a href="/" class="<?php echo ($uri === '/') ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="/articles" class="<?php echo (str_starts_with($uri, '/articles')) ? 'active' : ''; ?>">Articles</a></li>
                    <li><a href="/projects" class="<?php echo ($uri === '/projects') ? 'active' : ''; ?>">Projects</a></li>
                </ul>
            </nav>
        </div>
    </header>
