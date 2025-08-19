<?php

namespace App;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\MarkdownConverter;
use Phiki\CommonMark\PhikiExtension;

use DateTime;

final class Article
{
    private const string ARTICLE_DIR = __DIR__ . '/../articles/';

    public function __construct(
        public string $slug,
        public string $title,
        public DateTime $date,
        public string $description,
        public string $content
    )
    {
    }

    public static function loadFile(string $filename): self
    {
        $environment = new Environment([]);
        $environment
            ->addExtension(new CommonMarkCoreExtension())
            ->addExtension(new StrikethroughExtension())
            ->addExtension(new FrontMatterExtension())
            ->addExtension(new PhikiExtension('github-dark'));

        $converter = new MarkdownConverter($environment);

        $content = file_get_contents($filename);

        $data = $converter->convert($content);

        $frontMatter = $data->getFrontMatter();

        return new Article(
            slug: str_replace('.md', '', basename($filename)),
            title: $frontMatter['title'] ?? '',
            date: new DateTime($frontMatter['created_at']),
            description: $frontMatter['description'] ?? '',
            content: $data->getContent()
        );
    }

    public static function all(): array
    {
        $articles = array_diff(scandir(self::ARTICLE_DIR), ['..', '.']);

        return array_map(fn (string $file) => self::loadFile(self::ARTICLE_DIR . $file), $articles);
    }

    public static function getBySlug(string $slug): ?self
    {
        $file = realpath(self::ARTICLE_DIR . $slug . '.md');

        if (! $file) {
            return null;
        }

        if (! file_exists($file)) {
            return null;
        }

        if (! str_starts_with($file, realpath(self::ARTICLE_DIR))) {
            return null;
        }

        return self::loadFile($file);
    }
}
