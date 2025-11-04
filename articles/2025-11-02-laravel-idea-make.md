---
title: Automatic autocompletion for make()
description: How Laravel Idea can help you reduce repetition when using make() methods
tags: [ "Laravel", "PhpStorm" ]
seo_keywords: [ "Laravel", "PhpStorm", "Laravel Idea", "IDE" ]
created_at: 2025-11-02
updated_at: 2025-11-02
mastodon_url: https://phpc.social/@denniskoch/115491571038061522
---

## Introduction

The `make()` method is a common pattern in the Laravel ecosystem. Some might argue that it's no longer necessary since we can now [chain methods directly after a new call](https://wiki.php.net/rfc/new_without_parentheses) starting from PHP 8.4. However, I believe it remains useful for resolving elements from the Laravel container.

You could place the `make()` method in a trait and apply it to all your classes while passing the arguments along. However, this approach would result in the loss of autocompletion.

![Screenshot demonstrating missing autocompletion in PhpStorm](/assets/images/articles/2025-11-02-laravel-idea-make/missing-autocompletion.png)

```php
<?php

class Action
{
    public function __construct(
        protected string $arg1,
        protected string $arg2,
        protected $arg3,
    ) {}

    public static function make(...$args): static
    {
        return resolve(static::class, $args);
    }
}
```

Consequently, you often end up duplicating your constructor code. This can become frustrating, especially with more than one or two arguments.

```php
<?php

class Action
{
    public function __construct(
        protected string $arg1,
        protected string $arg2,
        protected string $arg3,
    ) {}

    public static function make(
        protected string $arg1,
        protected string $arg2,
        protected string $arg3,
    ): static
    {
        return resolve(static::class, [$arg1, $arg2, $arg3]);
    }
}
```

## Laravel Idea To The Rescue

Unfortunately, there is no built-in way for the IDE to automatically use the same arguments as the constructor. However, Adelf, the creator of [Laravel Idea](https://laravel-idea.com/), quickly provided a solution. Laravel Idea offers a [`ide.json`](https://laravel-idea.com/docs/ide_json/overview) file that allows you to configure additional autocompletion for your project. While this is typically Laravel-specific, in this case, he added support for type-hinting constructor arguments in other methods.

To implement this, create the `ide.json` file in your project root, add the following JSON, and regenerate your helper code.

```json
{
    "$schema": "https://laravel-ide.com/schema/laravel-ide-v2.json",
    "helperCode": {
        "methodsWithConstructorParameters": [
            {
                "baseFqn": "App\\Traits\\Makable",
                "methods": [
                    {
                        "name": "make",
                        "returnType": "static"
                    }
                ]
            }
        ]
    }
}
```

## Reusable `make()` Method

The `baseFqn` also accepts parent classes or traits, allowing you to reuse this across your codebase. When using a trait, PhpStorm will display two definitions, however.

![Screenshot demonstrating double autocompletion in PhpStorm](/assets/images/articles/2025-11-02-laravel-idea-make/double-autocompletion.png)

```php
<?php

trait Makable
{
    public static function make(...$args): static
    {
        return new static(...$args);
    }
}
```

## Supporting `resolve()`

Returning to the original example of passing arguments to `resolve()` to create a class via the Laravel container, you quickly realize that this approach doesn't always work. `resolve()` requires the parameter name as the key, so the simple version only works with named arguments, which are not always provided.

Fortunately, we can bridge this gap using [Reflection](https://www.php.net/manual/en/intro.reflection.php) to add positional arguments. The complete trait looks like this:

```php
<?php

trait Makable
{
    public static function make(...$positionalParams): static
    {
        $reflector = new ReflectionClass(static::class);
        $constructor = $reflector->getConstructor();

        if (! $constructor) {
            return app(static::class);
        }

        $constructorParams = $constructor->getParameters();
        $namedParams = [];

        foreach ($positionalParams as $index => $value) {
            if (is_string($index)) {
                // This is already a named parameter
                $namedParams[$index] = $value;
            } elseif (isset($constructorParams[$index])) {
                // This is a positional parameter - convert to named
                $namedParams[$constructorParams[$index]->getName()] = $value;
            }
        }

        return app(static::class, $namedParams);
    }
}
```

## Conclusion

So, this was quite some effort to avoid repeating the constructor arguments. Is it really worth it? I'll leave that decision to you, but I think it's cool that it's possible.
