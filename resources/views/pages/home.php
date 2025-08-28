<?php

    use App\Article;
    use App\Project;

    $title = 'Dennis Koch | Freelance Full-Stack-Developer';
    $description = 'Freelance Developer specializing in Filament and Laravel for custom web applications. With over 12 years of experience, I create tailored solutions that meet unique business needs.';
    $keywords = 'Freelance Developer, Full-Stack-Developer, Filament, Laravel, PHP, custom web applications, tailored solutions';

    $projects = Project::all();

    $splitIndex = round(count($projects) / 2);
    $projectTrackA = array_slice($projects, 0, $splitIndex);
    $projectTrackB = array_slice($projects, $splitIndex, count($projects));

    $projectTrackA = [...$projectTrackA, ...$projectTrackA];
    $projectTrackB = [...$projectTrackB, ...$projectTrackB];

    $articles = Article::get(limit: 5);
?>

<?php include __DIR__.'/../partials/header.php'; ?>

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
                        developing <em>custom web applications with Filament and Laravel</em>. Over the last <em>12 years</em> I worked
                        together with various clients to create tailored solutions that meet their unique needs.
                    </p>

                    <p>
                        I've created and maintain several <a href="/projects#packages">open source packages</a> for Filament and Laravel which you can find on my <a href="https://github.com/pxlrbt">GitHub</a>.
                        As a core team member of <a href="https://filamentphp.com">Filament</a> you'll often find me hanging out on their Discord server, helping others in the #help channel.
                    </p>
                </div>
            </div>
            <div class="about__image">
                <img src="./assets/images/dennis-koch.webp" alt="">

                <?php include __DIR__.'/../partials/social-icons.php'; ?>
            </div>
        </div>
    </div>

    <section class="section wrapper projects-grid" id="projects">
        <h2>Projects</h2>

        <div class="intro">
            <div class="text-wrap">
                <p>
                    A sneak peek into my public projects, featuring open source Filament and Laravel packages,
                    as well as premium Filament plugins.
                </p>
            </div>

            <a href="/projects#packages" class="button">See All Packages</a>
        </div>

        <div class="full-bleed marquee">
            <div class="marquee__track" style="--nr-projects: <?= count($projectTrackA); ?>; --speed: <?= (2 * count($projectTrackA)) .'s'; ?> ">
                <?php foreach ($projectTrackA as $project): ?>
                    <span class="project">
                        <img src="<?= $project->image ?>" alt="<?= $project->name ?>">
                    </span>
                <?php endforeach; ?>
            </div>

            <div class="marquee__track" style="--nr-projects: <?= count($projectTrackB);  ?>; --speed: <?= (2 * count($projectTrackB)) .'s'; ?>">
                <?php foreach ($projectTrackB as $project): ?>
                    <span class="project">
                        <img src="<?= $project->image ?>" alt="<?= $project->name ?>">
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section wrapper articles" id="articles">
        <h2>Latest Articles</h2>

        <div class="articles__list">
            <?php foreach ($articles as $article): ?>
                <article class="article">
                    <a href="articles/<?php echo $article->slug; ?>">
                        <?php echo $article->title; ?>
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
    </section>

    <section class="section">
        <div class="wrapper">
            <h2>Working With</h2>

            <div class="partners">
                <span><a href="https://studiosterz.com" target="_blank">Studio Sterz</a></span>
                <span><a href="https://leitsch.org" target="_blank">Lukas Leitsch</a></span>
                <span><a href="https://koch-it-solutions.de" target="_blank">KOCH IT Solutions</a></span>
                <span><a href="https://bluedom.swiss" target="_blank">blueDOM</a></span>
            </div>
        </div>
    </section>

<?php include __DIR__.'/../partials/footer.php'; ?>
