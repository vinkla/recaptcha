<?php

/*
 * This file is part of reCAPTCHA.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Recaptcha\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Vinkla\Recaptcha\Facades\Recaptcha as Facade;
use Vinkla\Recaptcha\Recaptcha;
use Vinkla\Tests\Recaptcha\AbstractTestCase;

/**
 * This is the Recaptcha facade test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RecaptchaTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'recaptcha';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Facade::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return Recaptcha::class;
    }
}
