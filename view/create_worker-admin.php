<? include "inc/header.php";?>
<section>
    <div class="wrapper">
        <div class="worker">
            <div class="worker__title">
                <div class="title">
                    <h1>Создать нового пользовотеля</h1>
                    <?=$_SESSION['msg'];?>
                    <? unset($_SESSION['msg']);?>
                </div>
            </div>
            <div class="worker__img"></div>
            <div class="worker__form">
                <form method="POST">
                    <div class="login flex"><label for="login">Логин:</label><input id="login" type="text" action="?option=create_worker-admin"
                            name="login" value="<?=$_SESSION['reg']['login'];?>"></div>
                    <div class="password flex"><label for="password">Пароль:</label><input id="password"
                            type="password" name="password"></div>
                    <div class="role flex"><label for="role">Роль пользователя:</label><select id="role"
                            name="role">
                            <option value="1">Сотрудник</option>
                            <option value="2">Администратор</option>
                        </select></div>
                    <div class="name flex"> <label for="name">Фамилия Имя Отчество: </label><input id="name"
                            type="text" name="name" value="<?=$_SESSION['reg']['name'];?>"></div>
                    <div class="birthday flex"><label for="birthday">Дата рождения: </label><input type="date" name="DR"
                            value="<?=$_SESSION['reg']['DR'];?>"></div>
                    <div class="take flex"><label for="take">Дата найма: </label><input id="take" type="date" name="DH"
                            name="take" value="<?=$_SESSION['reg']['DH'];?>"></div>
                    <div class="adress flex"><label for="adress">Место жительства: </label><input id="adress"
                            type="text" name="info" value="<?=$_SESSION['reg']['info'];?>"></div>
                    <div class="cash flex"><label for="cash">Оклад: </label><input id="cash" type="number" name="oklad" value="<?=$_SESSION['reg']['oklad'];?>"></div>
                    <div class="comment flex"><label for="comm">Комментарии: </label><textarea id="comm" name="comment" value="<?=$_SESSION['reg']['comment'];?>"
                            cols="27" rows="3"> </textarea></div>
                    <div class="btn flex"><input type="submit" name="reg" value="Отправить"></div>
                </form>
            </div>
            <div class="worker__table">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th> <span>Дата </span></th>
                                <th> <span>Ф.И.О сотрудника </span></th>
                                <th> <span>Дата рождения</span></th>
                                <th> <span>Дата найма</span></th>
                                <th> <span>Место Проживания</span></th>
                                <th> <span>Оклад</span></th>
                                <th> <span>Комментарии</span></th>                         
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($row as $item) :?>
                            <tr>
                                <td><?=$item['date'];?></td>
                                <td> <a href="index.php?option=edit_user-admin&id=<?=$item['user_id'];?>"><?=$item['name'];?></a></td>
                                <td><?=$item['DR'];?></td>
                                <td><?=$item['DH'];?></td>
                                <td><?=$item['info'];?></td>
                                <td><?=$item['oklad'];?></td>
                                <td><?=$item['comment'];?></td>         
                            </tr>
                        <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<? include "inc/footer.php";?>
<? unset($_SESSION['reg']); ?>