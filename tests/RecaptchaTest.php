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

use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
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

        $recaptcha->verify('my-recaptcha-response');
    }

    /**
     * @expectedException \Vinkla\Recaptcha\RecaptchaException
     */
    public function testInvalidResponseWithErrorCodes()
    {
        $recaptcha = $this->getRecaptcha(['success' => false, 'error-codes' => []]);

        $recaptcha->verify('my-recaptcha-response');
    }

    protected function getRecaptcha($data)
    {
        $client = new Client();

        $response = new Response(200, [], json_encode($data));

        $client->addResponse($response);

        return new Recaptcha('my-secret-key', $client);
    }
}
