> **Archived.** This package is no longer maintained and does not support current Laravel versions. See [laravolt/laravolt](https://github.com/laravolt/laravolt) for the maintained platform.

# laravolt/hologram
Log activity viewer for Laravel.

## Requirements
* Laravel
* Semantic UI
* JQuery
* https://github.com/spatie/laravel-activitylog

## Installation

Install package:

`composer require laravolt/hologram`

Register service provider:

`Laravolt\Hologram\ServiceProvider::class,`

Register facade:

`'Hologram' => \Laravolt\Hologram\Facade::class,`

## Usage

```php
{!! \Hologram::renderAsWidget() !!}
{!! \Hologram::renderAsTable() !!}
{!! \Hologram::by($user)->renderAsWidget() !!}
{!! \Hologram::by($user)->on($model)->renderAsWidget() !!}
```
