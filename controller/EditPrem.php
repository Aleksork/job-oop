<?php

class EditPrem extends AController
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
                if (isset($_GET['add']) && $_GET['add'] != '0' && is_numeric($_GET['add'])){
                    $add = $_GET['add'];
                    $text = $this->db->getUserEdit($id);
                    $add_work = $this->db->addWork_1($add);
                    if (isset($_POST['work'])) {
                        $msg = $this->db->addEdit($_POST);
                        if ($msg === TRUE) {
                            $_SESSION['msg'] = "Работа отредактирована";
                        }
                        else {
                            $_SESSION['msg'] = $msg;
                            header("Location:" . $_SERVER['REQUEST_URI']);
                            exit();
                        }
                    header("Location:?option=edit_user&id=". $id);
                    exit();
                    }
                    return $this->render('edit_prem',array('text'=>$text, 'add_work'=>$add_work));
                }
                else {
                    header("Location:?option=edit_user&id=". $id);
                    exit();
                }
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