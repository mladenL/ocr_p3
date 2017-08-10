<?php

/**
 * Handles the rendering of views with requested parameters
 */

class PagesController extends Controller
{
	function view($id) {

		$this->loadModel('Post');
		$posts = $this->Post->find(array(
			'conditions' => 'id=1',
			));

	}
}