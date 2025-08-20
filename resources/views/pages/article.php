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
?>

<?php include __DIR__.'/../partials/header.php'; ?>

    <div class="section wrapper">
        <article class="article-page text-wrap">
            <time class="badge">
                <div class="sr-only">Date:</div>

                <?php echo $article->date->format('Y-m-d'); ?>
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
