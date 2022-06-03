<?php

class EditInformUser extends AController
{
    public function getBody() {

        parent::getBody();
        
        if ($_SESSION['user']['role'] == "3") {
            if (isset($_GET['id']) && $_GET['id'] != '0' && is_numeric($_GET['id'])) {
                $id = $_GET['id'];
                $text = $this->db->getIdStatti($id);
                if ($text === FALSE) {
                    header("Location:index.php?option=edit_user");
                }
                if (isset($_POST['edit'])) {
                $id = $_GET['id'];
                $msg = $this->db->getEditInform($_POST);
                    if($msg === TRUE) {
                        $_SESSION['msg'] = "Данные изменены.";
                        session_write_close();
                        header("Location:index.php?option=edit_user&id=" . $id);
                    }
                    else {
                        $_SESSION['msg'] = $msg;
                    }
                }
                return $this->render('edit_inform-user',array('text'=>$text));
            }
            else {
                header("Location:index.php?option=edit_user");
            }
        }
        else {
            if (isset($_GET['id']) && $_GET['id'] != '0' && is_numeric($_GET['id'])) {
                $id = $_GET['id'];
                $text = $this->db->getIdStatti($id);
                if ($text === FALSE) {
                    header("Location:index.php?option=edit_user-admin");
                }
                if (isset($_POST['edit'])) {
                $id = $_GET['id'];
                $msg = $this->db->getEditInform($_POST);
                    if($msg === TRUE) {
                        $_SESSION['msg'] = "Данные изменены.";
                        session_write_close();
                        header("Location:index.php?option=edit_user-admin&id=" . $id);
                    }
                    else {
                        $_SESSION['msg'] = $msg;
                    }
                }
                return $this->render('edit_inform-user',array('text'=>$text));
            }
            else {
                header("Location:index.php?option=edit_user-admin");
            }
        }
    }
}