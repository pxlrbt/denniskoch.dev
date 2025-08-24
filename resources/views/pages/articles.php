<?php
    $title = 'Articles | Dennis Koch';
    $description = 'Freelance Developer specializing in Filament and Laravel for custom web applications. With over 12 years of experience, I create tailored solutions that meet unique business needs.';
    $keywords = 'Freelance Developer, Full-Stack-Developer, Filament, Laravel, PHP, custom web applications, tailored solutions';
?>

<?php include __DIR__.'/../partials/header.php'; ?>

    <div class="section wrapper text-wrap">
        <div class="articles-intro">
            <h1>Articles</h1>

            <a href="/feed" class="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rss"><path d="M4 11a9 9 0 0 1 9 9"></path><path d="M4 4a16 16 0 0 1 16 16"></path><circle cx="5" cy="19" r="1"></circle></svg>
                <span>Feed</span>
            </a>
        </div>

        <div class="articles">
            <?php foreach (\App\Article::all() as $article): ?>
                <article class="article">
                    <time class="badge">
                        <div class="sr-only">Date:</div>

                        <?php echo $article->created_at->format('Y-m-d'); ?>
                    </time>

                    <a
                        href="articles/<?php echo $article->slug; ?>"
                        style="view-transition-name: <?= $article->viewTransitionName(); ?>"
                    >
                        <?php echo $article->title; ?>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>

<?php include __DIR__.'/../partials/footer.php'; ?>
