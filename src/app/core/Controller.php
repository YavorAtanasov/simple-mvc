<?php

Class BaseController{
	
	public function model($name){
		require_once '../app/models/' . $name . '.php';
                $model = $name."Model";
		return new $model();
	}
	
	public function view($name, $data = array()){
		require_once '../app/views/' . $name . '.php';
		
	}
}