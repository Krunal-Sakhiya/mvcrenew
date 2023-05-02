<?php
class Model_Core_View 
{
	protected $template = null;
	protected $data = [];

	function __construct()
	{
		// code...
	}

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    public function getData($key = null)
    {
    	if (!$key) {
    		return $this->data;
    	}

    	if (array_key_exists($key, $this->data)) {
    		return $this->data[$key];
    	}

        return null;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function addData($key, $value)
    {
    	return $this->data[$key] = $value;
    }

    public function removeData($key)
    {
    	if (!$key) {
    		return $this->data = [];
    	}

    	if (array_key_exists($key, $this->data)) {
    		unset($this->data[$key]);
    	}

    	return $this;
    }

    public function __set($key, $value)
    {
    	return $this->data[$key] = $value;
    }

    public function __get($key)
    {
    	if (!$key) {
    		return $this->data;
    	}

    	if (array_key_exists($key, $this->data)) {
    		return $this->data[$key];
    	}
    	return null;
    }

    public function __unset($key)
    {
		unset($this->data[$key]);
    }

    public function render()
    {
    	require "view".DS.$this->getTemplate();
    }

    public function getUrl($controller = null, $action = null, $params = [], $reset = false)
    {
    	return Ccc::getModel('Core_Url')->getUrl($controller, $action, $params, $reset);
    }
}