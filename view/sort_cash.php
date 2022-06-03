<? include "inc/header.php";?>
<section>
    <div class="wrapper">
        <div class="sort-cash">
            <div class="sort-cash__title">
                <div class="title">
                    <h1>Сортировка выполнинных заданий сотрудника: <?=$text['0']['name'];?></h1>
                    <?=$_SESSION['msg'];?>
                    <? unset($_SESSION['msg']);?>
                </div>
            </div>
            <div class="sort-cash__img"></div>
            <div class="sort-cash__form">
                <div class="holder">
                    <div class="title">
                        <h2>Поиск по произвотственным работам</h2>
                    </div>
                    <div class="subtitle">
                        <h3>Укажите дату: </h3>
                    </div>
                    <div class="form">
                        <form action="" method="POST">
                            <div class="box">
                                <div class="with"><label for="with">С: </label><input id="with" type="date"
                                        name="with"></div>
                                <div class="before"> <label for="before">ДО: </label><input id="before" type="date"
                                        name="before"></div>
                            </div>
                            <div class="btn"> <button type="submit">Поиск </button></div>
                        </form>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Кто добавил</th>
                                    <th>Выполнил сотрудник</th>
                                    <th>Сумма </th>
                                </tr>
                            </thead>
                            <tbody>
                                <? if (!empty($msg)) :?>
                                <? foreach ($msg as $item) :?>
                                <tr>
                                    <td><?=date("d.m.Y", strtotime($item['date']));?></td>
                                    <td><?=$item['admin_id'];?></td>
                                    <td><?=$item['type_work'];?>
                                    <td><?=$item['price'];?></td>
                                </tr>
                                <? endforeach; ?>
                                <? endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="sort-cash__total">
                <div class="total">                        
                    <h3>ИТОГО: </h3><span><?=$text['0']['oklad'];?></span><span><?=$_SESSION['summa'];?></span><span>&midast;</span><span><?=$text['0']['coefficient'];?></span><span><?=$_SESSION['vsego'];?></span>
                    <? unset($_SESSION['oklad']);?>
                    <? unset($_SESSION['coefficient']);?>
                    <? unset($_SESSION['summa']);?>
                    <? unset($_SESSION['vsego']);?>
                </div>
            </div>
        </div>
    </div>
</section>
<? include "inc/footer.php";?>