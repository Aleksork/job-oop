<?php

class WorkerJobAdmin extends AController
{
    public function getBody() {

        parent::getBody();

        if (isset($_SESSION['user'])) {
            $id = (int)$_SESSION['user']['role'];
            if ($id != '2') {
                header("Location:index.php?option=login");
                exit();
            }
            $row = $this->db->getUser();
            return $this->render('worker_job-admin',array('row'=>$row));
        }
        else {
            header("Location:index.php?option=login");
            exit();
        }
    }
}