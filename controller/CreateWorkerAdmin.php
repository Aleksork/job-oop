<?php

class CreateWorkerAdmin extends AController
{
    public function getBody() {

        parent::getBody();

        $row = $this->db->getUser();

        if (!isset($_SESSION['reg'])) {
            $_SESSION['reg']['login'] = NULL;
            $_SESSION['reg']['password'] = NULL;
            $_SESSION['reg']['role'] = NULL;
            $_SESSION['reg']['name'] = NULL;
            $_SESSION['reg']['DR'] = NULL;
            $_SESSION['reg']['DH'] = NULL;
            $_SESSION['reg']['info'] = NULL;
            $_SESSION['reg']['oklad'] = NULL;
            $_SESSION['reg']['comment'] = NULL;
        }
       
        if ($_SESSION['user']['role'] == "3") {
            if(isset($_POST['reg'])) {
                $msg = $this->db->registration($_POST);
    
                if($msg === TRUE) {
                    $_SESSION['msg'] = "Пользователь добавлен.";
                }
                else {
                    $_SESSION['msg'] = $msg;
                }    
                header("Location:?option=create_worker");
                exit();
            }
            if (isset($_POST['dell'])) {
                $msg = $this->db->cleanUser($_POST);
                if ($msg === TRUE) {
                    $_SESSION['msg'] = "Пользователь удалён";
                }
                else {
                    $_SESSION['msg'] = $msg;
                }  
                header("Location:?option=create_worker");
                exit();              
            }
            return $this->render('create_worker',array('row'=>$row));
        }
        else {
            if(isset($_POST['reg'])) {
                $msg = $this->db->registration($_POST);
    
                if($msg === TRUE) {
                    $_SESSION['msg'] = "Пользователь добавлен.";
                }
                else {
                    $_SESSION['msg'] = $msg;
                }    
                header("Location:?option=create_worker-admin");
                exit();
            }
            return $this->render('create_worker-admin',array('row'=>$row));
        }        
    }    
}