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

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;

/**
 * This is the recaptcha class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Recaptcha
{
    /**
     * The secret key.
     *
     * @var string
     */
    protected $secret;

    /**
     * The http client.
     *
     * @var \Http\Client\HttpClient
     */
    protected $httpClient;

    /**
     * The http request factory.
     *
     * @var \Http\Message\RequestFactory
     */
    protected $requestFactory;

    /**
     * Create a new recaptcha instance.
     *
     * @param string $secret
     * @param \Http\Client\HttpClient|null $httpClient
     * @param \Http\Message\RequestFactory|null $requestFactory
     *
     * @return void
     */
    public function __construct(string $secret, HttpClient $httpClient = null, RequestFactory $requestFactory = null)
    {
        $this->secret = $secret;
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
    }

    /**
     * Verify the response string.
     *
     * @param string $response
     * @param string $ip
     *
     * @throws \Vinkla\Recaptcha\RecaptchaException
     *
     * @return object
     */
    public function verify(string $response, string $ip = null): object
    {
        $uri = 'https://www.google.com/recaptcha/api/siteverify';

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $body = http_build_query(array_filter([
            'secret' => $this->secret,
            'response' => $response,
            'remoteip' => $ip,
        ]));

        $request = $this->requestFactory->createRequest('POST', $uri, $headers, $body);

        $response = $this->httpClient->sendRequest($request);

        $data = json_decode((string) $response->getBody());

        if (!isset($data->success) || !$data->success) {
            if (property_exists($data, 'error-codes')) {
                $message = $this->getErrorMessage($data->{'error-codes'}[0]);

                throw new RecaptchaException($message);
            }

            throw new RecaptchaException('Invalid reCAPTCHA response.');
        }

        return $data;
    }

    /**
     * Get the error message by code.
     *
     * @param string $code
     *
     * @see https://developers.google.com/recaptcha/docs/verify#error-code-reference
     *
     * @return string
     */
    protected function getErrorMessage(string $code): string
    {
        $messages = [
            'bad-request' => 'The request is invalid or malformed.',
            'invalid-input-response' => 'The response parameter is invalid or malformed.',
            'invalid-input-secret' => 'The secret parameter is invalid or malformed.',
            'missing-input-response' => 'The response parameter is missing.',
            'missing-input-secret' => 'The secret parameter is missing.',
        ];

        return $messages[$code] ?? 'Invalid reCAPTCHA response.';
    }
}
