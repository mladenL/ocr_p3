<?php

/**
* Parsing the $request object in order to call the corresponding controller and method
*/
class Dispatcher
{

	var $request;

	/**
	 * Constructor of the Dispatcher class
	 */
	function __construct()
	{
		$this->request = new Request();
		Router::parse($this->request->url, $this->request);

		$controller = $this->loadController();

		if(!in_array($this->request->action, get_class_methods($controller))) // allows to list methods from a class
		{
			$this->error('Le controller ' . $this->request->controller . ' n\'a pas de méthode ' . $this->request->action); // error message if method not found
		}

		call_user_func_array(array($controller, $this->request->action), $this->request->params); // allows to call a controller / action / parameters
		$controller->render($this->request->action); // method from Controller class
	}

	function error($message) {
		header("HTTP/1.0 404 Not Found"); // informs the browser it's a 404 error page
		$controller = new Controller($this->request);
		$controller->set('message', $message); // retrieves custom error message above
		$controller->render('/errors/404'); // method from Controller class
		die(); // need to stop the app in case of error
	}

	function loadController() {
		$name = ucfirst($this->request->controller).'Controller'; // Name of the controller is always with UpperCase
		$file = ROOT.DS.'controller'.DS.$name.'.php';
		require $file;
		return new $name($this->request); // initiates the controller dynamically
	}


}