<? include "inc/header.php";?>
<section>
    <div class="wrapper">
        <div class="create-coof">
            <div class="create-coof__title">
                <div class="title">
                    <h1>Редактировать Коофициент: <span><?=$text['0']['name'];?></span></h1>
                    <?=$_SESSION['msg'];?>
                    <? unset($_SESSION['msg']);?>
                </div>
            </div>
            <div class="create-coof__img"></div>
            <div class="create-coof__form">
                <form method="post" >
                    <div class="box">
                        <div class="coof"> <label for="coof">Коофициент</label><br><input id="coof" type="text"
                                name="coof"></div>
                        <div class="comment"> <label for="coof-comment">Коментарий</label><br><textarea
                                id="coof-comment" name="comm_cof" cols="53" rows="5"> </textarea></div><button
                            class="btn">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<? include "inc/footer.php";?>