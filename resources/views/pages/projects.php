<?php
    $title = 'Projects | Dennis Koch';
    $description = 'Explore my latest projects including Filament Studio, open source packages, and talks from the Laravel community.';
    $keywords = 'Projects, Filament Studio, Laravel packages, Open Source, Laravel Switzerland Meetup, PHP packages';

    $packages = [
        ['name' => 'Filament Activity Log', 'description' => 'Filament page for Spatie\'s activity log.', 'image' => './assets/images/packages/filament-activity-log.webp', 'link' => 'https://github.com/pxlrbt/filament-activity-log', 'paid' => false],
        ['name' => 'Filament Changelog', 'description' => 'Display your GitHub releases in your Filament panel.', 'image' => './assets/images/packages/filament-changelog.webp', 'link' => 'https://filament.pxlrbt.de/changelog/', 'paid' => true],
        ['name' => 'Filament Environment Indicator', 'description' => 'Never confuse your Filament environments again.', 'image' => './assets/images/packages/filament-environment-indicator.webp', 'link' => 'https://github.com/pxlrbt/filament-environment-indicator', 'paid' => false],
        ['name' => 'Filament Excel', 'description' => 'Easily configure your Excel exports in Filament..', 'image' => './assets/images/packages/filament-excel.webp', 'link' => 'https://github.com/pxlrbt/filament-excel', 'paid' => false],
        ['name' => 'Filament Spotlight', 'description' => 'Quickly navigate your Filament Resources.', 'image' => './assets/images/packages/filament-spotlight.webp', 'link' => 'https://github.com/pxlrbt/filament-spotlight', 'paid' => false],
        ['name' => 'Filament Spotlight Pro', 'description' => 'Browse your Filament Panel with ease.', 'image' => './assets/images/packages/filament-spotlight-pro.webp', 'link' => 'https://filament.pxlrbt.de/spotlight-pro', 'paid' => true],
        ['name' => 'Filament Translate Action', 'description' => 'Translate your models with a single click via DeepL.', 'image' => './assets/images/packages/filament-translate-action.webp', 'link' => 'https://github.com/pxlrbt/filament-translate-action', 'paid' => false],

        ['name' => 'Laravel Database State', 'description' => 'Seeders – but for production data.', 'image' => './assets/images/packages/laravel-database-state.webp', 'link' => 'https://github.com/pxlrbt/laravel-database-state', 'paid' => false],
        ['name' => 'Laravel Pdfable', 'description' => 'Keep the logic for your PDFs in one place like you do with Laravel\'s Mailables.', 'image' => './assets/images/packages/laravel-pdfable.webp', 'link' => 'https://github.com/pxlrbt/laravel-pdfable', 'paid' => false],
    ];
?>

<?php include __DIR__.'/../partials/header.php'; ?>

    <div class="section wrapper projects">
        <h1>Projects</h1>

        <!-- Filament Studio Section -->
        <section id="filament-studio" class="section project-hero">
            <div class="project-hero__content text-wrap">
                <h2>Filament Studio</h2>

                <p class="text-wrap">
                    A visual editor to build Filament Themes. Create beautiful, custom themes for your Filament applications
                    with an intuitive interface, real-time preview, and professional design system.
                </p>

                <a href="https://filamentstudio.dev?utm_source=website" class="button" target="_blank">
                    Visit Filament Studio
                </a>
            </div>

            <div class="project-hero__video">
                <video controls muted autoplay>
                    <source src="/assets/filament-studio.mp4" type="video/mp4">
                </video>
            </div>
        </section>

        <!-- Packages Section -->
        <section class="section" id="packages">
            <h2>Filament & Laravel Packages</h2>

            <div class="packages__intro">
                <div>
                    <p class="text-wrap">
                        A collection of Laravel and Filament packages I've built to help developers create better applications.
                    </p>
                </div>

                <a
                    href="https://github.com/sponsors/pxlrbt"
                    class="button -sponsors"
                    target="_blank"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-github"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path><path d="M9 18c-4.51 2-5-2-7-2"></path></svg>
                    Sponsor on GitHub
                </a>
            </div>

            <div class="packages-grid">
                    <?php foreach ($packages as $package): ?>
                    <div class="package-card">
                        <div class="package-card__image">
                            <img src="<?php echo $package['image']; ?>" alt="<?php echo $package['name']; ?>" loading="lazy">
                        </div>

                        <div class="package-card__content">
                            <h3>
                                <?php echo $package['name']; ?>
                                <?php if ($package['paid']): ?>
                                    <span class="badge badge--paid">Paid</span>
                                <?php endif; ?>
                            </h3>
                            <p><?php echo $package['description']; ?></p>

                            <div class="package-card__actions">
                                <a href="<?php echo $package['link']; ?>" class="button">View Package</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="section" id="talks">
            <h2>Talks</h2>

            <div class="talk-card">
                <div class="talk-card__thumbnail">
                    <img src="./assets/images/filament-v4-talk.webp" alt="Laravel Switzerland Meetup Talk" loading="lazy">
                </div>

                <div class="talk-card__content">
                    <h3>What's new in Filament v4?</h3>

                    <div class="badges">
                        <div class="badge">June 2025</div> <div class="badge">Zurich</div>
                    </div>

                    <p>
                        A talk at the Laravel Switzerland Meetup in June 2025 covering the latest features and improvements in Filament v4.
                    </p>

                    <div class="talk-card__actions">
                        <a href="https://www.youtube.com/watch?v=8qyV696TALA" class="button" target="_blank" rel="noopener">
                            YouTube
                        </a>

                        <a href="/talks/filament-v4" class="button button--secondary" target="_blank" rel="noopener">
                            Slides
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php include __DIR__.'/../partials/footer.php'; ?>
