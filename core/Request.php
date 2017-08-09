<?php

/**
* Parses the $url requested by the user
*/
class Request
{
	
	var $url;

	function __construct() {
		if (!isset($_SERVER['PATH_INFO'])) {
			$this->url = 'pages/index';
		}

		else {
			$this->url = $_SERVER['PATH_INFO'];
		}
		
	}
}