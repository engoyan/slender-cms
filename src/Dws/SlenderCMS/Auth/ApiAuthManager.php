<?php namespace Dws\SlenderCMS\Auth;

use Illuminate\Auth as Auth;

class ApiAuthManager extends Auth\AuthManager {
    
    /**
     * Create an instance of the database driver.
     *
     * @return Illuminate\Auth\Guard
     */
    protected function createApiDriver()
    {
        $provider = new ApiUserProvider($this->app['hash']);

        return new Auth\Guard($provider, $this->app['session']);
    }
}
