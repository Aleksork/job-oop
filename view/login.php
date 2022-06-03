<? include "inc/header.php";?>
<section>
    <div class="wrapper">
        <center>
        <?=$_SESSION['msg'];?>
        <? unset($_SESSION['msg']);?>
        </center>
        <div class="login-inter">
            <div class="login-inter__img"> </div>
            <div class="login-inter__form">
                <div class="form">
                    <form method="POST" action="?option=login">
                        <div class="login"><label for="login">Логин</label><br><input id="login" type="text" name="login" 
                                placeholder="ваш логин"></div>
                        <div class="password"> <label for="password">Пароль</label><br><input id="password"
                                type="password" name="password" placeholder="ваш пароль"></div>
                                <input type="submit" class="btn" value="Вход"/>
                        <!-- <div class="my-button"> <a class="btn" href="admin.html">Администратор</a></div>
                        <div class="my-button"> <a class="btn" href="user.php">Юзер</a></div>
                        <div class="my-button"> <a class="btn" href="supadmin.html">СупАдмин</a></div> -->
                    </form>
                    <!-- <form method="POST">
                        <input type="submit" name="logout" value="Выход">
                    </form> -->
                </div>
            </div>
        </div>
    </div>
</section>
<? include "inc/footer.php";?>
<? unset($_SESSION['user']);?>