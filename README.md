reCAPTCHA
=========

![recaptcha](https://cloud.githubusercontent.com/assets/499192/17246444/6c1d188a-558c-11e6-8017-009392496433.gif)

A [reCAPTCHA](https://developers.google.com/recaptcha/intro) PHP package with optional [Laravel](https://laravel.com/) support. reCAPTCHA protects your website from spam and abuse while letting real people pass through with ease.

```php
use Vinkla\Recaptcha\Recaptcha;

// Create a new recaptcha instance.
$recaptcha = new Recaptcha('site-key', 'secret-key');

// Verify the recaptcha response.
$recaptcha->verify('g-recaptcha-response');
```

[![Build Status](https://img.shields.io/travis/vinkla/php-recaptcha/master.svg?style=flat)](https://travis-ci.org/vinkla/php-recaptcha)
[![StyleCI](https://styleci.io/repos/64472238/shield?style=flat)](https://styleci.io/repos/64472238)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/vinkla/php-recaptcha.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/php-recaptcha/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/vinkla/php-recaptcha.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/php-recaptcha)
[![Latest Version](https://img.shields.io/github/release/vinkla/php-recaptcha.svg?style=flat)](https://github.com/vinkla/php-recaptcha/releases)
[![License](https://img.shields.io/packagist/l/vinkla/recaptcha.svg?style=flat)](https://packagist.org/packages/vinkla/recaptcha)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require vinkla/recaptcha
```

> **Note:** The next steps are optional. They're only required if you want to use this package with Laravel.

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
$ php artisan vendor:publish
```

This will create a `config/recaptcha.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Site Key

The site key is used for the HTML form field. Which you can add to your views with the `recaptcha()->field()` helper function.

#### Secret Key

The secret key is used to communication between your application and Google. Be sure to keep it a secret.

## Usage

First you'll need to add the [Google reCAPTCHA script](https://developers.google.com/recaptcha/docs/display#auto_render) to your view templates just before the closing `</head>` tag.

```html
<script src="https://google.com/recaptcha/api.js?hl=en"></script>
```

To display the reCAPTCHA field in your form you may add like this.

```html
<div class="g-recaptcha" data-sitekey="your-site-key"></div>
```

Then create a new `Vinkla\Recaptcha\Recaptcha` instance.

```php
use Vinkla\Recaptcha\Recaptcha;

$recaptcha = new Recaptcha('site-key', 'secret-key');
```

To validate a response from the form you can use the `verify()` method.

```php
use Vinkla\Recaptcha\Exceptions\InvalidResponseException;

try {
    $recaptcha->verify('g-recaptcha-response');
} catch (InvalidResponseException $e) {
    // If the validation fails.
}
```

## Laravel

If you're using this package with Laravel, you may use the facade class.

```php
use Vinkla\Recaptcha\Facades\Recaptcha;

Recaptcha::verify('g-recaptcha-response');
```

If you prefer to use dependency injection over facades like me, then you can inject the manager:

```php
use Illuminate\Http\Request;
use Vinkla\Recaptcha\Recaptcha;

class Foo
{
    protected $recaptcha;

    public function __construct(Recaptcha $recaptcha)
    {
        $this->recaptcha = $recaptcha;
    }

    public function bar(Request $request)
    {
        $this->recaptcha->verify(
            $request->get('g-recaptcha-response')
        );
    }
}
```

You may also validate the reCAPTCHA response with Laravel's validator.

```php
use Illuminate\Support\Facades\Validator;

Validator::make($request->all(), [
    'g-recaptcha-response' => 'recaptcha',
]);
```

If you don't like the default error message, you can define a [custom error message](https://laravel.com/docs/validation#custom-validation-rules) in the `validation.php` translations file.

```
'recaptcha' => 'You are a robot!',
```

There is a helper method available to add the reCAPTCHA field to your form without having to specify the site key manually.

```php
{!! recaptcha()->field() !!}
```

This is also possible with the script tag. You can pass along the optional parameter `$lang` in order to display the field in your language.

```php
{!! recaptcha()->script('sv') !!}
```

## Documentation

If you want to to read more about reCAPTCHA, I'd suggest you [head over to the official documentation](https://developers.google.com/recaptcha/intro).

## License

reCAPTCHA is licensed under [The MIT License (MIT)](LICENSE).
