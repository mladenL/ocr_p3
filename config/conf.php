<?php 

/**
* Contains DB connexion info
*/
class Conf
{
	
	static $databases = array(

	'default' => array(
			'host' => 'localhost',
			'dbname' => 'ocrp3',
			'login' => 'root',
			'passwd' => 'root',
			'port' => '8889',
			'charset' => 'utf8'
		)

	);

	function __construct()
	{
		# code...
	}
}
