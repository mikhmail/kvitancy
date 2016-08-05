<div class="container-fluid" xmlns="http://www.w3.org/1999/html">

<ul class="breadcrumb" style="margin-bottom: 20px;">
    <li>
        <a href="<?php echo site_url("stat/"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
        </a>
        <span class="divider">/</span>
    </li>
    <a href="<?php echo site_url('stat/'. strtolower(ucfirst($this->uri->segment(2)))); ?>">
        <?php echo ucfirst($this->uri->segment(2));?>
    </a>

</ul>

<div class="page-header users-header">
    <h2>
        Статистика
        <!--<a  href="<?php echo site_url("cash").'/'; ?>add" class="btn btn-success pull-right">Добавить</a>-->
    </h2>
</div>


<?php

echo form_open('stat', array('class' => 'form-inline', 'id' => 'myform'));


?>




<div class="row-fluid">

    <div class="span12">



        <?
        $options_date = array('date_priemka' => 'Дата приема', 'date_vydachi' => 'Дата выдачи', 'date_okonchan' => 'Дата окон.ремонта');
        echo form_dropdown('date', $options_date, $date_selected, 'class=""');
        ?>
        От:
        <?
        echo form_date('start_date', $start_date);
        ?>
        До:
        <?
        echo form_date('end_date', $end_date);
        ?>

        <?
        $options_id_sc = array('' => "Выбрать сервис");

        foreach ($sc as $array) {
            $options_id_sc[$array['id_sc']] = $array['name_sc'];
        }
        echo form_dropdown('id_sc', $options_id_sc, $id_sc_selected, 'class=""');

        ?>

        <?
        $options_id_meh = array('' => "Выбрать механика");

        foreach ($meh as $array) {
            $options_id_meh[$array['id']] = $array['user_name'];
        }
        echo form_dropdown('id_mechanic', $options_id_meh, $id_mechanic_selected, 'class=""');
        ?>

        <?
        // echo form_label('Аппарат: ');
        $options_ap = array('' => "Выбрать аппарат");

        foreach ($ap as $array) {
            $options_ap[$array['id_aparat']] = $array['aparat_name'];
        }
        echo form_dropdown('id_aparat', $options_ap, $id_aparat_selected, 'class=""');
        ?>



        <?
        //echo form_label('Производитель: ');
        $options_proizvoditel = array('' => "Выбрать бренд");

        foreach ($proizvoditel as $array) {
            $options_proizvoditel[$array['id_proizvod']] = $array['name_proizvod'];
        }

        echo form_dropdown('id_proizvod', $options_proizvoditel, $id_proizvod_selected, 'class=""');
        ?>



        <?
        //echo form_label('Состояние: ');
        $options_sost = array('' => "Все [что в ремонте]");
        foreach ($sost as $array) {
            $options_sost[$array['id_sost']] = $array['name_sost'];
        }
        echo form_dropdown('id_sost', $options_sost, $id_sost_selected, 'class=""');

        ?>



        <?
        //echo form_label('Вид ремонта: ');
        $options_id_remonta = array('' => "Выбрать вид ремонта");
        foreach ($remont as $array) {
            $options_id_remonta[$array['id_remonta']] = $array['name_remonta'];
        }
        echo form_dropdown('id_remonta', $options_id_remonta, $id_remonta_selected, 'class=""');

        ?>

        <?
        //echo form_label('Сортировать как: ');
        $options_order_type = array('Desc' => 'С конца', 'Asc' => 'С начала');
        echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class=""');
        ?>

        <?
        echo form_label('', 'mysubmit');
        echo form_submit(array('name' => 'mysubmit', 'class' => 'btn btn-info', 'value' => 'Фильтровать'));
        ?>

    </div>
</div>
<div class="margin-top-20px"></div>
<div class="row-fluid">
    <div class="span12" style="margin-bottom: 20px;">

        <div class="pull-left">

            <input type="number" step="1" min="1" name="id_kvitancy" value="" placeholder="Введите номер квитанции">

            <?
            echo form_label('', 'mysubmit');
            echo form_submit(array('name' => 'mysubmit', 'class' => 'btn btn-info', 'value' => 'Показать'));
            ?>
        </div>

        <div class="pull-right">
            <?
            //echo form_label('Поиск:', 'search_string');
            echo form_input('search_string', $search_string_selected, 'placeholder="Поиск по фамилии, модели, телефоне" title="Поиск по фамилии, модели, телефоне" class="search-query" style="width: 260px;"');
            ?>
            <?
            echo form_label('', 'mysubmit');
            echo form_submit(array('name' => 'mysubmit', 'class' => 'btn btn-info', 'value' => 'Поиск'));
            ?>
        </div>
    </div>
</div>

<?
echo form_close();
if(count($count_kvitancys)>=1) {?>



<div class="row-fluid">

<div class="row-fluid">

    <legend>Найдено <strong><?=$count_kvitancys?></strong> записей на сумму <strong><?echo $summ;?></strong>

        <div class="pagination pull-right">
            <?=$this->pagination->create_links()?>
        </div>
    </legend>




</div>



<div class="row-fluid">

<div class="">



<div class="row-fluid">

<table class="table table-bordered table-condensed">


<tr>
    <td>
        <table class="table">
            <tr class="chart-bottom-heading">
                <th class="span2">#</th>
                <th class="span2">Статус</th>
                <th class="span3">Аппарат</th>
                <!--<th class="span3">Неисправность</th>-->
                <th class="span2">Дата приема</th>
                <th class="span2">В ремонте/Дата выдачи</th>
                <th class="span2">Сервис</th>
                <th class="span2">Запчасти</th>
                <th class="span2">Работы</th>
                <th class="span2">Касса</th>
                <th class="span3">Прибыль</th>
            </tr>
        </table>
    </td>
</tr>

<?  if(count($kvitancys) >= 1) {
    foreach($kvitancys as $row) { ?>
        <? //$comments = $this->kvitancy_model->get_comments($row['id_kvitancy']); ?>



        <tr>
        <td>

            <table class="table">
                <tr class="chart-bottom-heading">
                    <td class="span2"><span class="label label-info"># <?=$row['id_kvitancy']?></span></td>
                    <td class="span2"><span id="background_<?=$row['id_kvitancy']?>" style="background-color:<?=$row['background']?>" class="label"><?=$row['name_sost']?></span></td>
                    <td class="span3"><?=$row['aparat_name'].' '.$row['name_proizvod'].' '.$row['model']?> - <?=$row['neispravnost']?></td>
                    <!--<td class="span3"><?=$row['neispravnost']?></td>-->
                    <td class="span2"><?=$row['date_priemka']?></td>
                    <td class="span2">
                            <?
                            if ($row['date_vydachi'] == '0000-00-00') {?>
                                <span style="background-color:#b94a48" class="label">
                           <?echo floor((strtotime("now")-strtotime($row['date_priemka']))/86400) . ' дней';?>
                        </span>
                            <?}else{
                                echo $row['date_vydachi'];
                            }
                            ?>
                    </td>
                    <?
                    $store = $this->stat_model->get_store($row['id_kvitancy']);
                    $cash = $this->stat_model->get_cash($row['id_kvitancy']);
                    $work = $this->stat_model->get_work($row['id_kvitancy']);
                    //$profit = 0;
                    $sum_store = 0;
                    $sum_work = 0;
                    $pro_cash =0;
                    ?>
                    <td class="span2"><?=$row['name_sc']?></td>
                    <td class="span2">
                            <? if(count($store)>0) {?>
                                <ul>
                                <? foreach ($store as $str){?>
                                <li><?=$str["title"]?>: <strong><?=$str["cost"];$sum_store += $str["cost"];?></strong></li>
                                     <?}?>
                                </ul>
                        <?}?>
                    </td>

                    <td class="span2">
                        <? if(count($work)>0) {?>
                        <ul>
                           <? foreach ($work as $works){?>
                                <li><?=$works["name"]?>: <strong><?=$works["cost"];$sum_work += $works["cost"];?></strong> by <?=$works["user_name"]?></li>
                            <?}?>
                        </ul>
                           <?}?>
                    </td>

                    <td class="span2">
                        <? if(count($cash) >0) {?>
                            <ul>
                            <? foreach ($cash as $csh){?>
                                <li><?=$csh["name"]?>: <strong><?=$csh["plus"];$pro_cash += $csh["plus"];?></strong> by <?=$csh["user_name"]?></li>
                            <?}?>
                            </ul>
                            <?}?>
                    </td>

                    <td class="span3">
                        <?if(count($store)>0 OR count($work)>0 OR count($cash) >0) {?>
                        Касса[<b><?=$pro_cash?></b>] - Запчасти[<b><?=$sum_store?></b>] - Работы[<b><?=$sum_work?></b>] = <b><?=$pro_cash-$sum_work-$sum_store;?></b>
                    <?}?>
                    </td>


                </tr>
            </table>


        </td>
        </tr>


    <?}}?>

</table>

</div>




<div class="span12 pull-right">
    <div class="pagination">
        <?=$this->pagination->create_links()?>
    </div>
</div>

</div>
<?}?>

</div>

<div class="row-fluid">

<div id="myAlert" class="modal hide">
    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">×</button>
        <h3>Склад</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span5">
                <?php echo form_dropdown('id_aparat', $options_ap, '', 'id="store_add_id_aparat" class="chzn-select"');?>
            </div>
            <div class="span5" id="store_select">
                <?php echo form_dropdown('id_aparat_p', array('' => "-"), '', 'id="store_add_id_aparat_p" class="select-container"');?>
            </div>

        </div>
        <div class="row-fluid" id="store_modal">

        </div>
    </div>
    <div class="modal-footer">
        <a data-dismiss="modal" class="btn btn-primary" href="#">Добавить</a>
        <a data-dismiss="modal" class="btn" href="#">Отмена</a>
    </div>
</div>


<!-- Модальное окно d-->
<div id="modal_form">


    <div class="modal-header">
        <button id="modal_close" data-dismiss="modal" class="close" type="button">×</button>
        <h1>Новая заявка</h1>
    </div>

    <div class="modal-body">
        <form name="new_kvit_form" action="" method="post">


            <!--<div class="span12">
                    <div class="span6">

                        <input class="" type="text" id="inputApparat" onkeyup="look_apparat(this.value);" placeholder="Поиск аппарата">

                        <?php echo form_dropdown('id_aparat', $options_ap, $id_aparat_selected, 'class="" id="id_aparat" required="required" title="Аппарат"');?>



                        <a href="#" class="btn margin-bottom-10px" onclick="anichange(this); return false"><i class="icon-plus"></i></a>

					<span name="aparat_span" style="display: none;">
						<input class="" name="add_aparat_name" id="add_aparat_name" type="text" placeholder="Введите название аппарата">
						<input class="btn margin-bottom-10px" name="submit" id="add_aparat" type="button" value="Добавить аппарат" >
					</span>

                        <div align="left" class="suggestionsBox" id="apparat_box" style="display: none;">
                            <div class="suggestionList" id="apparat_list">
                            </div>
                        </div>
                    </div>

                    <div class="span6">

                        <input class="" type="text" id="inputProizvod" onkeyup="look_proizvod(this.value);" placeholder="Поиск бренда">

                        <?php echo form_dropdown('id_proizvod', $options_proizvoditel, $id_proizvod_selected, 'class="" id="id_proizvod" required="required" title="Бренд"');?>


                        <a href="#" class="btn margin-bottom-10px" onclick="anichange(this); return false"><i class="icon-plus"></i></a>
					<span name="proizvod_span" style="display: none;">
						<input class="" name="add_proizvod_name" id="add_proizvod_name" type="text" placeholder="Введите название бренда">
						<input class="btn margin-bottom-10px" name="submit" id="add_proizvod" type="button" value="Добавить бренд">
					</span>

                        <div class="suggestionsBox" id="proizvod_box" style="display: none;">
                            <div class="suggestionList" id="proizvod_list">
                            </div>
                        </div>


                    </div>

                </div>-->
            <div></div>

            <div class="span12">
                <div class="span6">
                    <?php echo form_dropdown('id_aparat', $options_ap, '', 'class="chzn-select" id="id_apparat" required="required" title="Аппарат"');?>

                    <a href="#" class="btn btn-mini" onclick="anichange(this); return false"><i class="icon-plus"></i></a>

					<span name="aparat_span" style="display: none;">
						<input class="" name="add_aparat_name" id="add_aparat_name" type="text" placeholder="Введите название аппарата">
						<input class="btn btn-mini btn-success margin-bottom-10px" name="submit" id="add_aparat" type="button" value="Добавить" >
					</span>

                    </span>
                </div>
                <div class="span6">
                    <?php echo form_dropdown('id_proizvod', $options_proizvoditel, '', 'class="chzn-select" id="id_proizvod" required="required" title="Бренд"');?>
                    <a href="#" class="btn btn-mini" onclick="anichange(this); return false"><i class="icon-plus"></i></a>
					<span name="proizvod_span" style="display: none;">
						<input class="" name="add_proizvod_name" id="add_proizvod_name" type="text" placeholder="Введите название бренда">
						<input class="btn btn-mini btn-success margin-bottom-10px" name="submit" id="add_proizvod" type="button" value="Добавить">
					</span>
                </div>

            </div>

            <div class="span12">
            </div>

            <div class="span12">
                <div class="span4">
                    <input autocomplete="off" name="model" type="text" placeholder="Введите модель аппарата" required="required" title="Модель">
                </div>
                <div class="span4">
                    <input autocomplete="off" name="ser_nomer" type="text" placeholder="Введите серийный номер" required="required" title="Серийный номер">
                </div>
            </div>

            <div class="span12">
                <div class="span4">
                    <textarea id="" rows="3" name="neispravnost" placeholder="Введите неисправность, например: 'Не включается'" required="required" title="Неисправность"></textarea>
                </div>

                <div class="span4">
                    <textarea id="" rows="3" name="komplektnost" placeholder="">Без упаковки (без заводского комплекта), без блока питания, без сетевых (соединительных) кабелей, без SIM карт и съемных носителей.</textarea>
                </div>

                <div class="span4">
                    <textarea id="" rows="3" name="vid" placeholder="appearance">Внешний вид: следы эксплуатации: царапины, потёртости, б/у </textarea>
                </div>
            </div>

            <div class="span12">
            </div>

            <div class="span12">
                <div class="span4">

                    <?php  echo form_dropdown('id_remonta', $options_id_remonta, $id_remonta_selected, 'class="" id="id_remonta" required="required" title="Тип ремонта"');?>
                </div>
                <div class="span4">

                    <?php  echo form_dropdown('id_sc', $options_id_sc, $id_sc_selected, 'class="" id="id_sc" required="required" title="Сервисный Центр"');?>
                </div>
                <div class="span4">

                    <textarea name="primechaniya" placeholder="Если есть что добавить - напишите примечание"></textarea>
                </div>
            </div>



            <div class="span12">
                <input autocomplete="off" name="search_user" id="search_user" type="search" placeholder="Поиск клиентов по фамилии" class="search-query">
                <div id="user_box" style="display: none;">
                    <div id="user_list">
                    </div>
                </div>
            </div>


            <div class="span12">
                <div class="span4">
                    <input name="user_id" id="user_id" type="hidden">
                    <input autocomplete="off" name="fam" id="fam" type="text" placeholder="Фамилия" required="required" title="Фамилия">
                </div>
                <div class="span4">
                    <input autocomplete="off" name="imya" id="imya" type="text" placeholder="Имя" required="required" title="Имя">
                </div>
                <div class="span4">
                    <input autocomplete="off" name="otch" id="otch" type="text" placeholder="Отчество" title="Отчество">
                </div>
            </div>
            <div class="span12">
                <div class="span4">
                    <input autocomplete="off" name="phone" id="phone" type="text" placeholder="Телефон" required="required" title="Телефон">
                </div>
                <div class="span4">
                    <input autocomplete="off" name="mail" id="mail" type="text" placeholder="E-MAIL">
                </div>
                <div class="span4">
                    <input autocomplete="off" name="adres" name="adres" type="text" placeholder="Адрес">
                </div>
            </div>


            <div class="span12">
                <input type="button" name="new_kvit" value="Добавить" class="btn btn-success">
            </div>
        </form>
    </div>


</div>
<div id="overlay"></div>

</div>
</div>