<? include "inc/header.php";?>
<section>
    <div class="wrapper">
        <div class="user">
            <div class="user__title">
                <div class="title">
                    <h1><?=$text['0']['name'];?></h1>
                </div>
            </div>
            <div class="user__cash">
                <div class="cash">
                    <h3>Оклад: <span><?=$text['0']['oklad'];?></span></h3>
                    <h2>Коофициент: <span><?=$text['0']['coefficient'];?></span></h2>
                </div>
            </div>
            <div class="user__coof">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Коофициент</th>
                                <th>Комментарии</th>
                            </tr>
                        </thead>
                        <tbody>                        
                            <? if ($coef != FALSE) :?>
                            <? foreach ($coef as $item) :?>
                            <tr>
                                <td><?=$item['date_cof'];?></td>
                                <td><?=$item['coff'];?></td>
                                <td><?=$item['comm_cof'];?></td>
                            </tr>
                            <? endforeach; ?>
                            <? endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="user__img"> </div>
            <div class="user__inform">
                <div class="title">
                    <h2>Информация о сотруднике:</h2>
                </div>
                <div class="box"></div>
                <div class="birthday flex">
                    <h3>Дата рождения: </h3><span><?=$text['0']['DR'];?></span>
                </div>
                <div class="hiring flex">
                    <h3>Дата найма: </h3><span><?=$text['0']['DH'];?></span>
                </div>
                <div class="residence flex">
                    <h3>Место проживания: </h3><span><?=$text['0']['info'];?></span>
                </div>
                <div class="comment flex">
                    <h3>Комментарии: </h3><span><?=$text['0']['comment'];?></span>
                </div>
            </div>
            <div class="user__work">
                <div class="title">
                    <div class="box">
                        <h3>Проделанная работа: </h3>
                    </div>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th> <span>Дата</span></th>
                                <th> <span>Что сделал</span></th>
                                <th> <span>Сумма</span></th>
                                <th> <span>Комментарии</span></th>
                                <th> <span>Оценка абонента</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <? if ($work != FALSE) :?>
                            <? foreach ($work as $item) :?>
                            <tr>
                                <td><?=date("d.m.Y", strtotime($item['date']));?></td>
                                <td><?=$item['type_work'];?></td>
                                <td><?=$item['price'];?></td>
                                <td><?=$item['comm'];?></td>
                                <td><?=$item['grade'];?></td>
                            </tr> 
                            <? endforeach; ?>
                            <? endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="user__prem">
                <div class="title">
                    <div class="box">
                        <h3>Дополнительная работа:</h3>
                    </div>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th> <span>Дата</span></th>
                                <th> <span>Что сделал</span></th>
                                <th> <span>Сумма</span></th>
                                <th> <span>Комментарии</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <? if ($add_work != FALSE) :?>
                            <? foreach ($add_work as $item) :?>
                            <tr>
                                <td><?=date("d.m.Y", strtotime($item['date']));?></td>
                                <td><?=$item['type_work'];?></td>
                                <td><?=$item['price'];?></td>
                                <td><?=$item['comment'];?></td>
                            </tr>
                            <? endforeach; ?>
                            <? endif; ?>                         
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="user__sort">
                <div class="title">
                    <div class="box">
                        <h3>Сотировка работы:</h3>
                    </div><span> <a href="index.php?option=sort_cash&id=<?=$text['0']['user_id'];?>"> Поиск</a></span>
                </div>
            </div>
        </div>
    </div>
</section>
<? include "inc/footer.php";?>