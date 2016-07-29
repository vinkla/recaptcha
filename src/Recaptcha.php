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
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Vinkla\Recaptcha\Exceptions\InvalidRecaptchaException;

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
     * Validate the response string.
     *
     * @param string $response
     *
     * @throws \Vinkla\Recaptcha\Exceptions\InvalidRecaptchaException
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

        $response = $client->post('https://google.com/recaptcha/api/siteverify', [$key => $data]);

        $data = json_decode((string) $response->getBody(), true);

        if (!isset($data['success']) || !$data['success']) {
            if (isset($data['error-codes'])) {
                $error = reset($data['error-codes']);

                throw new InvalidRecaptchaException("Invalid recaptcha response error [$error].");
            }

            throw new InvalidRecaptchaException('Invalid recaptcha response.');
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
    public function field($theme = 'light', $type = 'image', $size = 'normal')
    {
        $attributes = new Collection([
            'class' => 'g-recaptcha',
            'data-sitekey' => $this->site,
            'data-size' => $size,
            'data-theme' => $theme,
            'data-type' => $type,
        ]);

        $attributes = $attributes->map(function ($value, $attribute) {
            return sprintf('%s="%s"', $attribute, $value);
        })->implode(' ');

        return new HtmlString('<div '.$attributes.'></div>');
    }

    /**
     * Generate the recaptcha script tag.
     *
     * @param string $lang
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function script($lang = 'en')
    {
        $query = http_build_query(['hl' => $lang]);

        return new HtmlString('<script src="https://google.com/recaptcha/api.js?'.$query.'"></script>');
    }
}
