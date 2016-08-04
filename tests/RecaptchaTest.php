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

use Illuminate\Support\HtmlString;
use Vinkla\Recaptcha\Recaptcha;

/**
 * This is the recaptcha test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RecaptchaTest extends AbstractTestCase
{
    public function testField()
    {
        $field = $this->getRecaptcha()->field('dark');

        $this->assertSame('<div class="g-recaptcha" data-sitekey="your-site-key" data-size="normal" data-theme="dark" data-type="image"></div>', (string) $field);

        $this->assertInstanceOf(HtmlString::class, $field);
    }

    public function testScript()
    {
        $script = $this->getRecaptcha()->script('sv');

        $this->assertSame('<script src="https://google.com/recaptcha/api.js?hl=sv"></script>', (string) $script);

        $this->assertInstanceOf(HtmlString::class, $script);
    }

    public function testHelpers()
    {
        $this->assertInstanceOf(Recaptcha::class, recaptcha());
    }

    public function getRecaptcha()
    {
        return new Recaptcha('your-site-key', 'your-secret-key');
    }
}
