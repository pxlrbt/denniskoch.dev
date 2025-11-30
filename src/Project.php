<?php

namespace App;

final class Project
{
    protected static array $packages = [
        ['name' => 'Filament Activity Log', 'description' => 'Filament page for Spatie\'s activity log.', 'image' => '/assets/images/packages/filament-activity-log.webp', 'link' => 'https://github.com/pxlrbt/filament-activity-log', 'paid' => false],
        ['name' => 'Filament Changelog', 'description' => 'Display your GitHub releases in your Filament panel.', 'image' => '/assets/images/packages/filament-changelog.webp', 'link' => 'https://store.denniskoch.dev/buy/bf12e45f-373a-491d-938e-e7386179bb3f', 'paid' => true, 'docs_url' => 'https://denniskoch.dev/projects/filament-changelog/docs/'],
        ['name' => 'Filament Environment Indicator', 'description' => 'Never confuse your Filament environments again.', 'image' => '/assets/images/packages/filament-environment-indicator.webp', 'link' => 'https://github.com/pxlrbt/filament-environment-indicator', 'paid' => false],
        ['name' => 'Filament Excel', 'description' => 'Easily configure your Excel exports in Filament.', 'image' => '/assets/images/packages/filament-excel.webp', 'link' => 'https://github.com/pxlrbt/filament-excel', 'paid' => false],
        ['name' => 'Filament Favicon', 'description' => 'Add Favicons to your Filament panel in under a minute.', 'image' => '/assets/images/packages/filament-favicon.webp', 'link' => 'https://github.com/pxlrbt/filament-favicon', 'paid' => false],
        ['name' => 'Filament Spotlight', 'description' => 'Quickly navigate your Filament Resources.', 'image' => '/assets/images/packages/filament-spotlight.webp', 'link' => 'https://github.com/pxlrbt/filament-spotlight', 'paid' => false],
        ['name' => 'Filament Spotlight Pro', 'description' => 'Browse your Filament Panel with ease.', 'image' => '/assets/images/packages/filament-spotlight-pro.webp', 'link' => 'https://store.denniskoch.dev/buy/d70a8f51-09c3-4cf3-8b3a-8ace6e0f6de3', 'paid' => true,  'docs_url' => 'https://denniskoch.dev/projects/filament-spotlight-pro/docs/'],
        ['name' => 'Filament Translate Action', 'description' => 'Translate your models with a single click via DeepL.', 'image' => '/assets/images/packages/filament-translate-action.webp', 'link' => 'https://github.com/pxlrbt/filament-translate-action', 'paid' => false],

        ['name' => 'Laravel Database State', 'description' => 'Seeders – but for production data.', 'image' => '/assets/images/packages/laravel-database-state.webp', 'link' => 'https://github.com/pxlrbt/laravel-database-state', 'paid' => false],
        ['name' => 'Laravel Pdfable', 'description' => 'Keep the logic for your PDFs in one place like you do with Laravel\'s Mailables.', 'image' => '/assets/images/packages/laravel-pdfable.webp', 'link' => 'https://github.com/pxlrbt/laravel-pdfable', 'paid' => false],
    ];

    public function __construct(
        public string $name,
        public string $description,
        public string $image,
        public string $link,
        public bool $paid = false,
        public ?string $docs_url = null,
    )
    {
    }

    /**
     * @return array<self>
     */
    public static function all(): array
    {
        return array_map(fn (array $project) => new self(...$project), self::$packages);
    }
}
