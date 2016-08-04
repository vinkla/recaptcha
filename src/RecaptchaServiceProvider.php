<?php

/*
 * This file is part of reCAPTCHA.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Recaptcha;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Vinkla\Recaptcha\Exceptions\InvalidRecaptchaException;

/**
 * This is the recaptcha service provider class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RecaptchaServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->setupConfig();
        $this->setupValidationRules();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/recaptcha.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('recaptcha.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('recaptcha');
        }

        $this->mergeConfigFrom($source, 'recaptcha');
    }

    /**
     * Setup the validation rules.
     *
     * @return void
     */
    protected function setupValidationRules()
    {
        $this->app->validator->extend('recaptcha', function ($attribute, $value) {
            $recaptcha = $this->app['recaptcha'];

            try {
                return $recaptcha->verify($response);
            } catch (InvalidRecaptchaException $e) {
                return false;
            }
        });

        $this->app->validator->replacer('recaptcha', function () {
            return 'Invalid recaptcha response';
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRecaptcha();
    }

    /**
     * Register the recaptcha class.
     *
     * @return void
     */
    protected function registerRecaptcha()
    {
        $this->app->singleton('recaptcha', function (Container $app) {
            $site = $app->config->get('recaptcha.site');
            $secret = $app->config->get('recaptcha.secret');

            return new Recaptcha($site, $secret);
        });

        $this->app->alias('recaptcha', Recaptcha::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'recaptcha',
        ];
    }
}
