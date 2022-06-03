<?php

class CreateCoof extends AController
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
                if (isset($_POST['coof'])) {
                    $msg = $this->db->addCoff($_POST);
                    if ($msg === TRUE) {
                        $_SESSION['msg'] = "Коэффициент изменён";
                        session_write_close();
                        header("Location:index.php?option=edit_user&id=" . $id);
                    }
                    else {
                        $_SESSION['msg'] = $msg;
                    }
                }
            }
            return $this->render('create_coof',array('text'=>$text));
        }
        else {
            header("Location:index.php?option=login");
            exit();
        }
    }
}