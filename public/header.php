<!doctype html>
<html lang="<?php echo $lang ?? 'en'; ?>">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="/src/images/favicon.svg" />
    <link rel="me" href="https://phpc.social/@denniskoch">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale= 1.0">

    <link href="dist/main.css" rel="stylesheet">

    <title><?php echo $title ?? 'Dennis Koch | Freelance Full-Stack-Developer'; ?></title>

    <meta name="description" content="<?php echo $description ?? 'Freelance Developer specializing in Filament and Laravel for custom web applications. With over 12 years of experience, I create tailored solutions that meet unique business needs.'; ?>">
    <meta name="keywords" content="<?php echo $keywords ?? 'Freelance Developer, Full-Stack-Developer, Filament, Laravel, PHP, custom web applications, tailored solutions'; ?>">

    <?php if (isset($fediverse_creator)): ?>
    <meta name="fediverse:creator" content="<?php echo $fediverse_creator; ?>">
    <?php endif; ?>
    <meta rel="canonical" href="<?php echo $canonical ?? 'https://denniskoch.dev'; ?>">

    <meta name="author" content="Dennis Koch">
    <meta name="robots" content="<?php echo $robots ?? 'index, follow'; ?>">
    <meta name="theme-color" content="rgba(25.021, 56.75, 72.545)">

    <script
        defer
        src="stats.js"
        data-website-id="9a996427-0dea-49b7-98ee-9bda77af0960"
        data-host-url="https://cloud.umami.is"
    ></script>

    <!-- Browsersync script for development -->
    <script id="__bs_script__">
        document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js'><\/script>".replace("HOST", location.hostname));
    </script>
</head>

<body>