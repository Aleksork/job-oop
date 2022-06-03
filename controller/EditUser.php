<?php

class EditUser extends AController
{
    public function getBody() {

        parent::getBody();

        if (isset($_SESSION['user'])) {
            $id = (int)$_SESSION['user']['role'];
            if ($id != '3') {
                header("Location:index.php?option=login");
                exit();
            }
            if (isset($_GET['id']) && $_GET['id'] != '0' && is_numeric($_GET['id'])) {
                $id = $_GET['id'];
                $text = $this->db->getUserEdit($id);
                if ($text === FALSE) {
                    header("Location:index.php?option=worker_job");
                }
                $coef = $this->db->coefficient($id);
                $work = $this->db->getCompletedWork($id);
                $add_work = $this->db->addWork($id);
                if (isset($_POST['dell'])) {
                    $msg = $this->db->cleanComWork($_POST);
                    if ($msg === TRUE) {
                        $_SESSION['msg'] = "Работа удалена";
                    }
                    else {
                        $_SESSION['msg'] = $msg;
                    }  
                    header("Location:?option=edit_user&id=". $id);
                    exit();
                }
                if (isset($_POST['dell_add'])) {
                    $msg = $this->db->cleanAddWork($_POST);
                    if ($msg === TRUE) {
                        $_SESSION['msg'] = "Дополнительная работа удалена";
                    }
                    else {
                        $_SESSION['msg'] = $msg;
                    }  
                    header("Location:?option=edit_user&id=". $id);
                    exit();              
                }
                return $this->render('edit_user',array('text'=>$text, 'work'=>$work, 'add_work'=>$add_work, 'coef'=>$coef));
            }
            else {
                header("Location:index.php?option=worker_job");
            }
        }
        else {
            header("Location:index.php?option=login");
            exit();
        }
        
    }
}