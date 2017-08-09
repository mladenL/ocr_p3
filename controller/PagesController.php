<?php

/**
 * Handles the rendering of views with requested parameters
 */

class PagesController extends Controller
{
	function index() {

		$this->set(array(
			'phrase' => 'Salut, ',
			'nom' => 'Mladen'
		));
		
		$this->render('index');
	}
}