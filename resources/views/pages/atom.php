<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $articles = \App\Article::all();
    $latestArticle = end($articles);

    header('Content-Type: application/xml;charset=UTF-8');

    echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <title>denniskoch.dev</title>
    <updated><?= $latestArticle->updated_at->format(DATE_RFC3339) ?></updated>
    <id>https://denniskoch.dev/feed</id>
    <link rel="self" type="application/atom+xml" href="https://denniskoch.dev/feed"/>
    <description>Articles about Laravel, Filament, PHP and web development.</description>
    <author>
        <name>Dennis Koch</name>
        <uri>https://denniskoch.dev</uri>
    </author>

    <?php foreach ($articles as $article): ?>
        <entry>
            <title><?= $article->title ?></title>            <id><?= $article->url() ?></id>
            <link rel="alternate" type="text/html" href="<?= $article->url() ?>"/>
            <published><?= $article->created_at->format(DATE_RFC3339) ?></published>
            <updated><?= $article->updated_at->format(DATE_RFC3339) ?></updated>
            <summary type="text"><?= $article->description ?></summary>
            <content type="html"><![CDATA[<?= $article->content ?>]]></content>
            <author>
                <name>Dennis Koch</name>
                <uri>https://denniskoch.dev</uri>
            </author>
        </entry>
    <?php endforeach; ?>
</feed>
