<?php

/*
 * This file is part of  reCAPTCHA.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Recaptcha;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Vinkla\Recaptcha\Exceptions\UnverifiedRecaptchaException;

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
     * Create a new recaptcha instance.
     *
     * @param string $site
     * @param string $secret
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct($site, $secret)
    {
        $this->site = $site;
        $this->secret = $secret;
    }

    /**
     * Validate the response string.
     *
     * @param string $response
     *
     * @throws \Vinkla\Recaptcha\Exceptions\UnverifiedRecaptchaException
     *
     * @return bool
     */
    public function validate($response)
    {
        $data = [
            'secret' => $this->secret,
            'response' => $response,
        ];

        $key = (version_compare(ClientInterface::VERSION, '6') === 1) ? 'form_params' : 'body';

        $client = new Client();

        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [$key => $data]);

        $data = json_decode((string) $response->getBody(), true);

        if (!isset($data['success']) || !$data['success']) {
            if (isset($data['error-codes'])) {
                $message = reset($data['error-codes']);
            }

            throw new UnverifiedRecaptchaException($message ?: 'Unverified reCAPTCHA response.');
        }

        return (bool) $data['success'];
    }

    /**
     * Get the site key.
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }
}
