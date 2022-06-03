<?php

class EditWork extends AController
{
    public function getBody() {

        parent::getBody();

        $work = $this->db->idPrice();
        $comm = $this->db->comment($_GET);

        if ($_SESSION['user']['role'] == "3") {
            if (isset($_GET['id']) && $_GET['id'] != '0' && is_numeric($_GET['id'])) {
                $id = $_GET['id'];
                $text = $this->db->getUserEdit($id);
                if ($text === FALSE) {
                    header("Location:index.php?option=worker_job");
                }
                if(isset($_POST['work'])) {
                    $msg = $this->db->commEdit($_POST);
                    if($msg === TRUE) {
                        $_SESSION['msg'] = "Работа отредактирована.";
                        session_write_close();
                        header("Location:index.php?option=edit_user&id=" . $id);
                    }
                    else {
                        $_SESSION['msg'] = $msg;
                    }
                }
                return $this->render('edit_work',array('text'=>$text, 'work'=>$work, 'comm'=>$comm));
                }
                else {
                    header("Location:index.php?option=worker_job");
                }
        }
        else {
            if (isset($_GET['id']) && $_GET['id'] != '0' && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            $text = $this->db->getUserEdit($id);
            if ($text === FALSE) {
                header("Location:index.php?option=worker_job-admin");
            }
            if(isset($_POST['work'])) {
                $msg = $this->db->commEdit($_POST);
                if($msg === TRUE) {
                    $_SESSION['msg'] = "Работа отредактирована.";
                    session_write_close();
                    header("Location:index.php?option=edit_user-admin&id=" . $id);
                }
                else {
                    $_SESSION['msg'] = $msg;
                }
            }
            return $this->render('edit_work',array('text'=>$text, 'work'=>$work, 'comm'=>$comm));
            }
            else {
                header("Location:index.php?option=worker_job-admin");
            }
        }
    }
}