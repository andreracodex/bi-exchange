# Fetch Exchange Rates

A Laravel package to fetch exchange rates from Bank Indonesia (BI) and update them in your database. This package scrapes the exchange rates from the official Bank Indonesia website and allows you to easily integrate it into your Laravel application.

By: Tirta Rachmandiri

## Features

- Fetch exchange rates from Bank Indonesia.
- Supports multiple currencies (AUD, EUR, USD, GBP, etc.).
- Update the sell and buy rates in your database.
- Simple Laravel command to trigger the rate fetch.

## Installation

### 1. Install the Package

You can install this package via Composer. Run the following command in your Laravel project directory:

```bash
composer require andreracodex/bi-exchange
```
### 2. Get Rate from BI

Fetch exchange rates from Bank Indonesia (BI) and update them in your database.

```bash
php artisan ambil:rate
```

### Automatic Migration

If you're using Laravel 5.5 or later, the migration will be automatically published when you install the package.

### Manual Migration

If you want to manually publish the migration and models, you can use the following command (if something wrong):

```bash
php artisan vendor:publish --provider="Andreracodex\BiExchange\FetchExchangeServiceProvider" --tag="migrations"
```

```bash
php artisan vendor:publish --provider="AndreRacodex\BiExchange\FetchExchangeServiceProvider" --tag="currency-model"
```