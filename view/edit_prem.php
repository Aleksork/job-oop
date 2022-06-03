<? include "inc/header.php";?>
<section>
    <div class="wrapper">
        <div class="create-prem">
            <div class="create-prem__title">
                <div class="title">
                    <h1>Дополнительные работы: <?=$text['0']['name'];?></h1>
                    <?=$_SESSION['msg'];?>
                    <? unset($_SESSION['msg']);?>
                </div>
            </div>
            <div class="create-prem__img"></div>
            <div class="create-prem__form">
                <form method="POST">
                    <? foreach ($add_work as $item) :?>
                    <div class="box">                            
                        <div class="work"> <label for="prem">Выполненная работа:</label><br><input id="prem"
                                type="text" name="work" value="<?=$item['type_work'];?>"></div>
                        <div class="cash"> <label for="cash">Сумма:</label><br><input id="cash" type="number"
                                name="cash" value="<?=$item['price'];?>"></div>
                    </div>
                    <div class="comment"><label for="comm-prem">Коментарий:</label><br><textarea id="comm-prem"
                            name="comm" cols="50" rows="5"><?=$item['comment'];?></textarea></div>
                    <div class="btn"> <button type="submit">Редактировать</button></div>
                    <? endforeach; ?>
                </form>
            </div>
        </div>
    </div>
</section>
<? include "inc/footer.php";?>