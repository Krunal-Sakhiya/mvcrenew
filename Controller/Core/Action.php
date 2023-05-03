<?php
class Controller_Core_Action  
{
    protected $request = null;
    protected $adapter = null;
    protected $view = null;
    protected $layout = null;
    protected $url = null;
    // protected $layout = null;

    public function setRequest(Model_Core_Request $request)
    {
        $this->request = $request;
        return $this;
    }

    public function getRequest()
    {
        if ($this->request) {
            return $this->request;
        }

        $request = new Model_Core_Request();
        $this->setRequest($request);
        return $request;
    }

    public function setAdapter(Model_Core_Adapter $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function getAdapter()
    {
        if ($this->adapter) {
            return $this->adapter;
        }

        $adapter = new Model_Core_Adapter();
        $this->setAdapter($adapter);
        return $adapter;
    }

    public function setView(Model_Core_View $view)
    {
        $this->view = $view;
        return $this;
    }

    public function getView()
    {
        if ($this->view) {
            return $this->view;
        }

        $view = new Model_Core_View();
        $this->setView($view);
        return $view;
    }

    public function setLayout(Block_Core_Layout $layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function getLayout()
    {
        if ($this->layout) {
            return $this->layout;
        }

        $layout = new Block_Core_Layout();
        $this->setLayout($layout);
        return $layout;
    }

    public function getUrl()
    {
        if ($this->url) {
            return $this->url;            
        }

        $url = new Model_Core_Url();
        $this->setUrl($url);
        return $url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }


    public function getTemplate($templatePath)
    {
        require "View".DS.$templatePath;
    }

    public function render()
    {
        $this->getView()->render();
    }

    public function redirect($action = null,$controller = null,$params = [],$reset = false)
    {
        $url = $this->getUrl()->getUrl($action,$controller,$params,$reset);
        header("location:{$url}");
        exit();
    }

    public function errorAction($action)
    {
        throw new Exception("method: {$action} does not exists");
    }

    
}