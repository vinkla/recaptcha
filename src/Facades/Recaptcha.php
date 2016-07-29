<?php

/*
 * This file is part of reCAPTCHA.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Recaptcha\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the recaptcha facade class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Recaptcha extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'recaptcha';
    }
}
