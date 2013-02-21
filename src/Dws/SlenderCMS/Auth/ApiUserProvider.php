<?php namespace Dws\SlenderCMS\Auth;

use Illuminate\Auth as Auth;
use Illuminate\Hashing\HasherInterface;

class ApiUserProvider implements Auth\UserProviderInterface {
    
    protected $hasher;
    protected $api;
        
    public function __construct(HasherInterface $hasher)
    {
        $this->api = \App::make('api');
        $this->hasher = $hasher;
    }
    
	/**
     * Retrieve a user by their unique idenetifier.
     *
     * @param  mixed  $identifier
     * @return Illuminate\Auth\UserInterface|null
     */
    public function retrieveByID($identifier)
    {
        $user = \Session::get('valid_user');
       
        if($user->getAuthIdentifier() == $identifier){
            return $user;
        }
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return Illuminate\Auth\UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
         try {
            $user = $this->api->post("auth", $credentials);
        } catch (ApiException $e) {
        }

        if(isset($user->users)){
            $user = $user->users;
            if(isset($user->_id)){
                $user->id = (string) $user->_id;
                return new Auth\GenericUser((array) $user);
            }
        }
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  Illuminate\Auth\UserInterface  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Auth\UserInterface $user, array $credentials)
    {
        // validation happens on api side, so we just check if our user exist
        \Session::put('valid_user', $user);
        return $user->getAuthIdentifier() ? true : false;
    }

}
