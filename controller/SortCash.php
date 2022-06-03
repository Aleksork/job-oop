<?php

class SortCash extends AController
{
    public function getBody() {

        parent::getBody();

        if (isset($_GET['id']) && $_GET['id'] != '0' && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            $text = $this->db->getUserEdit($id);

            $_SESSION['vsego'] = '';
            $_SESSION['summa'] = '';

            if (isset($_POST['with'])) {
                $msg = $this->db->sort_cash($_POST);
                if ($msg === FALSE) {
                    $_SESSION['msg'] = "Работы не найдены!";
                }
                return $this->render('sort_cash',array('text'=>$text, 'msg'=>$msg));
                exit;
            }
        }
        return $this->render('sort_cash',array('text'=>$text));
    }
}