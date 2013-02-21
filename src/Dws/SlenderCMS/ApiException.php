<?php namespace Dws\SlenderCMS;

use Illuminate\Support\MessageBag;

class ApiException extends \Exception
{

    protected $messages = array();

    public function __construct($message = null, $code = 0, ApiException $previous = null){

        if(!is_array($message)){
            $message =(array) $message;
            if(isset($message['messages'])){
                $message = $message['messages'];
            }
        }

        $this->messages = $message;
        // parent::__construct("API Error", $code, $previous);
    }

    public function getMessages(){
        return $this->messages;
    }

}
