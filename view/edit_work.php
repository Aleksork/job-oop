<? include "inc/header.php";?>
<section>    
    <div class="wrapper">
        <div class="create-work">
            <div class="create-work__title">
                <div class="title">
                    <h1>Редактировать работу: <span><?=$text['0']['name'];?></span></h1>
                </div>
                <?=$_SESSION['msg'];?>
                <? unset($_SESSION['msg']);?>
            </div>
            <div class="create-work__img"></div>
            <div class="create-work__form">
                <form method="post">
                    <div class="box">
                        <div class="work"><label for="work">Произведенные работы:</label><br><select id="work"
                                name="work">
                                <optgroup label="Монтажные работы">
                                    <? foreach ($work as $items) :?>
                                    <option value="<?=$items['id'];?>"><?=$items['type_work'];?></option>
                                <? endforeach; ?>
                                </optgroup>               
                            </select></div>
                        <div class="rating"><label for="rating">Оценка абонента:</label><br><select id="rating"
                                name="grade">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10 </option>
                            </select></div>
                    </div>
                    <? foreach ($comm as $item) :?>
                    <div class="comment"> </div><label for="comm">Коментарий:</label><br><textarea id="comm"
                        name="comm" value="<?=$item['comm'];?>" cols="48" rows="5"><?=$item['comm'];?></textarea>
                    <div class="btn"> <button type="submit">Редактировать</button></div>
                    <? endforeach; ?>
                </form>
            </div>
        </div>
    </div>    
</section>
<? include "inc/footer.php";?>