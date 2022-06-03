<?php

class Supadmin extends AController
{
    public function getBody() {
        
        parent::getBody();

        if (isset($_SESSION['user'])) {
            $id = (int)$_SESSION['user']['role'];
            if ($id != '3') {
                header("Location:index.php?option=login");
                exit();
            }
            return $this->render('supadmin');
        }
        else {
            header("Location:index.php?option=login");
            exit();
        }
    }
}