<?php

abstract class AController
{
    public $db;
    public $user;

    public function getBody() {
        $this->db = new Model(HOST,USER,PASS,DB);

        // $this->user = $this->db->get_all_db();
        // return $this->user;
    }

    protected function render($file, $params = array()) {
		extract($params);
		
		ob_start();
		
		include('view'.DIRECTORY_SEPARATOR.$file.'.php');
		
		return ob_get_clean();
	}
	//Функция проверки отправлены ли данные методом GET
	// protected function isGet() {
	// 	return $_SERVER['REQUEST_METHOD'] == 'GET';
	// }
	
	//Функция проверки отправлены ли данные методом POST
	protected function isPost() {
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}
}