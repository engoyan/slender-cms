<?php

class PasswordController extends BaseController {

    protected $messageBag;

    public function __construct(MessageBag $messageBag)
    {
        $this->messageBag = $messageBag;
        parent::__construct();
    }

    public function forgot()
    {
        return View::make('password.forgot');
    }

    public function send()
    {

        $rules = array(
            'email'    => 'Required|Email',
        );

        $validator = Validator::make(Input::all(), $rules);

        if (!$validator->passes()) {

            return Redirect::route('forgotpassword')->withErrors($validator->messages());
            
        } else {

            $email = Input::get('email');
            $response = $this->api->get("users?where[]=email:{$email}");
            
            if ($response->meta->count === 0) {
                $this->messageBag->add('email', "the provided email does not exist");    
                return Redirect::route('forgotpassword')->withErrors($this->messageBag);
            }

            $userId = $response->users[0]->_id;
            $data = array('link' => Crypt::encrypt($userId));

            /*
            Mail::send('emails.auth.reminder', $data, function($m)
            {
                $m->to($email, 'Admin')->subject('Reset Password');
            });
            */

           return Redirect::route('forgotpassword')->with('success', "Please check your email for instructions on how to reset your password. {$data['link']}"); 

        }
                
    }

    public function reset($data)
    {

        if (Input::get('password1') !== Input::get('password2')) { 
            $this->messageBag->add('password', "the provided passwords do not match");
            return Redirect::route('resetpassword', array($data))->withErrors($this->messageBag);
        }

        if (Request::getMethod() == 'POST') {
            $userId = Crypt::decrypt($data);
            $response = $this->api->put("users/{$userId}", array('password' => Input::get('password1')));
            return Redirect::to('login')->with('success', "Your password has been updated successfully!"); 
        }

        return View::make('password.reset');
    }

}