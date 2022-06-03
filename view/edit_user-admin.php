<? include "inc/header.php";?>
<section>
    <div class="wrapper">
        <div class="edit-user">
            <div class="edit-user__title">
                <div class="title">
                    <h1><?=$text['0']['name'];?></h1>
                    <?=$_SESSION['msg'];?>
                    <? unset($_SESSION['msg']);?>
                </div>
            </div>
            <div class="edit-user__cash">
                <div class="cash">
                    <h2>Оклад: <span><?=$text['0']['oklad'];?></span></h2>
                    <h2>Коэффициент: <span><?=$text['0']['coefficient'];?></span></h2>
                </div>
            </div>
            <div class="edit-user__coof">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Коэффициент</th>
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
            <div class="edit-user__img"> </div>
            <div class="edit-user__inform">
                <div class="title">
                    
                    <h2>Информация о сотруднике:</h2><span><a href="index.php?option=edit_inform-user&id=<?=$text['0']['user_id'];?>">Редактировать !!!
                        </a></span>
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
            <div class="edit-user__work">
                <div class="title">
                    <div class="box">
                        <h3>Проделанная работа сотрудника:</h3>
                    </div><span><a class="btn" href="index.php?option=create_work&id=<?=$text['0']['user_id'];?>">Добавить </a></span>
                    
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
                                <th> <span>Редактировать</span></th>
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
                                <td> <a href="index.php?option=edit_work&id=<?=$item['user_id'];?>&comm=<?=$item['rec_num'];?>">Редактировать</a></td>
                            </tr>
                            <? endforeach; ?>
                            <? endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="edit-user__prem">
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
            <div class="edit-user__sort">
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