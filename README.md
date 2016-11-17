# reCAPTCHA

![recaptcha](https://cloud.githubusercontent.com/assets/499192/17246444/6c1d188a-558c-11e6-8017-009392496433.gif)

> An easy-to-use and simple [reCAPTCHA](https://developers.google.com/recaptcha/intro) package.

```php
use Vinkla\Recaptcha\Recaptcha;

// Create a new recaptcha instance.
$recaptcha = new Recaptcha('your-secret-key');

// Verify the recaptcha response.
$recaptcha->verify('g-recaptcha-response');
```

[![Build Status](https://img.shields.io/travis/vinkla/recaptcha/master.svg?style=flat)](https://travis-ci.org/vinkla/recaptcha)
[![StyleCI](https://styleci.io/repos/64472238/shield?style=flat)](https://styleci.io/repos/64472238)
[![Coverage Status](https://img.shields.io/codecov/c/github/vinkla/recaptcha.svg?style=flat)](https://codecov.io/github/vinkla/recaptcha)
[![Latest Version](https://img.shields.io/github/release/vinkla/recaptcha.svg?style=flat)](https://github.com/vinkla/recaptcha/releases)
[![License](https://img.shields.io/packagist/l/vinkla/recaptcha.svg?style=flat)](https://packagist.org/packages/vinkla/recaptcha)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require vinkla/recaptcha
```

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

$recaptcha = new Recaptcha('your-secret-key');
```

To validate a response from the form you can use the `verify()` method.

```php
use Vinkla\Recaptcha\RecaptchaException;

try {
    $recaptcha->verify('g-recaptcha-response');
} catch (RecaptchaException $e) {
    // If the validation fails.
}
```

If you want to to read more about reCAPTCHA, I'd suggest you [head over to the official documentation](https://developers.google.com/recaptcha/intro).

## License

[MIT](LICENSE) © [Vincent Klaiber](https://vinkla.com)
