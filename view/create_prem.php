<? include "inc/header.php";?>
<section>
    <div class="wrapper">
        <div class="create-prem">
            <div class="create-prem__title">
                <div class="title">
                    <h1>Дополнительные работы: <span><?=$text['0']['name'];?></span></h1>
                </div>
                <?=$_SESSION['msg'];?>
                <? unset($_SESSION['msg']);?>
            </div>
            <div class="create-type-work__img"></div>
            <div class="create-prem__form">
                <form action="" name="work" method="post">
                    <div class="box">
                        <div class="work"> <label for="prem">Выполненная работа:</label><br><input id="prem"
                                type="text" name="work"></div>
                        <div class="cash"> <label for="cash">Сумма:</label><br><input id="cash" type="number"
                                name="cash"></div>
                    </div>
                    <div class="comment"><label for="comm-prem">Коментарий:</label><br><textarea id="comm-prem"
                            name="comm" cols="53" rows="5"> </textarea></div>
                    <div class="btn"> <button type="submit">Отправить</button></div>
                </form>
            </div>
        </div>
    </div>
</section>
<? include "inc/footer.php";?>