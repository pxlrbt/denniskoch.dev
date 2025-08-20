<?php
    http_response_code(404);

    $title = 'Not Found | Dennis Koch';
    $description = 'Freelance Developer specializing in Filament and Laravel for custom web applications. With over 12 years of experience, I create tailored solutions that meet unique business needs.';
    $keywords = 'Freelance Developer, Full-Stack-Developer, Filament, Laravel, PHP, custom web applications, tailored solutions';
    $canonical = 'https://denniskoch.dev/articles.php';
?>

<?php include __DIR__ . '/../partials/header.php'; ?>

    <div class="section wrapper text-wrap" style="text-align: center">
        <h1>Page Not Found</h1>

        <p>
            <img
                src="/assets/images/404.webp"
                alt="Gif of John Travolta looking around confused"
                style="margin-inline: auto"
            >
        </p>

        <p>
            <blockquote cite="https://www.w3.org/Provider/Style/URI.html">
                <em>"Cool URIs don't change."</em>
                <span>– Tim Berners-Lee</span>
            </blockquote>

            But it seems I messed up, and now you are here.<br>
            I apologize for that!
        </p>
        <p>
            <a href="/" class="button">Back to home</a>
        </p>
    </div>

<?php include __DIR__.'/../partials/footer.php'; ?>
