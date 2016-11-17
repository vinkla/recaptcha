<?php

/*
 * This file is part of reCAPTCHA.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Tests\Recaptcha;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Vinkla\Recaptcha\Recaptcha;

/**
 * This is the recaptcha test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RecaptchaTest extends TestCase
{
    public function testVerify()
    {
        $recaptcha = $this->getRecaptcha(['success' => true]);

        $this->assertTrue($recaptcha->verify('my-recaptcha-response'));
    }

    /**
     * @expectedException \Vinkla\Recaptcha\RecaptchaException
     */
    public function testInvalidResponse()
    {
        $recaptcha = $this->getRecaptcha(['success' => false]);

        $this->assertTrue($recaptcha->verify('my-recaptcha-response'));
    }

    /**
     * @expectedException \Vinkla\Recaptcha\RecaptchaException
     */
    public function testInvalidResponseWithErrorCodes()
    {
        $recaptcha = $this->getRecaptcha(['success' => false, 'error-codes' => []]);

        $this->assertTrue($recaptcha->verify('my-recaptcha-response'));
    }

    protected function getRecaptcha($data)
    {
        $stream = Psr7\stream_for(json_encode($data));

        $mock = new MockHandler([
            new Response(200, [], $stream),
        ]);

        $handler = HandlerStack::create($mock);

        $client = new Client(['handler' => $handler]);

        return new Recaptcha('my-site-key', 'my-secret-key', $client);
    }
}
