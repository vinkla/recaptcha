reCAPTCHA
=========

A [reCAPTCHA](https://google.com/recaptcha) PHP package with optional [Laravel](https://laravel.com/) support.

```php
use Vinkla\Recaptcha\Recaptcha;

// Create a new recaptcha instance.
$recaptcha = new Recaptcha('site-key', 'secret-key');

// Validate the recaptcha response.
$recaptcha->validate('g-recaptcha-response');
```

[![Build Status](https://img.shields.io/travis/vinkla/php-recaptcha/master.svg?style=flat)](https://travis-ci.org/vinkla/php-recaptcha)
[![StyleCI](https://styleci.io/repos/64472238/shield?style=flat)](https://styleci.io/repos/64472238)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/vinkla/recaptcha.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/recaptcha/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/vinkla/recaptcha.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/recaptcha)
[![Latest Version](https://img.shields.io/github/release/vinkla/recaptcha.svg?style=flat)](https://github.com/vinkla/recaptcha/releases)
[![License](https://img.shields.io/packagist/l/vinkla/recaptcha.svg?style=flat)](https://packagist.org/packages/vinkla/recaptcha)

## License

reCAPTCHA is licensed under [The MIT License (MIT)](LICENSE).
