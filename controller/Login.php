<?php

class Login extends AController
{
    public function getBody() {

        parent::getBody();

        if($this->isPost()) {
            $login = $this->db->clean_data($_POST['login']);
            $password = $this->db->clean_data($_POST['password']);

            $msg = $this->db->login($login,$password);
            
            if($msg) {
                $id = $msg['user_id'];
				switch ($msg['role']) {
                case '1':
                    header("Location:index.php?option=user&id=". $id);
                    exit();
                    break;
                case '2':
                    header("Location:index.php?option=admin");
                	exit();
                    break;
                case '3':
                    header("Location:index.php?option=supadmin");
                    exit();
                    break;
                }
            }			
			header("Location:index.php?option=login");
			exit();            
        }
        return $this->render('login');
    }
}
