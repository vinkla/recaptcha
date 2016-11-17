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

namespace Vinkla\Recaptcha;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * This is the recaptcha class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Recaptcha
{
    /**
     * The site key.
     *
     * @var string
     */
    protected $site;

    /**
     * The secret key.
     *
     * @var string
     */
    protected $secret;

    /**
     * The guzzle http client.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * Create a new recaptcha instance.
     *
     * @param string $site
     * @param string $secret
     * @param \GuzzleHttp\ClientInterface|null $client
     *
     * @return void
     */
    public function __construct(string $site, string $secret, ClientInterface $client = null)
    {
        $this->site = $site;
        $this->secret = $secret;
        $this->client = $client ?: new Client();
    }

    /**
     * Verify the response string.
     *
     * @param string $response
     *
     * @throws \Vinkla\Recaptcha\RecaptchaException
     *
     * @return bool
     */
    public function verify(string $response): bool
    {
        $data = [
            'secret' => $this->secret,
            'response' => $response,
        ];

        $response = $this->client->post('https://google.com/recaptcha/api/siteverify', ['form_params' => $data]);

        $data = json_decode((string) $response->getBody(), true);

        if (!isset($data['success']) || !$data['success']) {
            if (isset($data['error-codes'])) {
                $error = reset($data['error-codes']);

                throw new RecaptchaException("Invalid recaptcha response error [$error].");
            }

            throw new RecaptchaException('Invalid recaptcha response.');
        }

        return (bool) $data['success'];
    }
}
