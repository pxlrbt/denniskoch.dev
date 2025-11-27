<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $articles = \App\Article::all();
    $latestArticle = end($articles);

    header('Content-Type: application/xml;charset=UTF-8');

    echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <title><?= htmlspecialchars('denniskoch.dev', ENT_XML1 | ENT_COMPAT, 'UTF-8') ?></title>
    <updated><?= $latestArticle->updated_at->format(DATE_RFC3339) ?></updated>
    <id>https://denniskoch.dev/feed</id>
    <link rel="self" type="application/atom+xml" href="https://denniskoch.dev/feed"/>
    <description><?= htmlspecialchars('Articles about Laravel, Filament, PHP and web development.', ENT_XML1 | ENT_COMPAT, 'UTF-8') ?></description>
    <author>
        <name><?= htmlspecialchars('Dennis Koch', ENT_XML1 | ENT_COMPAT, 'UTF-8') ?></name>
        <uri>https://denniskoch.dev</uri>
    </author>

<?php foreach ($articles as $article): ?>
    <entry>
        <title><?= htmlspecialchars(urldecode($article->title), ENT_XML1 | ENT_COMPAT, 'UTF-8') ?></title>
        <id><?= htmlspecialchars($article->url(), ENT_XML1 | ENT_COMPAT, 'UTF-8') ?></id>
        <link rel="alternate" type="text/html" href="<?= htmlspecialchars($article->url(), ENT_XML1 | ENT_COMPAT, 'UTF-8') ?>"/>
        <published><?= $article->created_at->format(DATE_RFC3339) ?></published>
        <updated><?= $article->updated_at->format(DATE_RFC3339) ?></updated>
        <summary type="text"><?= htmlspecialchars($article->description ?? '', ENT_XML1 | ENT_COMPAT, 'UTF-8') ?></summary>
        <content type="html"><![CDATA[<?= $article->content ?>]]></content>
        <author>
            <name><?= htmlspecialchars('Dennis Koch', ENT_XML1 | ENT_COMPAT, 'UTF-8') ?></name>
            <uri>https://denniskoch.dev</uri>
        </author>
    </entry>
<?php endforeach; ?>
</feed>
