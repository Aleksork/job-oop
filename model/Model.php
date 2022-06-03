<?php

class Model
{
    public $db;

    public function __construct($host,$user,$pass,$db) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->db = new mysqli($host, $user, $pass);
        if (!$this->db) {
            exit('НЕТ СОЕДИНЕНИЯ С БАЗОЙ!!!');
        }
        if (!$this->db->select_db($db)) {
            exit('НЕТ ВЫБРАННОЙ ТАБЛИЦЫ');
        }
        $this->db->set_charset('utf8mb4');

        return $this->db;
    }

    public function getUser() {
        $sql = "SELECT `user_id`, `name`, `DR`, `DH`, `info`, `oklad`, `comment`, `date` FROM `user`";
        $result = $this->db->query($sql);
        if(!$result) {
			return FALSE;
		}
		for ($i = 0; $i < mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_assoc();
		}
		
		return $row;
    }

	public function getUserEdit($id) {
		$sql = "SELECT `user_id`, `name`, `oklad`, `coefficient`, `DR`, `DH`, `info`, `comment` FROM `user` WHERE `user_id` = '%s'";
		$sql = sprintf($sql, $this->db->real_escape_string($id));
		$result = $this->db->query($sql);
		if(!$result) {
			return FALSE;
		}
		if (mysqli_num_rows($result) < 1) {
			return FALSE;
		}
		for ($i = 0; $i < mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_assoc();
		}
		
		return $row;
	}

	public function getCompletedWork($id) {
		$sql = "SELECT `user_id`, `rec_num`, `date`, `type_work`, `price`, `comm`, `grade` FROM `completed_work` WHERE `user_id` = '%s'";
		$sql = sprintf($sql, $this->db->real_escape_string($id));
		$result = $this->db->query($sql);
		if(!$result) {
			return FALSE;
		}
		if (mysqli_num_rows($result) < 1) {
			return FALSE;
		}
		for ($i = 0; $i < mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_assoc();
		}

		return $row;
	}

	public function getIdStatti($id) {
		$sql = "SELECT `login`, `password`, `name`, `DR`, `DH`, `info`, `oklad`, `comment`, `role` FROM `user` WHERE `user_id` = '%s'";
		$sql = sprintf($sql, $this->db->real_escape_string($id));
		$result = $this->db->query($sql);
		for ($i = 0; $i < mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_assoc();
		}

		return $row;
	}

	public function addWork($id) {		
		$sql = "SELECT * FROM `additional_work` WHERE `user_id` = '%s'";
		$sql = sprintf($sql, $this->db->real_escape_string($id));
		$result = $this->db->query($sql);
	
		if (!$result) {
			exit(mysqli_error($this->db));
		}
		for($i = 0; $i<mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_assoc();
		}	
		return $row;
	}
	
	public function addWork_1($add) {		
		$sql = "SELECT `type_work`, `price`, `comment` FROM `additional_work` WHERE `id` = '%s'";
		$sql = sprintf($sql, $this->db->real_escape_string($add));
		$result = $this->db->query($sql);
	
		if (!$result) {
			exit(mysqli_error($this->db));
		}
		for($i = 0; $i<mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_assoc();
		}	
		return $row;
	}

	public function addEdit($post) {
		$work = $this->clean_data($post['work']);
		$cash = $this->clean_data($post['cash']);
		$comm = $this->clean_data($post['comm']);
		$add = $this->clean_data($_GET['add']);

		if(empty($work)) {			
			return "Введите работу";
		}
		if(empty($cash)) {			
			return "Введите цену";
		}
		if(empty($comm)) {			
			return "Введите комментарий";
		}
	
		$sql = "UPDATE `additional_work` SET `type_work` = '%s', `price` = '%s', `comment` = '%s' WHERE `additional_work`.`id` = '%s'";
		$sql = sprintf($sql, 
		$this->db->real_escape_string($work),
		$this->db->real_escape_string($cash),
		$this->db->real_escape_string($comm),
		$this->db->real_escape_string($add));
	
		$result = $this->db->query($sql);
		if (!$result) {
			exit(mysqli_error($this->db));
		}
		else {
			return TRUE;
		}
	}

	public function saveAddWork($post) {
		$user_id = $this->clean_data($_GET['id']);
		$date = date("Y-m-d", time());
		$work = $this->clean_data($post['work']);
		$cash = $this->clean_data($post['cash']);
		$comm = $this->clean_data($post['comm']);
		$admin_id = $_SESSION['user']['name'];

		if(empty($work)) {			
			return "Введите работу";
		}
		if(empty($cash)) {			
			return "Введите цену";
		}
		if(empty($comm)) {			
			return "Введите комментарий";
		}

		$sql = "INSERT INTO `additional_work` (`id`, `type_work`, `price`, `comment`, `user_id`, `date`, `admin_id`) VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s')";
		$sql = sprintf($sql, 
		$this->db->real_escape_string($work),
		$this->db->real_escape_string($cash),
		$this->db->real_escape_string($comm),
		$this->db->real_escape_string($user_id),
		$date,
		$this->db->real_escape_string($admin_id));

		$result = $this->db->query($sql);
		if (!$result) {
			exit(mysqli_error($this->db));
		}
		else {
			return TRUE;
		}
	}

	public function coefficient($id) {
		$sql = "SELECT * FROM `coeff` WHERE `user_id` = '%s'";
		$sql = sprintf($sql, $this->db->real_escape_string($id));
		$result = $this->db->query($sql);

		if (!$result) {
			exit(mysqli_error($this->db));
		}
		if (mysqli_num_rows($result) >= 1) {
			for($i = 0; $i<mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_assoc();
			}
			return $row;
		}
	}

	public function addCoff($post) {
		$user_id = $this->clean_data($_GET['id']);
		$coeff = $this->clean_data($post['coof']);
		$comm_cof = $this->clean_data($post['comm_cof']);
		$date = date("d.m.Y", time());

		if(empty($coeff)) {			
			return "Введите коэффициент";
		}
		if(empty($comm_cof)) {			
			return "Введите коментарий";
		}
	
		$sql = "INSERT INTO `coeff` (`id`, `user_id`, `date_cof`, `comm_cof`, `coff`) VALUES (NULL, '%s', '%s', '%s', '%s')";
		$sql = sprintf($sql,
		$this->db->real_escape_string($user_id),
		$date,
		$this->db->real_escape_string($comm_cof),
		$this->db->real_escape_string($coeff));
	
		$result = $this->db->query($sql);
		if (!$result) {
			exit(mysqli_error($this->db));
		}
		
		$sql_2 = "UPDATE `user` SET `coefficient` = '%s' WHERE `user`.`user_id` = '%s'";
		$sql_2 = sprintf($sql_2,
		$this->db->real_escape_string($coeff),
		$this->db->real_escape_string($user_id));

		$result_2 = $this->db->query($sql_2);
		if (!$result_2) {
			exit(mysqli_error($this->db));
		}
		else {
			return TRUE;
		}
	}

    public function clean_data($str) {
		return strip_tags(trim($str));
	}

	public function createTypeWork($post) {		
		$type_work = $this->clean_data($post['type_work']);
		$price = $this->clean_data($post['price']);
		$sql = "INSERT INTO `price_work` (`id`, `type_work`, `price`) VALUES (NULL, '%s', '%s')";
		$sql = sprintf($sql,
		$this->db->real_escape_string($type_work),
		$this->db->real_escape_string($price));

		$result = $this->db->query($sql);
	
		if (!$result) {
			exit(mysqli_error($this->db));
		}
		return TRUE;
	}

	public function idPrice() {		
		$sql = "SELECT * FROM `price_work`";
		$result = $this->db->query($sql);
		if (!$result) {
			exit(mysqli_error($this->db));
		}
		for($i = 0; $i<mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_assoc();
		}	
		return $row;
	}

	public function SaveWork($post) {
		$user_id = $_GET['id'];
		$date = date("Y-m-d", time());
		$id = $this->clean_data($post['work']);
		$comm = $this->clean_data($post['comm']);
		$grade = $this->clean_data($post['grade']);
		$admin_id = $_SESSION['user']['name'];

		if(empty($comm)) {			
			return "Введите комментарий";
		}

		$sql = "SELECT * FROM `price_work` WHERE `id` = '%s' ORDER BY `id` ASC";
		$sql = sprintf($sql, $this->db->real_escape_string($id));
		$result = $this->db->query($sql);
		for ($i = 0; $i < mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_assoc();
		}
		$price = $row['0']['price'];
		$type_work = $row['0']['type_work'];

		$sql = "INSERT INTO `completed_work` (`rec_num`, `user_id`, `date`, `id`, `type_work`, `price`, `comm`, `grade`, `admin_id`) VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
		$sql = sprintf($sql, 
			$this->db->real_escape_string($user_id),
			$date,
			$this->db->real_escape_string($id),
			$this->db->real_escape_string($type_work),
			$this->db->real_escape_string($price),
			$this->db->real_escape_string($comm),
			$this->db->real_escape_string($grade),
			$this->db->real_escape_string($admin_id));
			$result = $this->db->query($sql);
			if (!$result) {
				exit(mysqli_error($this->db));
			}
			else {
				return TRUE;
			}
	}

	public function comment($id) {		
		$id = $id['comm'];
		$sql = "SELECT * FROM `completed_work` WHERE `rec_num` = '$id'";	
		$result = $this->db->query($sql);
	
		if (!$result) {
			exit(mysqli_error($this->db));
		}
		for($i = 0; $i<mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_assoc();
		}	
		return $row;
	}

	public function commEdit($post) {
		$id = $this->clean_data($post['work']);
		$comm = $this->clean_data($post['comm']);
		$grade = $this->clean_data($post['grade']);
		$id_comm = $_GET['comm'];
		$admin_id = $_SESSION['user']['name'];

		if(empty($comm)) {			
			return "Введите комментарий";
		}

		$sql = "SELECT * FROM `price_work` WHERE `id` = '%s' ORDER BY `id` ASC";
		$sql = sprintf($sql, $this->db->real_escape_string($id));
		$result = $this->db->query($sql);
		for ($i = 0; $i < mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_assoc();
		}
		$price = $row['0']['price'];
		$type_work = $row['0']['type_work'];

		$sql = "UPDATE `completed_work` SET `id` = '%s', `type_work` = '%s', `price` = '%s', `comm` = '%s', `grade` = '%s', `admin_id` = '%s' WHERE `completed_work`.`rec_num` = '%s'";
		$sql = sprintf($sql, 
			$this->db->real_escape_string($id),
			$this->db->real_escape_string($type_work),
			$this->db->real_escape_string($price),
			$this->db->real_escape_string($comm),
			$this->db->real_escape_string($grade),
			$this->db->real_escape_string($admin_id),
			$this->db->real_escape_string($id_comm));
			$result = $this->db->query($sql);
			if (!$result) {
				exit(mysqli_error($this->db));
			}
			else {
				return TRUE;
			}
	}

    public function login($login,$password) {
		
		if(empty($login) || empty($password)) {
			$_SESSION['msg'] = "Все поля нужно заполнить";
			return FALSE;
		}
		
		$user = $this->getLogin($login);				
		
		if(!$user) {
			return FALSE;
		}		
		if (!password_verify($password, $user['password'])) {
			$_SESSION['msg'] = "Не верный логин или пароль";
			return FALSE;
		}
		unset($user['password']);
		$_SESSION['user'] = $user;
		// if($member == '1') {
		// 	$expire = time() + 3600*24*100;
			
		// 	setcookie('login',$login,$expire);
		// 	setcookie('password',$password,$expire);
		// }
		
		// $id_user = $user['user_id'];
		
		// $sess = $this->openSession($id_user);
		
		// if(!$sess) {
		// 	//$_SESSION['msg'] = "Не удалось авторизировать пользователя";
		// 	return FALSE;
		// }
        return $user;
	}

    public function getLogin($login) {
        $sql = "SELECT `user_id`, `login`, `password`, `name`, `role` FROM `user` WHERE `login` = '%s'";
		
		$sql = sprintf($sql, $this->db->real_escape_string($login));
		
		$result = $this->db->query($sql);
		
		if(!$result) {
			$_SESSION['msg'] = "ERROR database".mysqli_error($this->db);
			return FALSE;
		}
		
		if(mysqli_num_rows($result) !== 1) {
			$_SESSION['msg'] = "Не верный логин или пароль";
			return FALSE;
		}
		
		return $result->fetch_assoc();		
	}

    // public function getStatti($id) { // только для юзера!!! надо переделать!!!
    //     $sql = "SELECT u.user_id, u.name, u.DR, u.DH, u.info, u.oklad, u.comment, u.coefficient, u.role, c.date, c.type_work, c.price, c.comm, c.grade FROM user u JOIN completed_work c ON u.user_id = c.user_id WHERE u.user_id LIKE '%s'";

    //     $sql = sprintf($sql, $this->db->real_escape_string($id));
		
	// 	$result = $this->db->query($sql);
        
    //     if(!$result) {
	// 		$_SESSION['msg'] = "ERROR database".mysqli_error($this->db);
	// 		return FALSE;
	// 	}        
	// 	for ($i = 0; $i < mysqli_num_rows($result); $i++) {
	// 		$row[] = $result->fetch_assoc();
	// 	}
	// 	return $row;
    // }

	public function cleanUser($post) {
		$id = $post['dell'];
		$sql = "DELETE FROM `user` WHERE `user`.`user_id` = '%s'";
		$sql = sprintf($sql, $this->db->real_escape_string($id));

		$result = $this->db->query($sql);	
		if (!$result) {
			exit(mysqli_error($this->db));
		}
		else {
			return TRUE;
		}
	}

	public function cleanComWork($id) {
		$rec_num = $id['dell'];
		$sql = "DELETE FROM `completed_work` WHERE `completed_work`.`rec_num` = '%s'";
		$sql = sprintf($sql, $this->db->real_escape_string($rec_num));

		$result = $this->db->query($sql);	
		if (!$result) {
			exit(mysqli_error($this->db));
		}
		else {
			return TRUE;
		}
	}

	public function cleanAddWork($id) {
		$rec_num = $id['dell_add'];		
		$sql = "DELETE FROM `additional_work` WHERE `additional_work`.`id` = '%s'";
		$sql = sprintf($sql, $this->db->real_escape_string($rec_num));

		$result = $this->db->query($sql);	
		if (!$result) {
			exit(mysqli_error($this->db));
		}
		else {
			return TRUE;
		}
	}	

	public function registration($post) {
		$login = $this->clean_data($post['login']);
		$password = trim($post['password']);
		$role = $this->clean_data($post['role']);
		$name = $this->clean_data($post['name']);
		$DR = $this->clean_data($post['DR']);
		$DH = $this->clean_data($post['DH']);
		$info = $this->clean_data($post['info']);
		$oklad = $this->clean_data($post['oklad']);
		$comment = $this->clean_data($post['comment']);
		
		$msg = '';

		if(empty($login)) {
			$msg .= "Введите логин <br />";
		}
		if(empty($password)) {
			$msg .= "Введите пароль <br />";
		}
		if(empty($role)) {
			$msg .= "Введите роль пользователя <br />";
		}
		if(empty($name)) {
			$msg .= "Введите ФИО <br />";
		}
		if(empty($DR)) {
			$msg .= "Введите дату <br />";
		}
		if(empty($DH)) {
			$msg .= "Введите дату <br />";
		}
		if(empty($info)) {
			$msg .= "Введите место жительства <br />";
		}
		if(empty($oklad)) {
			$msg .= "Введите оклад <br />";
		}
		if(empty($comment)) {
			$msg .= "Введите комментарий <br />";
		}
		$_SESSION['msg'] = $msg;
		
		if($msg) {
			$_SESSION['reg']['login'] = $login;
			$_SESSION['reg']['password'] = $password;
			$_SESSION['reg']['role'] = $role;
			$_SESSION['reg']['name'] = $name;
			$_SESSION['reg']['DR'] = $DR;
			$_SESSION['reg']['DH'] = $DH;
			$_SESSION['reg']['info'] = $info;
			$_SESSION['reg']['oklad'] = $oklad;
			$_SESSION['reg']['comment'] = $comment;
			return $msg;
		}
		if($password == $password) {
			$sql = "SELECT `user_id`
				FROM `user`
				WHERE `login` = '%s'";
			$sql = sprintf($sql, $this->db->real_escape_string($login));
	
			$result = $this->db->query($sql);
			if(mysqli_num_rows($result) > 0) {
				$_SESSION['reg']['name'] = $name;
				$_SESSION['reg']['DR'] = $DR;
				$_SESSION['reg']['DH'] = $DH;
				$_SESSION['reg']['info'] = $info;
				$_SESSION['reg']['oklad'] = $oklad;
				$_SESSION['reg']['comment'] = $comment;
				return "Логин занят";
				}
			$password = password_hash($password, PASSWORD_DEFAULT);
	
			$date = date("d.m.Y", time());		
	
			$query = "INSERT INTO `user`(`user_id`, `login`, `password`, `name`, `DR`, `DH`, `info`, `oklad`, `comment`, `date`, `role`, `coefficient`) VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '1')";
			$query = sprintf($query, 
			$this->db->real_escape_string($login), 
			$password, 
			$this->db->real_escape_string($name), 
			$this->db->real_escape_string(date("d.m.Y", strtotime($DR))),
			$this->db->real_escape_string(date("d.m.Y", strtotime($DH))), 
			$this->db->real_escape_string($info), 
			$this->db->real_escape_string($oklad), 
			$this->db->real_escape_string($comment), 			 
			$date, 
			$this->db->real_escape_string($role));

			$result2 = $this->db->query($query);
	
			if(!$result2) {
				$_SESSION['reg']['login'] = $login;
				$_SESSION['reg']['password'] = $password;
				$_SESSION['reg']['name'] = $name;
				$_SESSION['reg']['DR'] = $DR;
				$_SESSION['reg']['DH'] = $DH;
				$_SESSION['reg']['info'] = $info;
				$_SESSION['reg']['oklad'] = $oklad;
				$_SESSION['reg']['comment'] = $comment;
				return "Ошибка при добавлении пользователя в базу данных".mysqli_error($this->db);
			}
			else {
				return TRUE;
			}
		}
		else {
			$_SESSION['reg']['login'] = $login;
			$_SESSION['reg']['name'] = $name;
			$_SESSION['reg']['DR'] = $DR;
			$_SESSION['reg']['DH'] = $DH;
			$_SESSION['reg']['info'] = $info;
			$_SESSION['reg']['oklad'] = $oklad;
			$_SESSION['reg']['comment'] = $comment;
			return "Неверный пароль";
		}
	}
	
	public function getEditInform($post) { // редактирование учётной записи
		$login = $this->clean_data($post['login']);
		$password = trim($post['password']);
		$role = $this->clean_data($post['role']);
		$name = $this->clean_data($post['name']);
		$DR = $this->clean_data($post['DR']);
		$DH = $this->clean_data($post['DH']);
		$info = $this->clean_data($post['info']);
		$oklad = $this->clean_data($post['oklad']);
		$comment = $this->clean_data($post['comment']);
		$id = $_GET['id'];

		$msg = '';

		if(empty($login)) {
			$msg .= "Введите логин <br />";
		}		
		if(empty($role)) {
			$msg .= "Введите роль пользователя <br />";
		}
		if(empty($name)) {
			$msg .= "Введите ФИО <br />";
		}
		if(empty($DR)) {
			$msg .= "Введите дату <br />";
		}
		if(empty($DH)) {
			$msg .= "Введите дату <br />";
		}
		if(empty($info)) {
			$msg .= "Введите место жительства <br />";
		}
		if(empty($oklad)) {
			$msg .= "Введите оклад <br />";
		}
		if(empty($comment)) {
			$msg .= "Введите комментарий <br />";
		}
		$_SESSION['msg'] = $msg;
		
		if($msg) {
			$_SESSION['reg']['login'] = $login;
			$_SESSION['reg']['password'] = $password;
			$_SESSION['reg']['role'] = $role;
			$_SESSION['reg']['name'] = $name;
			$_SESSION['reg']['DR'] = $DR;
			$_SESSION['reg']['DH'] = $DH;
			$_SESSION['reg']['info'] = $info;
			$_SESSION['reg']['oklad'] = $oklad;
			$_SESSION['reg']['comment'] = $comment;
			return $msg;
		}
		$rol = $_SESSION['user']['role'];
		$sql = "SELECT `role` FROM `user` WHERE `user_id` = '%s'";
		$sql = sprintf($sql, $this->db->real_escape_string($id));
		$result = $this->db->query($sql);
		$row[] = $result->fetch_assoc();
		
		if ($rol !== '3') {
			if ($row['0']['role'] == '3') {
				$_SESSION['msg'] = "У ВАС НЕТ ПРАВ ИЗМЕНЯТЬ ЭТУ УЧЁТНУЮ ЗАПИСЬ!";
				header("Location:index.php?option=edit_user-admin&id=" . $id);
				session_write_close();
			}
			elseif ($row['0']['role'] !== '3') {
				if (empty($password)) {
					$user = $this->update_user($login, $name, $DR, $DH, $info, $oklad, $comment, $role, $id);
					if ($user === TRUE) {
						return TRUE;
					}
					else {
						return $user;
					}
				}
				else {
					$user = $this->update_user_2($login, $password, $name, $DR, $DH, $info, $oklad, $comment, $role, $id);
					if ($user === TRUE) {
						return TRUE;
					}
					else {
						return $user;
					}
				}
			}
		}
		elseif ($rol == '3') {
			if (empty($password)) {
				$user = $this->update_user($login, $name, $DR, $DH, $info, $oklad, $comment, $role, $id);
				if ($user === TRUE) {
					return TRUE;
				}
				else {
					return $user;
				}
			}
			else {
				$user = $this->update_user_2($login, $password, $name, $DR, $DH, $info, $oklad, $comment, $role, $id);
				if ($user === TRUE) {
					return TRUE;
				}
				else {
					return $user;
				}
			}
		}
	}

	private function update_user($login, $name, $DR, $DH, $info, $oklad, $comment, $role, $id) {
		$sql = "UPDATE `user` SET `login` = '%s', `name` = '%s', `DR` = '%s', `DH` = '%s', `info` = '%s', `oklad` = '%s', `comment` = '%s', `role` = '%s' WHERE `user`.`user_id` = '%s'";
		$sql = sprintf($sql, 
			$this->db->real_escape_string($login),
			$this->db->real_escape_string($name), 
			$this->db->real_escape_string(date("d.m.Y", strtotime($DR))),
			$this->db->real_escape_string(date("d.m.Y", strtotime($DH))), 
			$this->db->real_escape_string($info), 
			$this->db->real_escape_string($oklad), 
			$this->db->real_escape_string($comment),			
			$this->db->real_escape_string($role),
			$this->db->real_escape_string($id));

		$result = $this->db->query($sql);

		if(!$result) {
			$_SESSION['reg']['login'] = $login;		
			$_SESSION['reg']['name'] = $name;
			$_SESSION['reg']['DR'] = $DR;
			$_SESSION['reg']['DH'] = $DH;
			$_SESSION['reg']['info'] = $info;
			$_SESSION['reg']['oklad'] = $oklad;
			$_SESSION['reg']['coment'] = $comment;
			return "Ошибка при редактировании".mysqli_error($this->db);
		}
		else {
			return TRUE;
		}
	}

	private function update_user_2($login, $password, $name, $DR, $DH, $info, $oklad, $comment, $role, $id) {
		$password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "UPDATE `user` SET `login` = '%s', `password` = '%s', `name` = '%s', `DR` = '%s', `DH` = '%s', `info` = '%s', `oklad` = '%s', `comment` = '%s', `role` = '%s' WHERE `user`.`user_id` = '%s'";
		$sql = sprintf($sql, 
			$this->db->real_escape_string($login),
			$this->db->real_escape_string($password),
			$this->db->real_escape_string($name), 
			$this->db->real_escape_string(date("d.m.Y", strtotime($DR))),
			$this->db->real_escape_string(date("d.m.Y", strtotime($DH))), 
			$this->db->real_escape_string($info), 
			$this->db->real_escape_string($oklad), 
			$this->db->real_escape_string($comment),			
			$this->db->real_escape_string($role),
			$this->db->real_escape_string($id));

		$result = $this->db->query($sql);

		if(!$result) {
			$_SESSION['reg']['login'] = $login;
			$_SESSION['reg']['password'] = $password;
			$_SESSION['reg']['name'] = $name;
			$_SESSION['reg']['DR'] = $DR;
			$_SESSION['reg']['DH'] = $DH;
			$_SESSION['reg']['info'] = $info;
			$_SESSION['reg']['oklad'] = $oklad;
			$_SESSION['reg']['coment'] = $comment;
			return "Ошибка при редактировании".mysqli_error($this->db);
		}
		else {
			return TRUE;
		}
	}

	public function sort_cash($post) {
		$user_id = $this->clean_data($_GET['id']);
		$with = $post['with'];
		$before = $post['before'];

		if (empty($with) && empty($before)) {
			return FALSE;			
		}

		$sql = "SELECT * FROM `completed_work` WHERE `user_id` = '%s' AND `date` BETWEEN '%s' AND '%s'";		
		$sql = sprintf($sql, 
		$this->db->real_escape_string($user_id),
		$this->db->real_escape_string($with),
		$this->db->real_escape_string($before));
		$result = $this->db->query($sql);

		$sql_2 = "SELECT * FROM `additional_work` WHERE `user_id` = '%s' AND `date` BETWEEN '%s' AND '%s'";
		$sql_2 = sprintf($sql_2, 
		$this->db->real_escape_string($user_id),
		$this->db->real_escape_string($with),
		$this->db->real_escape_string($before));
		$result_2 = $this->db->query($sql_2);
		
		for ($i = 0; $i < mysqli_num_rows($result); $i++) {
			$row[] = $result->fetch_assoc();
		}

		for ($i = 0; $i < mysqli_num_rows($result_2); $i++) {
			$row_2[] = $result_2->fetch_assoc();
		}

		$sql_3 = "SELECT `oklad`, `coefficient` FROM `user` WHERE `user_id` = '%s'";
		$sql_3 = sprintf($sql_3, $this->db->real_escape_string($user_id));
		$result_3 = $this->db->query($sql_3);

		for ($i = 0; $i < mysqli_num_rows($result_3); $i++) {
			$row_3[] = $result_3->fetch_assoc();
		}

		// $_SESSION['vsego'] = '';
		// $_SESSION['summa'] = '';

		if(isset($row) && isset($row_2)) {
					
			$qqq = array_merge($row, $row_2);
			usort($qqq, [Model::class, "mySort"]);
			
			$summa = 0;
			foreach ($qqq as $value) {			
				$summa += $value['price'];
			}			
			$_SESSION['summa'] = $summa;
	
			$i = ($summa * $row_3['0']['coefficient']) + $row_3['0']['oklad'];
			$_SESSION['vsego'] = $i;
			
			return $qqq;
		}
		elseif (!isset($row) && !isset($row_2)) {
			return FALSE;
		}
		elseif (!isset($row)) {
			$summa = 0;
			foreach ($row_2 as $value) {			
				$summa += $value['price'];
			}			
			$_SESSION['summa'] = $summa;
	
			$i = ($summa * $row_3['0']['coefficient']) + $row_3['0']['oklad'];
			$_SESSION['vsego'] = $i;
			return $row_2;
		}
		elseif (!isset($row_2)) {
			$summa = 0;
			foreach ($row as $value) {			
				$summa += $value['price'];
			}			
			$_SESSION['summa'] = $summa;
	
			$i = ($summa * $row_3['0']['coefficient']) + $row_3['0']['oklad'];
			$_SESSION['vsego'] = $i;
			return $row;
		}
	}

	public function mySort($a, $b) {
		if ($a['date'] == $b['date']) return 0;
		return $a['date'] > $b['date'] ? 1 : -1;
	}
}

