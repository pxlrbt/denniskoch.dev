<?php

    $url = explode('/', parse_url(ltrim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH));
    $article = \App\Article::getBySlug($url[1]);

    if ($article === null) {
        include __DIR__ . '/../pages/404.php';
        exit;
    }

    $title = $article->title . ' | Dennis Koch';
    $description = $article->created_at->format('d.m.Y') .' – '.$article->description;
    $keywords = implode(', ', $article->seo_keywords);
    $seoKeywords = '["'. implode('", "', $article->seo_keywords) . '"]';
    $rootClass = "article-page";

    if ($article->ogImageUrl()) {
        $ogImage = $article->ogImageUrl();
    }

    $head = <<<HTML
        <!-- SEO: Article -->
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "BlogPosting",
                "headline": "{$article->title}",
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
        <article class="article text-wrap">
            <header class="article__header">
                <h1 style="view-transition-name: <?= $article->viewTransitionName(); ?>">
                    <?php echo $article->title; ?>
                </h1>

                <div class="article__meta">
                    <div class="date">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                        <?php echo $article->created_at->format('d.m.Y'); ?>
                        <?php if ($article->created_at != $article->updated_at): ?>
                            &ndash; <?php echo $article->updated_at->format('d.m.Y'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="reading-time">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-timer"><line x1="10" x2="14" y1="2" y2="2"></line><line x1="12" x2="15" y1="14" y2="11"></line><circle cx="12" cy="14" r="8"></circle></svg>
                        <?php echo $article->readingTimeInMinutes(); ?> min read
                    </div>
                    <div class="tags">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle></svg>

                        <div>
                            <?php foreach ($article->tags as $tag): ?>
                                <span class="tag"><?php echo $tag; ?><?php if ($tag !== end($article->tags)): ?>, <?php endif; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </header>


            <div class="rte">
                <?php echo $article->content; ?>
            </div>
        </article>

        <?php if ($article->mastodonUrl): ?>
            <section class="section wrapper">
                <div class="article text-wrap">
                    <?php /*
                    <social-comments mastodon="https://mastodon.social/@medienbaecker/115469440948570127">
                        Loading comments&hellip;
                    </social-comments>
                    */?>

                    <h2>
                        <a class="anchor-link" href="#replies">Replies</a>
                    </h2>

                    <div class="mastodon-comments" data-mastodon-url="<?= $article->mastodonUrl ?>">
                        <p>Loading replies&hellip;</p>
                    </div>

                    <a href="<?= $article->mastodonUrl ?>" class="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.19 12.195c2.016-.24 3.77-1.475 3.99-2.603.348-1.778.32-4.339.32-4.339 0-3.47-2.286-4.488-2.286-4.488C12.062.238 10.083.017 8.027 0h-.05C5.92.017 3.942.238 2.79.765c0 0-2.285 1.017-2.285 4.488l-.002.662c-.004.64-.007 1.35.011 2.091.083 3.394.626 6.74 3.78 7.57 1.454.383 2.703.463 3.709.408 1.823-.1 2.847-.647 2.847-.647l-.06-1.317s-1.303.41-2.767.36c-1.45-.05-2.98-.156-3.215-1.928a4 4 0 0 1-.033-.496s1.424.346 3.228.428c1.103.05 2.137-.064 3.188-.189zm1.613-2.47H11.13v-4.08c0-.859-.364-1.295-1.091-1.295-.804 0-1.207.517-1.207 1.541v2.233H7.168V5.89c0-1.024-.403-1.541-1.207-1.541-.727 0-1.091.436-1.091 1.296v4.079H3.197V5.522q0-1.288.66-2.046c.456-.505 1.052-.764 1.793-.764.856 0 1.504.328 1.933.983L8 4.39l.417-.695c.429-.655 1.077-.983 1.934-.983.74 0 1.336.259 1.791.764q.662.757.661 2.046z" />
                        </svg>
                        Reply on Mastodon
                    </a>
                </div>
            </section>
        <?php endif; ?>
    </div>




<?php include __DIR__.'/../partials/footer.php'; ?>
