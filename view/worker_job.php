<? include "inc/header.php";?>
<section>
    <div class="wrapper">
        <div class="worker-list">
            <div class="worker-list__title">
                <div class="title">
                    <h1>Выполненная работа сотрудников</h1>
                </div>
            </div>
            <div class="worker-list__table">
                <div class="title">
                    <div class="box">
                        <h2>Произведенные работы</h2>
                    </div>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th> <span>Дата </span></th>
                                <th> <span>Ф.И.О сотрудника </span></th>
                                <th> <span>Выполненная Работа</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($row as $item) :?>
                            <tr>
                                <td><?=$item['date'];?></td>
                                <td> <a href="index.php?option=edit_user&id=<?=$item['user_id'];?>"><?=$item['name'];?></a></td>
                                <td> <a href="index.php?option=create_work&id=<?=$item['user_id'];?>">Добавить</a></td>
                            </tr>
                            <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="worker-list__table">
                <div class="title">
                    <div class="box">
                        <h2>Дополнительные работы</h2>
                    </div>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th> <span>Дата </span></th>
                                <th> <span>Ф.И.О сотрудника </span></th>
                                <th> <span>Выполненная Работа</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($row as $item) :?>
                            <tr>
                                <td><?=$item['date'];?></td>
                                <td> <a href="index.php?option=edit_user&id=<?=$item['user_id'];?>"><?=$item['name'];?></a></td>
                                <td> <a href="index.php?option=create_prem&id=<?=$item['user_id'];?>">Добавить</a></td>
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