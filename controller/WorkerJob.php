<?php

class WorkerJob extends AController
{
    public function getBody() {

        parent::getBody();

        if (isset($_SESSION['user'])) {
            $id = (int)$_SESSION['user']['role'];
            if ($id != '3') {
                header("Location:index.php?option=login");
                exit();
            }
            $row = $this->db->getUser();

            return $this->render('worker_job',array('row'=>$row));
        }
        else {
            header("Location:index.php?option=login");
            exit();
        }
    }
}