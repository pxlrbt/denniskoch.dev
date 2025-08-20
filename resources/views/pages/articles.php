<?php
    $title = 'Articles | Dennis Koch';
    $description = 'Freelance Developer specializing in Filament and Laravel for custom web applications. With over 12 years of experience, I create tailored solutions that meet unique business needs.';
    $keywords = 'Freelance Developer, Full-Stack-Developer, Filament, Laravel, PHP, custom web applications, tailored solutions';
?>

<?php include __DIR__.'/../partials/header.php'; ?>

    <div class="section wrapper text-wrap">
        <h1>Articles</h1>

        <div class="articles">
            <?php foreach (\App\Article::all() as $article): ?>
                <article class="article">
                    <time class="badge">
                        <div class="sr-only">Date:</div>

                        <?php echo $article->date->format('Y-m-d'); ?>
                    </time>

                    <a href="articles/<?php echo $article->slug; ?>" target="_blank">
                        <?php echo $article->title; ?>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>

<?php include __DIR__.'/../partials/footer.php'; ?>
