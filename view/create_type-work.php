<? include "inc/header.php";?>
<section>
    <div class="wrapper">
        <div class="create-type-work">
            <div class="create-type-work__title">
                <div class="title">
                    <h1>Создание типов работа </h1>
                </div>
                <?=$_SESSION['msg'];?>
                <? unset($_SESSION['msg']);?>
            </div>
            <div class="create-type-work__img"> </div>
            <div class="create-type-work__form">
                <div class="form">
                    <form name="work" method="post">
                        <div class="box">
                            <div class="type-work"> <label for="type-work">Cоздать вид работы:</label><br><input
                                    id="type" type="text" name="type_work"></div>
                            <div class="type-coof"> <label for="type-coof">Создать сумму:</label><br><input
                                    id="type-coof" type="number" name="price"></div>
                        </div><button class="btn">Создать</button>
                    </form>
                </div>
            </div>
            <div class="create-type-work__table">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Виды работ</th>
                                <th>Сумма</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($work as $items) :?>
                            <tr>
                                <td><?=$items['type_work'];?></td>
                                <td><?=$items['price'];?></td>
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