<?php

class CreateTypeWork extends AController
{
    public function getBody() {

        parent::getBody();

        if (isset($_SESSION['user'])) {
            $id = (int)$_SESSION['user']['role'];
            if ($id != '3') {
                header("Location:index.php?option=login");
                exit();
            }
            $work = $this->db->idPrice();        
       
            if(isset($_POST['type_work'])) {
                $msg = $this->db->createTypeWork($_POST);
                if($msg === TRUE) {
                    $_SESSION['msg'] = "Тип работы добавлен";
                    session_write_close();
                    header("Location:index.php?option=create_type-work");
                }
                else {
                    $_SESSION['msg'] = $msg;
                }
            }
            return $this->render('create_type-work',array('work'=>$work));
        }
        else {
            header("Location:index.php?option=login");
            exit();
        }
        
    }
}