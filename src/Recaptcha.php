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
use Illuminate\Support\HtmlString;
use Illuminate\Support\Collection;
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
     *
     * @return void
     */
    public function __construct($site, $secret)
    {
        $this->site = $site;
        $this->secret = $secret;
    }

    /**
     * Verify the response string.
     *
     * @param string $response
     *
     * @throws \Vinkla\Recaptcha\Exceptions\UnverifiedRecaptchaException
     *
     * @return bool
     */
    public function verify($response)
    {
        $data = [
            'secret' => $this->secret,
            'response' => $response,
        ];

        $key = (version_compare(ClientInterface::VERSION, '6') === 1) ? 'form_params' : 'body';

        $client = new Client();

        $response = $client->post('https://google.com/recaptcha/api/siteverify', [$key => $data]);

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
     * Generate the recaptcha form field.
     *
     * @param string $theme
     * @param string $type
     * @param string $size
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function field($theme = 'light', $type = 'image', $size = 'normal') {
    {
        $attributes = new Collection([
            'class' => 'g-recaptcha',
            'data-sitekey' => $this->site,
            'data-size' => $size,
            'data-theme' => $theme,
            'data-type' => $type,
        ]);

        $attributes = $attributes->map(function ($attribute, $value) {
            return sprintf('%s="%s"', $attribute, $value);
        })->implode(' ');

        dd($attributes);

        return new HtmlString('<div '.$attributes.'></div>');
    }
}
