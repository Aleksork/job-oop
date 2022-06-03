<?php

class EditUserAdmin extends AController
{
    public function getBody() {

        parent::getBody();

        if (isset($_SESSION['user'])) {
            $id = (int)$_SESSION['user']['role'];
            if ($id != '2') {
                header("Location:index.php?option=login");
                exit();
            }
            if (isset($_GET['id']) && $_GET['id'] != '0' && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            $text = $this->db->getUserEdit($id);
                if ($text === FALSE) {
                    header("Location:index.php?option=worker_job-admin");
                }
                $coef = $this->db->coefficient($id);
                $work = $this->db->getCompletedWork($id);
                $add_work = $this->db->addWork($id);
                return $this->render('edit_user-admin',array('text'=>$text, 'work'=>$work, 'add_work'=>$add_work, 'coef'=>$coef));
            }
            else {
                header("Location:index.php?option=worker_job-admin");
            }
        }
        else {
            header("Location:index.php?option=login");
            exit();
        }
    }
}