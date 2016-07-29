<?php

/*
 * This file is part of  reCAPTCHA.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Recaptcha\Exceptions;

use Exception;

/**
 * This is the unverified recaptcha exception class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class UnverifiedRecaptchaException extends Exception implements RecaptchaExceptionInterface
{
    //
}
