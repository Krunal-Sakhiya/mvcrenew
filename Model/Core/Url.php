<?php 
class Model_Core_Url 
{
	public function getCurrentUrl()
	{
		echo $url = $_SERVER['REQUEST_SCHEME'];
		echo $url = $_SERVER['SERVER_NAME'];
		echo $url = $_SERVER['SCRIPT_NAME'];

		echo $url = $_SERVER['REQUEST_SCHEME'] . '/' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
	}

	public function getUrl($action = null, $controller = null, $params = [], $reset = false)
	{
		$request = new Model_Core_Request();

		$final = $request->getParam();

		if ($reset) {
			$final = [];
		}

		if ($controller) {
			$final['c'] = $controller;
		}else{
			$final['c'] = $request->getControllerName();
		}

		if ($action) {
			$final['a'] = $action; 
		}else{
			$final['a'] = $request->getActionName();
		}

		if ($params) {
			$final = array_merge($final, $params);
		}

		$queryString = http_build_query($final);
		$requestUrl = trim($_SERVER['REQUEST_URI'],$_SERVER['QUERY_STRING']);
		$url = $_SERVER['REQUEST_SCHEME']. '://' .$_SERVER['SERVER_NAME']. $requestUrl . $queryString;
		return $url;
	}
}