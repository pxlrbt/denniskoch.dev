<?php
    $title = 'Dennis Koch | Freelance Full-Stack-Developer';
    $description = 'Freelance Developer specializing in Filament and Laravel for custom web applications. With over 12 years of experience, I create tailored solutions that meet unique business needs.';
    $keywords = 'Freelance Developer, Full-Stack-Developer, Filament, Laravel, PHP, custom web applications, tailored solutions';
?>

<?php include __DIR__.'/../partials/header.php'; ?>

    <main>
        <div class="section about">
            <div class="wrapper about__inner">
                <div class="about__content">
                    <div class="text-wrap">
                        <h1>
                            Dennis Koch<br>
                            <small>Freelance Full-Stack Developer</small>
                        </h1>

                        <p>
                            As a full-stack developer I specialize in
                            developing custom web applications with <strong>Filament and Laravel</strong>. Over the last <strong>12 years</strong> I worked
                            together with various clients to create tailored solutions that meet their unique needs.
                        </p>

                        <p>
                            I've created several open source packages for Filament and Laravel which you can find on my <a href="https://github.com/pxlrbt">GitHub</a>.
                            As a core team member of <a href="https://filamentphp.com">Filament</a> you'll often find me hanging out on their Discord server, helping others in the #help channel.
                        </p>
                    </div>
                </div>
                <div class="about__image">
                    <img src="./assets/images/dennis-koch.jpg" alt="">

                    <?php include __DIR__.'/../partials/social-icons.php'; ?>
                </div>
            </div>
        </div>
    </main>

<?php include __DIR__.'/../partials/footer.php'; ?>
