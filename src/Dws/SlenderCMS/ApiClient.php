<?php namespace Dws\SlenderCMS;

use Zend\Http\Request as Request;
use Zend\Http\Client as Client;
use Zend\Http\Server\Client as ServerClient;
// use Dws\Slender\Api\ApiException;

class ApiClient {

    protected $host;
    protected $auth;
    protected $site;

    protected $request;
    protected $client;

    public function __construct($host, $auth=null, $site=null)
    {
        $this->host = $host;
        $this->auth = $auth;
        $this->site = $site;

        $this->request = new Request();
        $this->request->setMethod('GET');
        $this->request->getHeaders()->addHeaders(array('Authentication: ' . $this->auth));
        $this->client = new Client();
        $this->client->setAdapter('\Zend\Http\Client\Adapter\Curl');
    }

    public function setAuth($auth){
        $this->auth = $auth;
        $this->request->getHeaders()->addHeaders(array('Authentication: ' . $this->auth));
    }

    public function setSite($site)
    {
        $this->site = $site;
    }

    public function get($path){
        $this->request->setMethod(Request::METHOD_GET);
        $this->request->setUri($this->getUri($path));
        return $this->run();
    }

    public function post($path, array $params = array()){
        $this->request->setMethod(Request::METHOD_POST);
        $this->request->setUri($this->getUri($path));
        $this->request->setContent(json_encode($params));
        return $this->run();
    }

    public function options($path){
        $this->request->setMethod(Request::METHOD_OPTIONS);
        $this->request->setUri($this->getUri($path));
        return $this->run();
    }
    

    public function put($path, array $params = array()){
        $this->request->setMethod(Request::METHOD_PUT);
        $this->request->setUri($this->getUri($path));
        $this->request->setContent(json_encode($params));
        return $this->run();
    }
    
    private function run(){
        $response = $this->client->dispatch($this->request);
        // var_dump($response->getBody());
        // die;
        if($response->isSuccess()){
            return json_decode($response->getBody());
        }else{
            $error = json_decode($response->getBody());
            throw new ApiException($error);
            // var_dump($error);
        }

        return $response->isSuccess() ? $response->getBody() : false;
    }

    private function getUri($path, $site=null){
        $uri = array($this->host);
        if($this->site){
            $uri[] = $this->site;
        }
        $uri[] = $path;
        return implode("/", $uri);
    }

    /**
     * Convenience methods for returning a specific content type from the API.
     *
     * @param string $route
     * @return array
     */
    public function __call($name, $args) {

        if (method_exists($this,$name)) {
            return $this->$name;
        }

        $isPlural = (substr($name,-1) == 's');

        if (strstr($name, 'get')) {
        
            $name = ($isPlural) ? $name : $name . 's';
            $this->request->setMethod(Request::METHOD_GET);
            $endpoint = strtolower(substr($name, 3));
            $path = $this->getUri($endpoint);

            if (isset($args[0])) {
                $path = $path . "/" . $args[0];    
            }

            $this->request->setUri($path);
        
        } elseif (strstr($name, 'post')) {

            $this->request->setMethod(Request::METHOD_POST);
            $this->request->setContent(json_encode($args[0]));
            $endpoint = strtolower(substr($name, 4));
            $path = $this->getUri($endpoint);
            $this->request->setUri($path);
            $this->client->setEncType("multipart/form-data");
        
        } elseif (strstr($name, 'put')) {

            $_id = $args[0];
            $payload = $args[1];
            $this->request->setMethod(Request::METHOD_PUT);
            $this->request->setContent(json_encode($payload));
            $endpoint = strtolower(substr($name, 3));
            $path = $endpoint . '/' . $_id;
            $path = $this->getUri($path);
            $this->request->setUri($path);
            $this->client->setEncType("multipart/form-data");

        }

        $response = $this->run();
        
        if (!$isPlural || $this->request->getMethod() != 'GET') {
            $response = $response->$endpoint;
            return $response[0];
        }

        return $response;
    } 



}


