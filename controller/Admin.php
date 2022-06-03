<?php

class Admin extends AController
{
    public function getBody() {

        parent::getBody();
        
        if (isset($_SESSION['user'])) {
            $id = (int)$_SESSION['user']['role'];
            if ($id != '2') {
                header("Location:index.php?option=login");
                exit();
            }
            return $this->render('admin');
        }
        else {
            header("Location:index.php?option=login");
            exit();
        }        
    }
}