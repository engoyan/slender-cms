<?php namespace Dws\SlenderCMS;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * A Laravel 4 service provider for Slender API
 *
 * @author Vadim Engoyan <vadim.engoyan@diamondwebservices.com>
 */
class ApiServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['api'] = $this->app->share(function($app){
            $config = $app['config']['slender-cms::api.slender'];
            return new ApiClient($config['host'], $config['auth']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('api');
    }
}
