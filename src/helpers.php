<?php

/*
 * This file is part of reCAPTCHA.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!function_exists('recaptcha')) {
    /**
     * Get the recaptcha instance.
     *
     * @return \Vinkla\Recaptcha\Recaptcha
     */
    function recaptcha()
    {
        return app('recaptcha');
    }
}
