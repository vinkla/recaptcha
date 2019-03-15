# reCAPTCHA

![recaptcha](https://cloud.githubusercontent.com/assets/499192/17246444/6c1d188a-558c-11e6-8017-009392496433.gif)

> An easy-to-use [reCAPTCHA](https://developers.google.com/recaptcha/intro) package.

```php
use Vinkla\Recaptcha\Recaptcha;

// Create a new recaptcha instance.
$recaptcha = new Recaptcha('your-secret-key');

// Verify the recaptcha response.
$recaptcha->verify($_POST['g-recaptcha-response']);
```

[![Build Status](https://badgen.net/travis/vinkla/recaptcha/master)](https://travis-ci.org/vinkla/recaptcha)
[![Coverage Status](https://badgen.net/codecov/c/github/vinkla/recaptcha)](https://codecov.io/github/vinkla/recaptcha)
[![Total Downloads](https://badgen.net/packagist/dt/vinkla/recaptcha)](https://packagist.org/packages/vinkla/recaptcha)
[![Latest Version](https://badgen.net/github/release/vinkla/recaptcha)](https://github.com/vinkla/recaptcha/releases)
[![License](https://badgen.net/packagist/license/vinkla/recaptcha)](https://packagist.org/packages/vinkla/recaptcha)

## Installation

reCAPTCHA is decoupled from any library sending HTTP requests (like Guzzle), instead it uses an abstraction called [HTTPlug](http://httplug.io) which provides the http layer used to send requests to exchange rate services. This gives you the flexibility to choose what HTTP client and PSR-7 implementation you want to use.

Read more about the benefits of this and about what different HTTP clients you may use in the [HTTPlug documentation](http://docs.php-http.org/en/latest/httplug/users.html). Below is an example using [Guzzle 6](http://docs.guzzlephp.org/en/latest/index.html):

```bash
$ composer require vinkla/recaptcha php-http/message php-http/guzzle6-adapter
```

## Usage

First you'll need to add the [Google reCAPTCHA script](https://developers.google.com/recaptcha/docs/display#auto_render) to your view templates just before the closing `</head>` tag.

> If you want to use another language you made update the `hl` query parameter value.

```html
<script src="https://google.com/recaptcha/api.js?hl=en"></script>
```

To display the reCAPTCHA field in your form you need to add the snippet below.

> Remember to replace `your-site-key` with your actual reCAPTCHA site key.

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
    $recaptcha->verify($_POST['g-recaptcha-response']);
} catch (RecaptchaException $e) {
    // If the verification fails.
}
```

Optionally, you can send the user's IP address along with the request.

```php
$recaptcha->verify($_POST['g-recaptcha-response'], $ip);
```

If you want to to read more about reCAPTCHA, I'd suggest you [head over to the official documentation](https://developers.google.com/recaptcha/intro).

## License

[MIT](LICENSE) © [Vincent Klaiber](https://doubledip.se)
