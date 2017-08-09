<?php

/**
* Parses the $url object 
* @param $url
* @return array with $url parameters
*/
class Router
{
	
	static function parse($url, $request)
	{
		$url = trim($url, '/'); // the first '/' creates a bug. Removed.
		$params = explode('/', $url);	// the string in converted into array. Data is separated by /
		$request->controller = isset($params[0]) ? $params[0] : 'pages'; // first entry in the array is the controller. Pages by default.
		$request->action = isset($params[1]) ? $params[1] : 'index'; // second entry in the method. Index by default
		$request->params = $r['params'] = array_slice($params, 2); // if any further parameter, they are stored in array $r

		return $r;

	}
}