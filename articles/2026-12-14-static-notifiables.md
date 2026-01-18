---
title: Stop Hardcoding Email Addresses in Laravel
description: A Clean Approach to Managing Static Email Addresses in Laravel
tags: [ "Laravel", "Notifications" ]
seo_keywords: [ "Laravel Notifications", "AnonymousNotifiable", "Laravel Email Management", "Laravel Best Practices" ]
created_at: 2026-01-19
updated_at: 2026-01-19
mastodon_url:
---

## The Problem: Hardcoded Email Addresses Everywhere

We've all been there. Your app needs to send notifications to specific email addresses – a booking manager, support team, or admin — but these recipients don't have user accounts in your database.

The quick solution? Hardcode the email or scatter `config('emails.something')` calls throughout your codebase. But there's a better way.


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

**This works, but we can do better.**


## Why Notifications Beat Mailables

I always reach for Laravel's notification system instead of Mailables. Here's why:

* **Multi-channel support:** Send to email, Slack, SMS, or database notifications from one place
* **Better organization:** Keep all communication logic in dedicated notification classes

But there's a catch: notifications need a `Notifiable` instance, typically a User model.


## Enter `AnonymousNotifiable`

Laravel provides `AnonymousNotifiable` for exactly this scenario: Sending notifications without a database-backed user.

```php
$bookingManager = (new AnonymousNotifiable())
    ->route('mail', config('emails.booking_manager'));

$bookingManager->notify(new Notifications\BookingReceived($booking));
```

But you'll find yourself creating these `AnonymousNotifiable` instances repeatedly across your codebase. It's verbose and repetitive.


## The Clean Solution: Wrapper Classes

Here's my preferred approach: Wrap each `AnonymousNotifiable` in a dedicated class with a static factory method:

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

Now sending notifications becomes beautifully simple:

```php
BookingManager::make()->notify(new Notifications\BookingReceived($booking));
```

## Why This Approach Wins

**Readable and discoverable**
Your IDE will autocomplete `BookingManager::make()`, making it easy to find available notifiables.

**Single source of truth**
Change the email address in one place, and it updates everywhere.

**Multi-channel ready**
Easily add Slack, SMS, or other channels without touching your business logic.

**Type-safe**
Return type hints catch errors at development time, not in production.


How do you handle static email notifications in your Laravel applications? Have you tried this approach? Share your thoughts in the comments below!
