<?php

use Dws\Slender\Api\ApiException;

class BaseController extends Controller {

	public $api;
	protected $package; 
    protected $base_url;
    protected $displayFields = array(
                                'title' => 'Title'
                            );
	public function __construct(){
		$this->api = App::make('api');

		if(Auth::check()){
			$this->api->setAuth(Auth::user()->key);
		}

        $this->base_url = Config::get('slender-cms::cms.admin-url');
	}
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
        if ( ! is_null($this->layout))
        {
			$this->layout = View::make($this->layout);
		}
	}


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $response = $this->api->get($this->package);
        return View::make('slender-cms::base/index')
                        ->with('package', $this->package)
                        ->with('displayFields', $this->displayFields)
                        ->with('data', $response->{$this->package});
    }

	/**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $options = $this->api->options($this->package);
        if(isset($options->PUT)){
        	// $method = 'PUT';
        	$method = 'POST'; //
        	$options = $options->PUT;
        }elseif(isset($options->POST)){
        	$method = 'POST';
        	$options = $options->POST;
        }

        return View::make('slender-cms::base/new')
        				->with('package', $this->package)
        				->with('method', $method)
        				->with('options', $options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    { 
    	$data = Input::all();

        try {
            $response = $this->api->post($this->package, $data);
        } catch (ApiException $e) {
            $errors = new MessageBag;
            $messages = $e->getMessages();
            foreach ($messages[0] as $key => $value) {
                foreach ($value as $msg) {
                    $errors->add($key, $msg);
                }
            }
            return Redirect::to("{$this->base_url}/{$this->package}/create")->withErrors($errors);
        }    
        return Redirect::to("{$this->base_url}/{$this->package}")->with('success', 'The data successfully saved!');;    
    }

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
            return View::make('slender-cms::base/edit')
                        ->with('data', $response)
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
        $data = Input::all();
        
        if(isset($data['_method'])){
            unset($data['_method']);
        }

        try {
            $response = $this->api->put($this->package."/".$id, $data);
        } catch (ApiException $e) {
            $errors = new MessageBag;
            $messages = $e->getMessages();
            foreach ($messages[0] as $key => $value) {
                foreach ($value as $msg) {
                    $errors->add($key, $msg);
                }
            }
            return Redirect::to("{$this->base_url}/{$this->package}/".$id)->withErrors($errors);
        }
        
        return Redirect::to("{$this->base_url}/{$this->package}")->with('success', 'The data successfully saved!');;
    }

}
