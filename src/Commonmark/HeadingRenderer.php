<?php

declare(strict_types=1);

namespace App\Commonmark;

use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Node\Inline\Text;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;

function slugify(string $text): string {
    return strtolower(
        preg_replace('~[^\pL\d]+~u', '-', $text)
    );
}

final class HeadingRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Heading::assertInstanceOf($node);

        $tag = 'h' . $node->getLevel();

        $attrs = $node->data->get('attributes');

        $firstChild = $node->firstChild();

        if (! $firstChild instanceof Text) {
            return new HtmlElement($tag, $attrs, $childRenderer->renderNodes($node->children()));
        }

        // Wrap in <a>-Tag
        $content = $firstChild->getLiteral();
        $attrs['id'] = slugify($content);

        $linkNode = new Link('#' . $attrs['id'], '#', '');
        $linkNode->replaceChildren($node->children());
        $linkNode->data->set('attributes', ['class' => 'anchor-link']);

        $node->replaceChildren([$linkNode]);

        return new HtmlElement($tag, $attrs, $childRenderer->renderNodes($node->children()));
    }

    public function getXmlTagName(Node $node): string
    {
        return 'heading';
    }

    /**
     * @param Heading $node
     *
     * @return array<string, scalar>
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getXmlAttributes(Node $node): array
    {
        Heading::assertInstanceOf($node);

        return ['level' => $node->getLevel()];
    }
}
