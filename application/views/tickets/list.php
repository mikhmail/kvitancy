<div class="container-fluid" xmlns="http://www.w3.org/1999/html">

      <ul class="breadcrumb" style="margin-bottom: 20px;">
        <li>
          <a href="<?php echo site_url("/"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
       <a href="<?php echo site_url('tickets/'. strtolower(ucfirst($this->uri->segment(2)))); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a>


          <li class="pull-right">
              <div class="btn-group">
                  <a href="#" id="new-order-button"><button class="btn btn-success">Новая квитанция <i class="icon-plus icon-white"></i></button></a>
              </div>
          </li>
      </ul>



<?php

echo form_open('tickets', array('class' => 'form-inline', 'id' => 'myform'));


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
if(count($count_kvitancys)>=1) {

if (count($soglasovat) > 0 OR count($my_kvitancy) > 0){
?>
<div class="row-fluid">
<div class="span12">

<?php
if (count($soglasovat) > 0) {

/* Сортировка масива по статусам */
$row_global_sost = array ();
foreach ($soglasovat as $key=>$row) { //arr63
    $row_global_sost[$row["name_sost"]][] = $row;
}

foreach ($row_global_sost as $name_sost => $row_sost) {?>

    <p><b><?=$name_sost?>:</b>



        <? foreach ($row_sost as $arr_gog) {?>



            <a href="#" id="kvit_pokaz_call_<?=$arr_gog['id_kvitancy']?>" name="<?=$arr_gog['id_kvitancy']?>">&nbsp;<b>&laquo;</b><?=$arr_gog['aparat_name']?> <?=$arr_gog['name_proizvod']?> <?=$arr_gog['model']?><b>&raquo;</b>&nbsp;&nbsp;&nbsp;</a>
        
        <?}?>

<?}}?>


<?php if (count($my_kvitancy) > 0 ) {?>
<p><b>Мои заявки:</b>

    <? foreach ($my_kvitancy as $arr_gog) {?>

        <!--
						<a href="<?=site_url("tickets")?>/view/<?=$arr_gog['id_kvitancy']?>/">&nbsp;<b>&laquo;</b><?=$arr_gog['aparat_name']?> <?=$arr_gog['name_proizvod']?> <?=$arr_gog['model']?><b>&raquo;</b>&nbsp;&nbsp;&nbsp;</a>
						-->
        <a href="#" id="kvit_pokaz_my_<?=$arr_gog['id_kvitancy']?>" name="<?=$arr_gog['id_kvitancy']?>">&nbsp;<b>&laquo;</b><?=$arr_gog['aparat_name']?> <?=$arr_gog['name_proizvod']?> <?=$arr_gog['model']?><b>&raquo;</b>&nbsp;&nbsp;&nbsp;</a>

    <?}
    }?>
</p>

</div>
</div>
<?}?>

<div class="row-fluid">

    <?php


    if(count($aparats) >= 1) {
        /* Сортировка масива по аппаратам */
        $row_global1 = array ();
        foreach ($aparats as $a=>$row) { //arr63
            $row_global1[$row["aparat_name"]][] = $row;
        }

        /* Сортировка масива по состояниям */
        $row_global2 = array ();
        foreach ($aparats as $a=>$row) { //arr63
            $row_global2[$row["name_sost"]][] = $row;
        }
    }
    ?>


    <div class="span12">

        <ul class="nav nav-tabs">

            <li class="<?if ($id_sost_selected == false) echo 'active';?>">
                <a href="#" id="sost_128" name=""><b>Все что в ремонте</b><sup class="badge badge-important"><?=count($aparats)?></sup></a>
            </li>

            <?foreach ($row_global2 as $name_sost => $value) {?>

                <li class="<?if($value[0]["id_sost"] == $id_sost_selected) echo 'active';?>">
                    <a href="#" id="sost_<?=$value[0]["id_sost"]?>" name="<?=$value[0]["id_sost"]?>"><?=$name_sost?> <sup style="background-color:<?=$value[0]['background']?>" class="badge badge-important"> <?=count($value)?></sup></a>
                </li>
            <?}?>
        </ul>

    </div>





            <div class="row-fluid">

                <legend>Найдено <strong><?=$count_kvitancys?></strong>

                    <div class="pagination pull-right">
                        <?=$this->pagination->create_links()?>
                    </div>
                </legend>




            </div>



    <div class="row-fluid">
    <div class="span2">
        <ul class="nav nav-tabs nav-stacked">
            <?foreach ($row_global1 as $aparat_name => $value) {
            //if ($_SESSION["id_sc"] !=1) { $id_sc_now = $filter->select_id_sc($_SESSION["id_sc"]); } else {$id_sc_now = '';} //var_dump($value);die;?>
            <li class="<?if($value[0]["id_aparat"] == $id_aparat_selected) echo 'active';?>">
                <a href="#" id="aparat_<?=$value[0]["id_aparat"]?>" name="<?=$value[0]["id_aparat"]?>"><?=$aparat_name?> <span class="label label-info pull-right"><?=count($value)?></span>
                </a>
                <?}?>
        </ul>
    </div>


    <div class="span10">



        <div class="row">

            <table class="table table-bordered table-condensed">

                <tr>
                    <td>
                        <table class="table">
                            <tr class="chart-bottom-heading">
                                <th class="span1"><span style="padding:0px 20px;">#</span></th>
                                <th class="span2 chart-bottom-heading">Статус</th>
                                <th class="span3">Аппарат</th>
                                <th class="span3">Неисправность</th>
                                <th class="span2">Дата приема в ремонт</th>
                                <th class="span2">В ремонте/Выдан</th>
                                <th class="span2">Сервис</th>
                                <th class="span3">Клиент</th>
                            </tr>
                         </table>
                    </td>
                </tr>

                <?  if(count($kvitancys) >= 1) {
                foreach($kvitancys as $row) { ?>
                    <? $comments = $this->kvitancy_model->get_comments($row['id_kvitancy']); ?>
                    <tr>
                        <td>
                            <a href="#" onclick="anichange_kvitancy(this); return false">
                                <table class="table table-condensed">
                                    <tr>
                                        <td class="span1">

                                            <span class="label label-info pull-right"># <?=$row['id_kvitancy']?></span>
                                        </td>
                                        <td class="span2">
                                            <div id="background_<?=$row['id_kvitancy']?>" style="background-color:<?=$row['background']?>" class="label"><?=$row['name_sost']?></div>
                                        </td>
                                        <td class="span3"><?=$row['aparat_name'].' '.$row['name_proizvod'].' '.$row['model']?></td>
                                        <td class="span3"><?=$row['neispravnost']?></td>

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
                                        <td class="span2"><?=$row['name_sc']?></td>
                                        <td class="span3"><?=$row['fam'].' '.$row['imya'].' '.$row['phone']?></td>
                                    </tr>
                                </table>
                            </a>
                            <div style="display: none; margin-bottom: 20px; padding: 10px;">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1_<?=$row['id_kvitancy']?>" data-toggle="tab">Опции</a></li>
                                    <li><a href="#tab2_<?=$row['id_kvitancy']?>" data-toggle="tab">Информация</a></li>
                                    <li><a href="#tab3_<?=$row['id_kvitancy']?>" data-toggle="tab">Комментарии <sup class="badge"><?=count($comments)?></sup></a></li>
                                    <li><a href="#tab4_<?=$row['id_kvitancy']?>" data-toggle="tab">Ремонт/Запчасти</a></li>
                                    <!--<li><a href="#tab5_<?=$row['id_kvitancy']?>" data-toggle="tab">Склад/</a></li>-->
                                    <li><a href="#tab6_<?=$row['id_kvitancy']?>" data-toggle="tab">Печать/Редактировать</a></li>


                                </ul>
                                <div class="tab-content">
                                    <div style="margin-bottom: 20px;" class="tab-pane active" id="tab1_<?=$row['id_kvitancy']?>">



                                        <?=form_dropdown($row['id_kvitancy'], $options_sost, $row['id_sost'], 'id=status_' . $row['id_kvitancy'] . ' class=""')?>

                                        <?if ($row['id_mechanic']) {
                                            $id_mechanic_selected = $row['id_mechanic'];
                                        }else{
                                            $id_mechanic_selected='';
                                        }?>

                                        <?=form_dropdown($row['id_kvitancy'], $options_id_meh, $id_mechanic_selected, 'id=meh_' . $row['id_kvitancy'] . ' class=""')?>

                                        <?
                                        $options_id_responsible = array('' => "Выбрать ответственного");

                                        foreach ($resp as $array) {
                                            $options_id_responsible[$array['id']] = $array['user_name'];
                                        }

                                        if ($row['id_responsible']) {
                                            $id_responsible_selected = $row['id_responsible'];
                                        }else{
                                            $id_responsible_selected='';
                                        }?>

                                        <?=form_dropdown($row['id_kvitancy'], $options_id_responsible, $id_responsible_selected, 'id=resp_' . $row['id_kvitancy'] . ' class=""')?>

                                    </div>
                                    <div style="margin-bottom: 20px;" class="tab-pane" id="tab2_<?=$row['id_kvitancy']?>">
                                        <table class="table table-bordered table-condensed">
                                            <tr>

                                                <td>
                                                    <ul>

                                                        <li><b>Обновлено:</b> <?=$row['update_time']?> by

                                                            <?
                                                            foreach ($users as $user) {
                                                                if ($user['id'] == $row['update_user']) echo $user['user_name'];
                                                            }
                                                            ?>

                                                        </li>
                                                        <li><b>Адрес клиента:</b> <?=$row['adres']?></li>
                                                        <li><b>Вид ремонта:</b>

                                                            <?
                                                            foreach ( $remont as $a=>$rowidrem)
                                                            {
                                                                if($rowidrem['id_remonta'] == $row['id_remonta']) echo $rowidrem['name_remonta'];
                                                            }
                                                            ?>
                                                        <li><b>Внешний вид аппарата:</b> <?=$row['vid']?></li>
                                                        <li><b>Серийный номер аппарата:</b> <?=$row['ser_nomer']?></li>
                                                        <li><b>Комплектность:</b> <?=$row['komplektnost']?></li>
                                                        <li><b>Приёмка:</b>

                                                            <?
                                                            foreach ($sc as $a=>$rowsc)
                                                            {
                                                                if($rowsc['id_sc'] == $row['id_sc']) echo $rowsc['name_sc'];
                                                            }
                                                            ?>
                                                        </li>
                                                        <li><b>Примечания:</b> <?=$row['primechaniya']?></li>

                                                    </ul>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div style="margin-bottom: 20px;" class="tab-pane" id="tab3_<?=$row['id_kvitancy']?>">
                                        <table class="table table-bordered table-condensed">
                                            <tr>
                                                <td>
                                                    <ul id="ul_<?=$row['id_kvitancy']?>">
                                                        <?foreach($comments as $rowc)
                                                        {?>

                                                            <li id="li_<?=$rowc['id_comment']?>" ><?=$rowc['date'] . ' ' . $rowc['first_name'] . ' ' . $rowc['last_name'] . ' aka ' . $rowc['user_name'] . ' пишет: ' . '<br><font color="#0066CC"><b>' . $rowc['comment']?></b></font>

                                                                <? if ($rowc['id_user'] == $this->session->userdata['user_id'])
                                                                {?>
                                                                    <input class="btn btn-danger btn-mini" type="button" value="Удалить" id="dell_comment_<?=$rowc['id_comment']?>" name="<?=$rowc['id_comment']?>">
                                                                <?}?>
                                                            </li>
                                                        <?}?>
                                                    </ul>


                                                    <textarea name="comment_<?=$row['id_kvitancy']?>"></textarea>
                                                    <input class="btn btn-success btn-mini" type="button" name="comment" id="comment_<?=$row['id_kvitancy']?>" value="Добавить комментарий"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div style="margin-bottom: 20px;" class="tab-pane" id="tab4_<?=$row['id_kvitancy']?>">
                                        <div class="row-fluid" name="price" style="margin-bottom: 20px;">
                                            <div class="span6">
                                                Сумма, полученная от клиента за ремонт: <input type="number" min=0 step="0.1" value="<?if($row['full_cost']) echo $row['full_cost'];?>" id="price_<?=$row['id_kvitancy']?>" class="span2">
                                                <input class="btn margin-bottom-10px btn btn-success" type="button" value="Сохранить" id="save_price_<?=$row['id_kvitancy']?>">
                                            </div>
                                            <div class="span6 pull-left">
                                                Фактическая сумма за ремонт [Выполненные работы + Установленные запчасти]:
                                                <span class="label label-important pull-right"><strong><?=$this->kvitancy_model->get_sum($row['id_kvitancy']);?></strong></span>
                                            </div>
                                        </div>

                                    <legend></legend>
                                        <div class="row-fluid" name="work" style="margin-bottom: 20px;">
                                            <div class="span10">
                                                <div class="pull-left"><h4>Выполненные работы</h4></div>
                                                </div>

                                                    <?
                                                    $options_id_responsible = array('' => "Выбрать исполнителя");

                                                    foreach ($resp as $array) {
                                                        $options_id_responsible[$array['id']] = $array['user_name'];
                                                    }

                                                    if ($row['id_responsible']) {
                                                        $id_responsible_selected = $row['id_responsible'];
                                                    }else{
                                                        $id_responsible_selected='';
                                                    }?>

                                            <div class="span10">
                                                <table table table-bordered table-condensed id="table_work_<?=$row['id_kvitancy']?>">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <?=form_dropdown($row['id_kvitancy'], $options_id_responsible, $id_responsible_selected, 'id=work_resp_' . $row['id_kvitancy'] . ' class="" placeholder="Исполнитель"')?>
                                                        </th>
                                                        <th><input type="text" id="work_name_<?=$row['id_kvitancy']?>" autocomplete="off" placeholder="Наименование работы" name="title" class=""></th>
                                                        <th><input type="number" min=0 step="0.1" id="work_cost_<?=$row['id_kvitancy']?>" autocomplete="off" name="price" placeholder="Cтоимость" class=""></th>
                                                        <th>
                                                            <div class="btn-group margin-bottom-10px">
                                                                <button id="work_add_<?=$row['id_kvitancy']?>" class="btn btn-success"><i class="icon-plus icon-white"></i>Добавить</button>
                                                            </div>
                                                        </th>
                                                        <th></th>

                                                    </tr>
                                                    </thead>
                                                <?
                                                $works = $this->kvitancy_model->get_works($row['id_kvitancy']);
                                                if(count($works)>0){
                                                foreach($works as $work){
                                                    $user = $this->users_model->get_users_by_id ($work['user_id']);
                                                    ?>
                                                        <tr id="work_tr_<?=$work['id']?>">
                                                        <td><?=$user[0]['user_name']?></td>
                                                        <td><?=$work['name']?></td>
                                                        <td><?=$work['cost']?></td>
                                                        <td><?=$work['date_added']?></td>
                                                        <td>
                                                            <div class="btn-group margin-bottom-10px">
                                                                <button name="<?=$work['id']?>" id="work_dell_<?=$work['id']?>" class="btn btn-danger"><i class="icon-remove icon-white"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?}}?>
                                                </table>
                                            </div>

                                        </div>

                                        <legend>
                                        </legend>

                                        <div class="row-fluid" name="parts" style="margin-bottom: 20px;">
                                            <h4>Запчасти</h4>
                                            <div class="span10">
                                                <div class="pull-left">
                                                    <i class="icon-chevron-right icon"></i>
                                                    <b>Добавить на склад новую запчасть и списать на эту квитанцию</b></div>
                                            </div>


                                            <div class="span10">
                                                <input type="text" name="select_parts_<?=$row['id_kvitancy']?>" autocomplete="off" placeholder="Название запчасти" value="" title="" id="" alt="<?=$row['id_aparat']?>">
                                                <div name="parts_box" id="parts_box_<?=$row['id_kvitancy']?>" style="display: none;">
                                                    <div class="parts_list">
                                                    </div>
                                                </div>
                                                <input maxlength="2" size="2" type="number" min=1 name="store_count_<?=$row['id_kvitancy']?>" autocomplete="off" placeholder="Количество" class="span2" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                                <select name="store_id_sost_<?=$row['id_kvitancy']?>" class="span2">
                                                    <option value="" selected>-выбрать-</option>
                                                    <option value="1">Новый</option>
                                                    <option value="0">Б.У.</option>
                                                </select>
                                                <input type="number" min=0 step="0.1" name="store_cost_<?=$row['id_kvitancy']?>" autocomplete="off" placeholder="Себестоимость" class="span2">
                                                <input type="number" min=0 step="0.1" name="store_price_<?=$row['id_kvitancy']?>" autocomplete="off" placeholder="Цена" class="span2">
                                                <input type="text" name="store_text_<?=$row['id_kvitancy']?>"autocomplete="off" placeholder="Описание:тип, цвет, размер, и тд">
                                                <div class="btn-group margin-bottom-10px">
                                                    <button id="parts_add_<?=$row['id_kvitancy']?>" class="btn btn-success"><i class="icon-plus icon-white"></i>Добавить</button>
                                                </div>
                                            </div>
                                            <div class="span8 margin-top-20px margin-bottom-10px">

                                                <i class="icon-chevron-right icon"></i>
                                                        <a href="#" onclick="anichange(this); return false" class="btn btn-primary"><i class="icon-barcode icon-white"></i>Выбрать запчасть со склада</a>
                                                        <div class="row-fluid hide">
                                                            <div class="modal-header">

                                                                <h3>Склад</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row-fluid">
                                                                    <div class="span5">
                                                                        <?php echo form_dropdown('id_aparat', $options_ap, '', 'id="store_add_id_aparat" class="chzn-select"');?>
                                                                    </div>
                                                                    <div class="span5" id="store_select">
                                                                        <?php echo form_dropdown('id_aparat_p', array('' => "-"), '', 'id="store_add_id_aparat_p" title='.$row['id_kvitancy'].' class="select-container"');?>
                                                                    </div>

                                                                </div>
                                                                <div class="row-fluid" id="store_modal">

                                                                </div>
                                                            </div>

                                                        </div>


                                            </div>
                                            <div class="span10">
                                                <div class="pull-left"><b>Установленные запчасти</b></div>
                                            </div>
                                            <div class="span10">
                                                <table table table-bordered table-condensed id="table_store_<?=$row['id_kvitancy']?>">
                                                    <thead>
                                                    <tr>
                                                        <th>Название</th>
                                                        <th>Описание</th>
                                                        <th>Состояне</th>

                                                        <th>Себестоимость</th>
                                                        <th>Цена</th>
                                                        <th>Кто</th>
                                                        <th>Когда</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>

                                                    <?
                                                    $store = $this->kvitancy_model->get_store($row['id_kvitancy']);
                                                    if(count($store)>0){
                                                    foreach($store as $parts){
                                                        $user = $this->users_model->get_users_by_id ($parts['user_id']);
                                                        $aparat_p = $this->kvitancy_model->get_aparat_p_by_id ($parts['id_aparat_p']);
                                                        ?>
                                                        <tr id="part_tr_<?=$parts['id']?>">
                                                            <td><?=$aparat_p[0]['title']?></td>
                                                            <td><?=$parts['name']?></td>
                                                            <td><? if($parts['id_sost'] == 1) {echo 'Новый';} else echo 'Б.У.';?></td>
                                                            <td><?=$parts['cost']?></td>
                                                            <td><?=$parts['price']?></td>
                                                            <td><?=$user[0]['user_name']?></td>
                                                            <td><?=$parts['date_priemka']?></td>

                                                            <td>
                                                                <div class="btn-group margin-bottom-10px">
                                                                    <button name="<?=$parts['id']?>" id="part_dell_<?=$parts['id']?>" class="btn btn-danger"><i class="icon-remove icon-white"></i></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?}}?>

                                                </table>
                                            </div>



                                        </div>




                                        </div><!--end remont -->
                 <!--
                <div style="margin-bottom: 20px;" class="tab-pane" id="tab5_<?=$row['id_kvitancy']?>">
                <span>
                                        123
                </span>

                </div><!-- end  -->
            <div style="margin-bottom: 20px;" class="tab-pane" id="tab6_<?=$row['id_kvitancy']?>">
                <span>
                                        <a href="<?=site_url()?>tickets/update/<?=$row['id_kvitancy']?>" class="" target="_blank">
                                            <button class="btn margin-bottom-10px"><i class="icon-edit"></i> Редактировать</button>
                                        </a>
                                        <a href="<?=site_url()?>tickets/update_client/<?=$row['user_id']?>" class="" target="_blank">
                                            <button class="btn margin-bottom-10px"><i class="icon-edit"></i> Редактировать клиента</button>
                                        </a>

                                        <a href="<?=site_url()?>tickets/printing/<?=$row['id_kvitancy']?>" class="" target="_blank">
                                            <button class="btn margin-bottom-10px"><i class="icon-print"></i> Печать</button>
                                        </a>
                                        <a href="<?=site_url()?>tickets/printing_check/<?=$row['id_kvitancy']?>" class="" target="_blank">
                                            <button class="btn margin-bottom-10px"><i class="icon-print"></i> Печать чека</button>
                                        </a>
                </span>

            </div><!-- end print -->

                                </div>
                            </div>
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
                    <input autocomplete="off" name="search_user" id="search_user" type="search" placeholder="Поиск клиентов по фамилии">
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