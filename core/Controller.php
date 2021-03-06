<?php 

/**
* Main Controller object
*/
class Controller
{

	public $request;
	private $vars = array();
	public $layout = 'default';
	private $rendered = false;	// was the view rendered already ? default = no

	function __construct($request) {
		$this->request = $request;
	}

	public function render($view) {
		if ($this->rendered) {return false;}
		extract($this->vars);
			if (stripos($view, '/') === 0) {			// if the string starts with '/'
				$view = ROOT.DS.'view'.$view.'.php';	// call the view by ignoring '/'
			} else {
				$view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
			}
		
		ob_start();
		require $view;
		$layout_content = ob_get_clean();
		require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
		$this->rendered = true;		// remembers the view has already been rendered
	}

	public function set($key, $value=null) { // Handles the parameters from the URL
		if(is_array($key)) {
			$this->vars += $key;
		} else {
		$this->vars[$key] = $value;	
		}

	}

}
 ?>