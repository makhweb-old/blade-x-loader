# (WIP) Speed up your application with SPA-like dynamic page loading over AJAX 🚀 (Laravel, Blade)

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Latest Stable Version](https://poser.pugx.org/makhweb/blade-x-loader/v/stable)](https://packagist.org/packages/makhweb/blade-x-loader)
[![Total Downloads](https://img.shields.io/packagist/dt/makhweb/blade-x-loader.svg?style=flat-square)](https://packagist.org/packages/makhweb/blade-x-loader)

## Demo

Source: https://github.com/makhweb/blade-x-loader-demo

## Installation

You can install the package via Composer:

```bash
composer require makhweb/blade-x-loader
```

Assets should be published by this command:

```bash
php artisan vendor:publish --provider="Makhweb\BladeXLoader\BladeXLoaderServiceProvider" --tag="publishable"
```

## Usage

You should use **pjaxLayout([layout])** function when your blade component is extending from other layout.

```bash
@extends(fromLayout('main'))
```

Also you need to include the package's assets.
Example (layout.blade.php):

```bash
@include('blade-x-loader::assets')
```

You must create an element with identified **id** attribute where the package can put html from the request:

```bash
<div id="app">
 // HTML
</div>
```

In the finish, you need to add the attribute:

```bash
<a href="{{ route('home') }}" ajaxable>Home</a>
```

Optionally the config file can be published with:

```bash
php artisan vendor:publish --provider="Makhweb\BladeXLoader\BladeXLoaderServiceProvider" --tag="config"
```

## Caching

You just need to add the `cache-for="[seconds]"` attribute to the tag:

```
<a href="{{ route('home) }}" ajaxable cache-for="60">Home</a>
```

All data will be stored in **localStorage**.

## Blade directives

### @pjax

Shows when request is pjax

```bash
@pjax
 <p>This is a pjax request<p>
@endpjax
```

When you need to check that the request <b>is not ajax,</b>
you can use the <b>@notAjax</b> blade directive.

## Testing

In next releases, we will write tests 👀

<!-- ``` bash
vendor/bin/phpunit
``` -->

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email eldorbekmakhkamov@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.
