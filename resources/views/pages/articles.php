<?php
    $title = 'Articles | Dennis Koch';
    $description = 'Freelance Developer specializing in Filament and Laravel for custom web applications. With over 12 years of experience, I create tailored solutions that meet unique business needs.';
    $keywords = 'Freelance Developer, Full-Stack-Developer, Filament, Laravel, PHP, custom web applications, tailored solutions';
?>

<?php include __DIR__.'/../partials/header.php'; ?>

    <div class="section wrapper articles">
        <div class="articles__intro">
            <h1>Articles</h1>

            <a href="/feed" class="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rss"><path d="M4 11a9 9 0 0 1 9 9"></path><path d="M4 4a16 16 0 0 1 16 16"></path><circle cx="5" cy="19" r="1"></circle></svg>
                <span>Feed</span>
            </a>
        </div>

        <div class="articles__list">
            <?php foreach (\App\Article::all() as $article): ?>
                <article class="article">
                    <a
                        href="articles/<?php echo $article->slug; ?>"
                    >
                    <span style="view-transition-name: <?= $article->viewTransitionName(); ?>">
                        <?php echo $article->title; ?>
                    </span>
                    </a>

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
                </article>
            <?php endforeach; ?>
        </div>
    </div>

<?php include __DIR__.'/../partials/footer.php'; ?>
