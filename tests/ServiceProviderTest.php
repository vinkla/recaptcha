<?php

/*
 * This file is part of reCAPTCHA.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Recaptcha;

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Vinkla\Recaptcha\Recaptcha;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testRecaptchaIsInjectable()
    {
        $this->assertIsInjectable(Recaptcha::class);
    }
}
