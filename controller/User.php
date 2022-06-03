<?php

class User extends AController
{
    public function getBody() {

        parent::getBody();

        if (isset($_SESSION['user'])) {
            $id = (int)$_SESSION['user']['user_id'];

            if ($id != 0) {
                $text = $this->db->getUserEdit($id);
            }            
            if ($_SESSION['user']['user_id'] == $_GET['id']) {
                $coef = $this->db->coefficient($id);
                $work = $this->db->getCompletedWork($id);
                $add_work = $this->db->addWork($id);
                return $this->render('user',array('text'=>$text, 'work'=>$work, 'add_work'=>$add_work, 'coef'=>$coef));
            }
            else {
                header("Location:index.php?option=user&id=". $_SESSION['user']['user_id']);
            }
        }
        else {
            header("Location:index.php?option=login");
			exit();
        }
    }
}