---
title: Stop Hardcoding Email Addresses in Laravel
description: A clean approach to managing static email addresses in Laravel
tags: [ "Laravel", "Notifications" ]
seo_keywords: [ "Laravel Notifications", "AnonymousNotifiable", "Laravel Email Management", "Laravel Best Practices" ]
created_at: 2026-01-19
updated_at: 2026-01-19
mastodon_url:
status: ready
---

## The Problem: Hardcoded Email Addresses Everywhere

From time to time, I need to send notifications to fixed email addresses that don't have user accounts in the database – like a booking manager or support team.

The quick solution is to hardcode the email throughout your codebase. It works, but it's messy.

## The Basic Solution: Config Files and Mailables

The first step toward cleaner code is centralizing email addresses in a config file:

```php
// config/emails.php
return [
    'booking_manager' => env('BOOKING_MANAGER_EMAIL', 'bookings@example.com'),
    'support_team' => env('SUPPORT_EMAIL', 'support@example.com'),
];
```

Now you can reference these email addresses when sending mails.

```php
Mail::to(config('emails.booking_manager'))
    ->send(new Mailables\BookingReceived($booking));
```

This works fine, but I prefer using notifications.


## Why I Prefer Notifications

I always reach for Laravel's notification system instead of Mailables because:

- You can send to multiple channels (email, Slack, SMS) from one place
- All your communication logic lives in dedicated notification classes

But notifications need a `Notifiable` instance, typically a `User` model.


## Using `AnonymousNotifiable`

Laravel has a solution for this: `AnonymousNotifiable`. It lets you send notifications without a database-backed user.


```php
$bookingManager = (new AnonymousNotifiable())
    ->route('mail', config('emails.booking_manager'));

$bookingManager->notify(new Notifications\BookingReceived($booking));
```

This gets the job done, but I don't like creating `⁠AnonymousNotifiable` instances all over the place. It's repetitive and verbose.


## The Clean Solution: Wrapper Classes

My solution is to wrap each `AnonymousNotifiable` in a dedicated class with a static factory method:

```php
<?php

namespace App\Notifications\Notifiables;

use Illuminate\Notifications\AnonymousNotifiable;

final class BookingManager
{
    public static function make(): AnonymousNotifiable
    {
        return (new AnonymousNotifiable())
            ->route('mail', config('emails.booking_manager'))
            ->route('slack', config('phone.booking_channel'));
    }
}
```

Now I can reuse this across the codebase:

```php
BookingManager::make()->notify(new Notifications\BookingReceived($booking));
```

## Why I Like This

- It's simple and readable. Your IDE autocompletes `⁠BookingManager::make()`.
- You can discover more `Notifiable`s in the `Notifiables` folder.
- If you need to change the email address, you do it in one place. Want to add Slack or SMS? Just add another route without touching your business logic.
- The return type hint also catches errors early instead of at runtime.

How do you handle static email notifications in your Laravel applications?
