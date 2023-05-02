<?php
class Controller_Core_Action
{
	protected $adapter = null;
	protected $request = null;
	protected $view = null;
	protected $url = null;
	protected $layout = null;
	protected $message = null;
	protected $response = null;

    public function getAdapter()
    {
    	if ($this->adapter) {
    		$this->adapter;
    	}

    	$adapter = new Model_Core_Adapter();
    	$this->setAdapter($adapter);
        return $this->adapter;
    }
    
    public function setAdapter(Model_Core_Adapter $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function getRequest()
    {
    	if ($this->request) {
    		$this->request;
    	}

    	$request = new Model_Core_Request();
    	$this->setRequest($request);
        return $this->request;
    }

    public function setRequest(Model_Core_Request $request)
    {
        $this->request = $request;
        return $this;
    }

    public function getView()
    {
    	if ($this->view) {
    		$this->view;
    	}

    	$view = new Model_Core_View();
    	$this->setView($view);
        return $this->view;
    }

    public function setView(Model_Core_View $view)
    {
        $this->view = $view;
        return $this;
    }

    public function getUrl()
    {
    	if ($this->url) {
    		$this->url;
    	}

    	$url = new Model_Core_Url();
    	$this->setUrl($url);
        return $this->url;
    }

    public function setUrl(Model_Core_Url $url)
    {
        $this->url = $url;
        return $this;
    }

    public function getLayout()
    {
    	if ($this->layout) {
    		$this->layout;
    	}

    	$layout = new Block_Core_Layout();
    	$this->setLayout($layout);
        return $this->layout;
    }

    public function setLayout(Block_Core_Layout $layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function getMessage()
    {
    	if ($this->message) {
    		$this->message;
    	}

    	$message = new Model_Core_Message();
    	$this->setMessage($message);
        return $this->message;
    }

    public function setMessage(Model_Core_Message $message)
    {
        $this->message = $message;
        return $this;
    }

    public function getResponse()
    {
    	if ($this->response) {
    		$this->response;
    	}

    	$response = new Model_Core_Response();
    	$response->setController($this);
    	$this->setResponse($response);
        return $this->response;
    }

    protected function setTitle($title)
    {
    	$this->getLayout()->getChild('head')->setTitle($title);
    	return $this;
    }

    public function setResponse(Model_Core_Response $response)
    {
        $this->response = $response;
        return $this;
    }

    public function getTemplate($templatePath)
    {
    	require "view".DS.$templatePath;
    }

    public function renderLayout()
    {
    	$this->getResponse()->setBody($this->getLayout()->toHtml());
    }

    public function redirect($controller = null, $action = null, $params = [], $reset = false)
    {
    	$url = $this->getView()->getUrl($controller, $action, $params, $reset);
    	header("location: {$url}");
    	exit();
    }

    public function errorAction($action)
    {
    	throw new Exception("Method : {$action} Does Not Exists", 1);
    }
}