<? include "inc/header.php";?>
<section>    
    <div class="wrapper">
        <div class="edit-inform-user">
            <div class="edit-inform-user__title">
                <div class="title">
                    <h1>Редактировать информацию об сотруднике</h1>
                    <?=$_SESSION['msg'];?>
                    <? unset($_SESSION['msg']);?>
                </div>
            </div>
            <div class="edit-inform-user__img"></div>
            <div class="edit-inform-user__form">
                <form name="regs" method="POST">
                    <div class="login flex"><label for="login">Логин:</label><input id="login" type="text"
                            name="login" value="<?=$text['0']['login'];?>"></div>
                    <div class="password flex"><label for="password">Пароль:</label><input id="password"
                            type="password" name="password" value=""></div>
                    <div class="role flex"><label for="role">Роль пользователя:</label><select id="role"
                            name="role">
                            <option value="1">Сотрудник</option>
                            <option value="2">Администратор</option>
                            <? if ($_SESSION['user']['role'] == "3") :?>
                                <option value="3">Супер администратор</option>
                            <? endif; ?>
                        </select></div>
                    <div class="name flex"> <label for="name">Фамилия Имя Отчество: </label><input id="name"
                            type="text" name="name" value="<?=$text['0']['name'];?>"></div>
                    <div class="birthday flex"><label for="birthday">Дата рождения: </label><input type="date"
                            name="DR" value="<?=date("Y-m-d", strtotime($text['0']['DR']));?>"></div>
                    <div class="take flex"><label for="take">Дата найма: </label><input id="take" type="date"
                            name="DH" value="<?=date("Y-m-d", strtotime($text['0']['DH']));?>"></div>
                    <div class="adress flex"><label for="adress">Место жительства: </label><input id="adress"
                            type="text" name="info" value="<?=$text['0']['info'];?>"></div>
                    <div class="cash flex"><label for="cash">Оклад: </label><input id="cash" type="number" name="oklad" value="<?=$text['0']['oklad'];?>"></div>
                    <div class="comment flex"><label for="comm">Комментарии: </label><textarea id="comm" name="comment" value="<?=$text['0']['comment'];?>" cols="27" rows="3"><?=$text['0']['comment'];?></textarea></div>
                    <div class="btn flex"><input type="submit" name="edit" value="Отправить" /></div>
                </form>
            </div>
        </div>
    </div>    
</section>
<? include "inc/footer.php";?>