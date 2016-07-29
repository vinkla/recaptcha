<?php

/*
 * This file is part of reCAPTCHA.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Site Key
    |--------------------------------------------------------------------------
    |
    | The site key is used for the HTML form field. Which you can add to your
    | views with the recaptcha()->field() helper function.
    |
    */

    'site' => 'your-site-key',

    /*
    |--------------------------------------------------------------------------
    | Secret Key
    |--------------------------------------------------------------------------
    |
    | The secret key is used to communication between your application and
    | Google. Be sure to keep it a secret.
    |
    */

    'secret' => 'your-secret-key',

];
