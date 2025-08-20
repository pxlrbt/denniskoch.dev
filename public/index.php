<?php

error_reporting(E_ALL);
require_once __DIR__ . '/../vendor/autoload.php';

const VIEW_PATH = __DIR__ . '/../resources/views/pages/';

$uri = rtrim($_SERVER['REQUEST_URI'], '/') ?: '/';


function asset_url(string $file): string
{
    $publicFolder = __DIR__ . '/';

    $files = glob($publicFolder . '/assets/dist/*');
    $files = array_map(
        fn (string $filename) => str_replace($publicFolder, '', $filename),
        $files
    );

    $pattern = '/\/assets\/dist\/' . preg_quote(pathinfo($file, PATHINFO_FILENAME), '/') . '[\-\d\w]*\.'. preg_quote(pathinfo($file, PATHINFO_EXTENSION), '/') .'/';

    foreach ($files as $file) {
        if (preg_match($pattern, $file)) {
            return $file;
        }
    }

    throw new Exception('No assets for ' . $file . ' found');
}

match (true) {
    $uri === '/' => include VIEW_PATH . 'home.php',
    $uri === '/projects' => include VIEW_PATH . 'projects.php',
    $uri === '/imprint' => include VIEW_PATH . 'imprint.php',
    $uri === '/privacy' => include VIEW_PATH . 'privacy.php',
    str_starts_with($uri, '/articles/') => include VIEW_PATH . 'article.php',
    $uri === '/articles' => include VIEW_PATH . 'articles.php',

    default => include VIEW_PATH . '404.php',
};
