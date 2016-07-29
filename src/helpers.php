<?php

/*
 * This file is part of reCAPTCHA.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\HtmlString;

if (!function_exists('recaptcha_field')) {
    /**
     * Generate a reCAPTCHA form field.
     *
     * @param string $theme
     * @param string $type
     * @param string $size
     *
     * @return \Illuminate\Support\HtmlString
     */
    function recaptcha_field($theme = 'light', $type = 'image', $size = 'normal')
    {
        $format = '<div class="g-recaptcha" data-sitekey="%s" data-theme="%s" data-type="%s" data-size="%s"></div>';

        return new HtmlString(sprintf($format, app('recaptcha')->getSite(), $theme, $type, $size));
    }
}
