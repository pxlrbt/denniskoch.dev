<?php

    $url = explode('/', parse_url(ltrim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH));
    $article = \App\Article::getBySlug($url[1]);

    if ($article === null) {
        include __DIR__ . '/../pages/404.php';
        exit;
    }

    $title = $article->title . ' | Dennis Koch';
    $description = 'Freelance Developer specializing in Filament and Laravel for custom web applications. With over 12 years of experience, I create tailored solutions that meet unique business needs.';
    $keywords = 'Freelance Developer, Full-Stack-Developer, Filament, Laravel, PHP, custom web applications, tailored solutions';

    $seoKeywords = '["'. implode('", "', $article->keywords) . '"]';

    $head = <<<HTML
        <!-- SEO: Article -->
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "BlogPosting",
                "headline": "{$article->title}",
                "editor": "Dennis Koch",
                "wordcount": "{$article->wordCount()}",
                "timeRequired": "{$article->readingTimeInMinutes()} minutes",
                "keywords": {$seoKeywords},
                "url": "http://denniskoch.dev/articles/{$article->slug}",
                "datePublished": "{$article->created_at->format('Y-m-d')}",
                "dateCreated": "{$article->created_at->format('Y-m-d')}",
                "dateModified": "{$article->updated_at->format('Y-m-d')}",
                "description": "{$article->description}",
                "author": {
                    "@type": "Person",
                    "name": "Dennis Koch"
                }
            }
            </script>
        HTML;
?>

<?php include __DIR__.'/../partials/header.php'; ?>

    <div class="section wrapper">
        <article class="article-page text-wrap">
            <time class="badge">
                <div class="sr-only">Date:</div>

                <?php echo $article->created_at->format('Y-m-d'); ?>
            </time>
            <h1>
                <?php echo $article->title; ?>
            </h1>


            <div class="rte">
                <?php echo $article->content; ?>
            </div>
        </article>
    </div>

<?php include __DIR__.'/../partials/footer.php'; ?>
