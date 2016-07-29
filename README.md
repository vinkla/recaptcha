reCAPTCHA
=========

![recaptcha](https://cloud.githubusercontent.com/assets/499192/17246444/6c1d188a-558c-11e6-8017-009392496433.gif)

A [reCAPTCHA](https://google.com/recaptcha) PHP package with optional [Laravel](https://laravel.com/) support. reCAPTCHA protects your website from spam and abuse while letting real people pass through with ease.

```php
use Vinkla\Recaptcha\Recaptcha;

// Create a new recaptcha instance.
$recaptcha = new Recaptcha('site-key', 'secret-key');

// Validate the recaptcha response.
$recaptcha->validate('g-recaptcha-response');
```

[![Build Status](https://img.shields.io/travis/vinkla/php-recaptcha/master.svg?style=flat)](https://travis-ci.org/vinkla/php-recaptcha)
[![StyleCI](https://styleci.io/repos/64472238/shield?style=flat)](https://styleci.io/repos/64472238)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/vinkla/php-recaptcha.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/php-recaptcha/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/vinkla/php-recaptcha.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/php-recaptcha)
[![Latest Version](https://img.shields.io/github/release/vinkla/recaptcha.svg?style=flat)](https://github.com/vinkla/recaptcha/releases)
[![License](https://img.shields.io/packagist/l/vinkla/recaptcha.svg?style=flat)](https://packagist.org/packages/vinkla/recaptcha)

## Installation
Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
composer require vinkla/recaptcha
```

### Laravel

Add the service provider to `config/app.php` in the `providers` array.

```php
Vinkla\Recaptcha\RecaptchaServiceProvider::class
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in `config/app.php` to your aliases array.

```php
'Recaptcha' => Vinkla\Recaptcha\Facades\Recaptcha::class
```

## Configuration

To use reCAPTCHA with Laravel, you'll need to publish all vendor assets:

```bash
php artisan vendor:publish
```

This will create a `config/recaptcha.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Site Key

The site key is used for the HTML form field. Which you can add to your views with the `recaptcha_field()` helper function.

#### Secret Key

The secret key is used to communication between your application and Google. Be sure to keep it a secret.

## Usage

Coming soon…

## License

reCAPTCHA is licensed under [The MIT License (MIT)](LICENSE).
