<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller {

	public function __construct() {
		$this->init();
	}

	public function index() {
		return $this->response->warning('Page not found. [index]');
	}

	public function apiExample() {
		return $this->response->success("Welcome apiExample", $this->request);
	}

	public function example() {
		return $this->response->success("Welcome example", $this->request);
	}

}