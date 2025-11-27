<?php

error_reporting(E_ALL);
require_once __DIR__ . '/../vendor/autoload.php';

const PUBLIC_PATH = __DIR__ . '/';
const ASSETS_PATH = __DIR__ . '/assets';
const VIEW_PATH = __DIR__ . '/../resources/views/pages/';

if (! str_ends_with($_SERVER['REQUEST_URI'], '/')) {
    header('Location: ' . $_SERVER['REQUEST_URI'] . '/');
    exit;
}

$uri = $_SERVER['REQUEST_URI'] ?: '/';


match (true) {
    $uri === '/' => include VIEW_PATH . 'home.php',
    $uri === '/projects/' => include VIEW_PATH . 'projects.php',
    $uri === '/imprint/' => include VIEW_PATH . 'imprint.php',
    $uri === '/privacy/' => include VIEW_PATH . 'privacy.php',
    $uri === '/feed/' => include VIEW_PATH . 'atom.php',
    $uri === '/uses/' => include VIEW_PATH . 'uses.php',
    $uri === '/articles/' => include VIEW_PATH . 'articles.php',
    str_starts_with($uri, '/articles/') => include VIEW_PATH . 'article.php',

    default => include VIEW_PATH . '404.php',
};
