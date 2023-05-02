<?php
class Controller_Core_Front
{
	protected $request = null;

    public function setRequest($request)
    {
        $this->request = $request;
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

    public function init()
    {
        // $session = Ccc::getModel('Core_Message')->getSession()->start();
    	$request = $this->getRequest();

        $controllerName = $request->getControllerName();
        $controllerClassName = 'Controller_'.ucwords($controllerName, '_');

        $controllerPathName = str_replace('_', '/', $controllerClassName);
        require_once $controllerPathName.'.php';

        $controller = new $controllerClassName();
        $actionName = $request->getActionName().'Action';

        if (method_exists($controller, $actionName) == false) {
            $controller->errorAction($actionName);
        } else {
            $controller->$actionName();
        }
        
    }
}