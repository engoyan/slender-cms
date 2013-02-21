<?php

class RolesController extends BaseController {

	protected $package = 'roles'; 
    protected $displayFields = array(
                                'name' => 'Name'
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
            // get options for roles
            $options = $this->api->options($this->package);
            $method = 'POST';
            $options = $options->PUT;

            // get sites for options
            $sites = $this->api->get('sites');

            return View::make('slender-cms::roles/edit')
                        ->with('data', $response)
                        ->with('sites', $sites->sites)
                        ->with('package', $this->package)
                        ->with('method', $method)
                        ->with('options', $options);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $options = $this->api->options($this->package);
        $method = 'POST';
        $options = $options->PUT;

        // get sites for options
        $sites = $this->api->get('sites');

        return View::make('slender-cms::roles/new')
                    ->with('sites', $sites->sites)
                    ->with('package', $this->package)
                    ->with('method', $method)
                    ->with('options', $options);
    }

}
