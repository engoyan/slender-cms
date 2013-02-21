<?php

class UsersController extends BaseController {

	protected $package = 'users';

    protected $displayFields = array(
                                'first_name' => 'First Name',
                                'last_name' => 'Last Name',
                                'email' => 'Email'

                            );

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show($id)
    {
        $response = $this->api->get($this->package."/".$id);

        if($response = $response->{$this->package}[0]){
            $options = $this->api->options($this->package);
            $method = 'POST';
            $options = $options->PUT;

            $roles = $this->api->get("roles");

            return View::make('slender-cms::users/edit')
                        ->with('roles', $roles->roles)
                        ->with('user', $response)
                        ->with('package', $this->package)
                        ->with('method', $method)
                        ->with('options', $options);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update($id)
    {
        // Declare the rules for the form validation.
        //
        $rules = array();

        // Get all the inputs.
        //
        $inputs = Input::all();

        // If we are updating the password.
        //
        if(Input::get('password')){
            // Update the validation rules.
            //
            $rules['password']              = 'Required|Confirmed';
            $rules['password_confirmation'] = 'Required';
        }else{
            // unset password fields once we are not updateing it
            //
            $input = Input::except(array('password', 'password_confirmation'));
            Input::replace($input);           
        }

        // Validate the inputs.
        //
        $validator = Validator::make($inputs, $rules);

        // Check if the form validates with success.
        //
        if ($validator->fails())
        {
            // Something went wrong.
            //
            return Redirect::to("/{$this->base_url}/{$this->package}/".$id)->withErrors($validator->messages());
        }

        return parent::update($id);
    }


	public function destroy($id)
	{
        $response = $this->api->delete("users/" . $id);
        return Redirect::to("/{$this->base_url}/{$this->package}");
	}

}
