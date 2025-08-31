<!doctype html>
<html lang="en" class="<?= $rootClass ?? ''; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale= 1.0">

    <title><?php echo $title ?? 'Dennis Koch | Freelance Full-Stack-Developer'; ?></title>

    <meta name="description" content="<?php echo $description ?? 'Freelance Developer specializing in Filament and Laravel for custom web applications. With over 12 years of experience, I create tailored solutions that meet unique business needs.'; ?>">
    <meta name="keywords" content="<?php echo $keywords ?? 'Freelance Developer, Full-Stack-Developer, Filament, Laravel, PHP, custom web applications, tailored solutions'; ?>">

    <meta property="og:image" content="<?= $ogImage ?? '/assets/images/og.webp'; ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">

    <meta name="fediverse:creator" content="@denniskoch@phpc.social">
    <meta name="author" content="Dennis Koch">
    <meta name="robots" content="<?php echo $robots ?? 'index, follow'; ?>">
    <meta name="theme-color" content="rgba(25.021, 56.75, 72.545)">

    <link rel="icon" type="image/svg+xml" href="https://denniskoch.dev/favicon.svg" />
    <link rel="me" href="https://phpc.social/@denniskoch">
    <link rel="preload" href="/assets/fonts/Satoshi-Black.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/outfit-v11-latin-300.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/outfit-v11-latin-500.woff2" as="font" type="font/woff2" crossorigin>

    <link rel="stylesheet" href="/assets/main.css?v=<?= filemtime(__DIR__.'/../../../public/assets/main.css') ?>">

    <!-- RSS -->
    <link rel="alternate" type="application/atom+xml" title="Articles" href="/feed">

    <!-- SEO: Me -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Person",
            "name": "Dennis Koch",
            "url": "https://denniskoch.dev",
            "image": "https://denniskoch.dev/assets/images/dennis-koch.webp",
            "gender": "male",
            "nationality": "German",
            "description": "Freelance Full-Stack Developer specializing in Filament and Laravel for custom web applications.",
            "jobTitle": "Full-Stack Developer",
            "sameAs": [
                "https://phpc.social/@denniskoch",
                "https://github.com/pxlrbt",
                "https://www.linkedin.com/in/dennis-koch-a764031bb/"
            ],
            "worksFor": {
                "@type": "Organization",
                "name": "pixelarbeit",
                "url": "https://pixelarbeit.de"
            },
            "knowsLanguage": [
                "German",
                "English"
            ],
            "knowsAbout": [
                "Laravel",
                "FilamentPHP",
                "PHP",
                "JavaScript",
                "MySQL",
                "PostgreSQL",
                "HTML",
                "CSS",
                "TailwindCSS"
            ]
        }
    </script>

    <?php
        if (isset($head)) {
            echo $head;
        }
    ?>

    <?php if($_SERVER['SERVER_NAME'] === 'denniskoch.dev.test'): ?>
        <!-- Browsersync script for development -->
        <script id="__bs_script__">
            document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js'><\/script>".replace("HOST", location.hostname));
        </script>
    <?php else: ?>
        <script
            defer
            src="/stats.js"
            data-website-id="9a996427-0dea-49b7-98ee-9bda77af0960"
            data-host-url="https://cloud.umami.is"
        ></script>
    <?php endif; ?>
</head>

<body>
    <a href="#content" class="skip-link">Skip to content</a>

    <header class="header">
        <div class="wrapper">
            <nav aria-label="Main Navigation">
                <a href="/" class="logo">
                    <svg xmlns="http://www.w3.org/2000/svg" class="logo-icon" viewBox="0 0 113 98">
                      <path fill="#FF9F5F" d="M97.95 31.4v-7.8c0-2.7.563-4 4.05-4h10.238v-18h-14.4c-14.85 0-23.288 7.7-23.288 21.1v8.4c0 5-.563 7.4-12.487 7.4H61.05v19.8h1.013c11.362.2 12.487 2.3 12.487 7.4v8.7c0 17.3 12.6 20.9 23.175 20.9h14.625V77.7h-9.787c-4.276 0-4.613-2.1-4.613-4.5v-7.7c0-7.4-1.237-15.1-9.9-17.6 9.112-3.1 9.9-9.6 9.9-16.5ZM1.875.1.75 0v20.2l.9.1c15.075 2.6 26.1 14.5 26.1 28.2S16.837 74.1 1.65 76.7l-.9.1v20.3l1.125-.1C29.55 94.6 51.15 73.3 51.15 48.6c0-24.8-21.6-46.1-49.275-48.5Z"/>
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" class="logo-full" viewBox="0 0 373 53">
                      <path fill="#fff" d="M77.8 47.2V5.8c0-.6.3-.9.8-.9h15c10 0 16.3 5.4 16.3 16v11.5c0 10.5-6.3 15.8-16.3 15.8h-15c-.5-.1-.8-.4-.8-1Zm15.9-5.9c5.8 0 8.8-2.8 8.8-8.9V20.8c0-6.2-3-9.2-8.8-9.2h-8.5v29.7h8.5Zm46.1-5.9h-18.4v1.7c0 3.7 2.5 5.6 6.4 5.6 3.8 0 6.3-1.3 8.5-2.8.4-.3.9-.2 1.2.2l2.5 3.3c.4.4.3.9-.2 1.3-3.2 2.5-7.1 4.2-12.3 4.2-6.8 0-13.3-3.8-13.3-11.8v-8.6c0-8.9 6.7-12.4 13.3-12.4 6.6 0 13.1 3.5 13.1 12.4v6.1c.1.5-.2.8-.8.8Zm-12.2-13.2c-3.6 0-6.2 1.7-6.2 6.2V30h12.5v-1.6c-.1-4.4-2.9-6.2-6.3-6.2Zm17 25V19.5c0-.5.2-.8.7-1.1 3.5-1.5 7.7-2.4 12-2.4 8.4 0 14 3.9 14 13.6v17.6c0 .6-.3.9-.8.9h-5.2c-.5 0-.9-.3-.9-.9V29.7c0-5.7-2.6-7.4-7-7.4-2.1 0-4.3.3-5.7.7v24.2c0 .6-.3.9-.9.9h-5.2c-.7 0-1-.3-1-.9Zm31.6 0V19.5c0-.5.2-.8.7-1.1 3.5-1.5 7.7-2.4 12-2.4 8.4 0 14 3.9 14 13.6v17.6c0 .6-.3.9-.8.9h-5.3c-.5 0-.9-.3-.9-.9V29.7c0-5.7-2.6-7.4-7-7.4-2.1 0-4.3.3-5.7.7v24.2c0 .6-.3.9-.9.9h-5.2c-.6 0-.9-.3-.9-.9Zm35.1-34.7c-2.2 0-4-1.8-4-4 0-2.3 1.8-3.9 4-3.9 2.3 0 3.9 1.6 3.9 3.9.1 2.3-1.6 4-3.9 4Zm-3.5 34.7V17.6c0-.5.4-.8.9-.8h5.3c.5 0 .8.3.8.8v29.6c0 .6-.3.9-.8.9h-5.3c-.6 0-.9-.3-.9-.9Zm23.1 1.6c-4.1 0-8.5-1.1-12.3-3.9-.5-.3-.5-.7-.2-1.2l2.3-3.9c.3-.5.7-.6 1.2-.2 2.7 2 6 3.1 9.1 3.1 3.1 0 5.6-1.2 5.6-3.5 0-2.4-2.9-3.1-5.6-3.6-4.5-.8-12.2-2.7-12.2-10 0-6.7 6.4-9.5 12.8-9.5 3.5 0 7 .8 10.5 2.8.5.2.6.7.3 1.2l-2.3 3.9c-.3.4-.7.5-1.2.3-2.2-1.2-5-2-7.7-2-3.6 0-5.5 1.3-5.5 3.3 0 2.5 2.7 3.1 6.7 3.9 5 .9 11.3 2.5 11.3 9.4 0 6.7-5.5 9.9-12.8 9.9Zm23.1-1.6V5.8c0-.6.3-.9.8-.9h5.6c.5 0 .8.3.8.9v17.5l15.1-17.9c.4-.4.7-.5 1.1-.5h7.1c.8 0 1 .5.5 1.1l-16 18.2 17.4 22.9c.5.6.1 1.1-.5 1.1h-7.1c-.5 0-.8-.1-1.1-.5l-13.5-18.2-3 3.3v14.5c0 .6-.3.9-.8.9h-5.6c-.5-.1-.8-.4-.8-1Zm46.9 1.6c-8.4 0-13.8-4.7-13.8-12.2v-8.1c0-7.6 5.4-12.5 13.8-12.5s13.8 4.8 13.8 12.5v8.1c-.1 7.5-5.5 12.2-13.8 12.2Zm0-6.3c4.3 0 6.7-2.1 6.7-5.9v-8.1c0-4-2.4-6.2-6.7-6.2-4.4 0-6.7 2.2-6.7 6.2v8.1c-.1 3.9 2.3 5.9 6.7 5.9Zm30.7 6.3c-8.5 0-13.6-4.8-13.6-12.2v-8.4c0-7.4 5.1-12.2 13.5-12.2 3.5 0 6.8 1 9.9 2.9.5.3.5.8.2 1.3l-2.4 3.6c-.3.4-.7.5-1.3.2-1.9-1.1-4.1-1.8-6.4-1.8-4.3 0-6.7 2.1-6.7 5.9v8.5c0 3.8 2.4 5.9 6.6 5.9 2.3 0 4.8-.7 7-2.2.5-.3 1-.3 1.3.2l2.5 3.6c.3.5.3.8-.2 1.2-2.8 2.3-6.2 3.5-10.4 3.5ZM359.4 16c7.4 0 13.2 3.9 13.2 13.7v17.5c0 .6-.3.9-.8.9h-5.3c-.5 0-.9-.3-.9-.9V29.9c0-5.8-2.4-7.6-6.9-7.6-2.2 0-4.4.4-5.8 1.1v23.8c0 .6-.3.9-.9.9h-5.2c-.6 0-.9-.3-.9-.9V5.8c0-.6.3-.9.9-.9h5.2c.6 0 .9.3.9.9v11.3c1.7-.6 3.9-1.1 6.5-1.1Z"/>
                      <path fill="#FF9F5F" d="M47.1 17.2V13c0-1.4.3-2.2 1.9-2.2h5V1h-7c-7.2 0-11.3 4.2-11.3 11.5v4.6c0 2.7-.3 4.1-6.1 4.1h-.5V32h.5c5.5.1 6.1 1.2 6.1 4v4.7c0 9.4 6.1 11.4 11.2 11.4H54v-9.7h-4.6c-2.1 0-2.3-1.2-2.3-2.5v-4.2c0-4-.6-8.2-4.8-9.6 4.4-1.6 4.8-5.1 4.8-8.9ZM.6.1 0 0v11l.4.1C7.7 12.5 13 19 13 26.5S7.7 40.4.4 41.9L0 42v11l.6-.1C14 51.6 24.5 40 24.5 26.5 24.5 13 14 1.4.6.1Z"/>
                    </svg>
                </a>

                <ul>
                    <li><a href="/" class="<?php echo ($uri === '/') ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="/articles" class="<?php echo (str_starts_with($uri, '/articles')) ? 'active' : ''; ?>">Articles</a></li>
                    <li><a href="/projects" class="<?php echo ($uri === '/projects') ? 'active' : ''; ?>">Projects</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main id="content">
