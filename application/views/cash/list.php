<? //var_dump($works);die;?>
<div class="container-fluid" xmlns="http://www.w3.org/1999/html">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("cash"); ?>">
                <?php echo ucfirst($this->uri->segment(1));?>
            </a>
            <span class="divider">/</span>
        </li>

        <a href="<?php echo site_url('cash/'. strtolower(ucfirst($this->uri->segment(2)))); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
        </a>
    </ul>

    <div class="page-header users-header">
        <h2>
            Касса за текущий месяц.
            <!--<a  href="<?php echo site_url("cash").'/'; ?>add" class="btn btn-success pull-right">Добавить</a>-->
        </h2>
    </div>

    <div class="row-fluid">

        <div class="span10">
            <div class="pull-left">

                <h3><i class="icon-chevron-right icon"></i>Добавить новую запись</h3>
            </div>
        </div>


        <div class="span10">


            <input type="number" min="-99999999" step="0.1" name="plus" id="plus" title="Можно вводить с минусом, например: -500" autocomplete="off" placeholder="Сумма*" class="span2" style="border: 1px solid rgb(173, 61, 61);">
            <input type="text" name="name"  id="name" placeholder="Описание*" class="span4" style="border: 1px solid rgb(173, 61, 61);">

            <input type="number" min=1 step="1" name="id_kvitancy"  id="id_kvitancy" autocomplete="off" placeholder="Номер квитанции" class="span2">

            <div class="btn-group margin-bottom-10px">
                <button id="plus_add" class="btn btn-success"><i class="icon-plus icon-white"></i>Добавить</button>
            </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="span12 columns">

            <div class="well">

                <?php

                $options_works = array();

                if(count($works) > 0) {

                    foreach ($works as $array) {
                        foreach ($array as $key => $value) {
                            $options_works[$key] = $key;
                        }
                        break;
                    }
                }
                $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');

                echo form_open('cash', $attributes);


                //$options_date = array('date_priemka' => 'Дата приема', 'date_vydachi' => 'Дата выдачи', 'date_okonchan' => 'Дата окон.ремонта');
                //echo form_dropdown('date', $options_date, $date_selected, 'class=""');
                ?>
                От:
                <?
                echo form_date('start_date', $start_date_selected);
                ?>
                До:
                <?
                echo form_date('end_date', $end_date_selected);

                $options_id_sc = array('' => "Выбрать СЦ");

                foreach ($sc as $array) {
                    $options_id_sc[$array['id_sc']] = $array['name_sc'];
                }
                echo form_dropdown('id_sc', $options_id_sc, $id_sc_selected, 'class=""');


                /*
                $options_id_responsible = array('' => "Выбрать ответственного");

                foreach ($users as $array) {
                    $options_id_responsible[$array['id']] = $array['user_name'];
                }

                echo form_dropdown('id_resp', $options_id_responsible, $id_resp_selected, 'class="chzn-select"');


                // echo form_label('Аппарат: ');
                $options_ap = array('' => "Выбрать аппарат");

                foreach ($ap as $array) {
                    $options_ap[$array['id_aparat']] = $array['aparat_name'];
                }
                echo form_dropdown('id_aparat', $options_ap, $id_aparat_selected, 'class="chzn-select"');
                */
                ?>



                <?
                /*
                //echo form_label('Производитель: ');
                $options_proizvoditel = array('' => "Выбрать бренд");

                foreach ($proizvoditel as $array) {
                    $options_proizvoditel[$array['id_proizvod']] = $array['name_proizvod'];
                }

                echo form_dropdown('id_proizvod', $options_proizvoditel, $id_proizvod_selected, 'class="chzn-select"');
                */
                ?>

                <label class="control-label" style="display: none" for="order">Сортировать по:</label>
                <?

                $options_works = array( 'cash.id' => 'по ID');
                echo form_dropdown('order', $options_works, $order_selected, 'class="span2" style="display: none"');

                //$data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Поиск');

                $options_order_type = array('Asc' => 'По возрастанию', 'Desc' => 'По убыванию');
                echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="select-container"');

                //echo form_submit($data_submit);
                ?>
                <input type="submit" name="mysubmit" value="Показать" class="btn btn-info">


            </div>

        </div>
    </div>
    <div class="row-fluid">
        <div class="span12 columns">

            <div class="pull-left">
                <input type="number" step="1" min="1" name="id_kvitancy" value="<?if($id_kvitancy_selected) echo $id_kvitancy_selected;?>" placeholder="Введите номер квитанции" class="search-query">
                <input type="submit" name="mysubmit" value="Показать" class="btn btn-info">
            </div>

            <div class="pull-right">
                <input type="text" name="search_string" value="<?if($search_string_selected) echo $search_string_selected;?>" placeholder="Поиск по описанию" title="Поиск по описанию" class="search-query">
                </label><input type="submit" name="mysubmit" value="Поиск" class="btn btn-info">    </div>
        </div>
    </div>
    <div class="row-fluid">
        <legend>Найдено <strong><?=$count_works?></strong> записей, на сумму <strong><?=$summ[0]['SUM']?></strong>

            <div class="pagination pull-right">
                <?=$this->pagination->create_links()?>
            </div>
        </legend>
    </div>

    <?echo form_close();?>

    <div class="row-fluid">

        <?

        if (count($works) > 0) {//var_dump($works);die;

            ?>


            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th class="header">#</th>
                    <th class="yellow header headerSortDown">Приход +</th>
                    <th class="yellow header headerSortDown">Расход -</th>
                    <th class="yellow header headerSortDown">Описание</th>
                    <th class="yellow header headerSortDown">Ответственный</th>
                    <th class="yellow header headerSortDown">Дата</th>
                    <th class="yellow header headerSortDown">СЦ</th>
                    <th class="header">#квитанции</th>
                    <th class="header">Опции</th>


                </tr>
                </thead>
                <tbody>
                <?php
                foreach($works as $row)
                {?>
                    <tr>
                        <td><p class="text-center"><?=$row['cash_id']?></p></td>
                        <td style="text-align: center"><div class="label label-success"><? if($row['plus']>= 0) echo '+'.$row['plus'];?></div></td>
                        <td style="text-align: center"><div class="label label-important"><? if($row['plus']<0) echo $row['plus'];?></div></td>
                        <td><?=$row['name']?></td>

                        <td style="text-align: center"><p class="text-center"><?
                            foreach ($users as $rows)
                            {
                                if ($rows['id'] == $row['update_user']) echo $rows['user_name'];
                            }?>
                        </p></td>
                        <td style="text-align: center"><p class="text-center"><?=$row['update_date']?>, <?=$row['update_time']?></p></td>
                        <td style="text-align: center"><p class="text-center"><?=$row['name_sc']?></p></td>
                        <td style="text-align: center"><p class="text-center"><? if($row['id_kvitancy']) echo $row['id_kvitancy']; ?></p></td>


                        <td style="text-align: center"><p class="text-center">
                            <? echo '

                    <a href="'.site_url("cash").'/delete/'.$row['cash_id'].'" class="btn btn-danger btn-mini">Удалить</a>
                    <a href="'.site_url("cash").'/edit/'.$row['cash_id'].'" class="btn btn-primary btn-mini">Изменить</a>
                    ';?>

                        </p></td>




                    </tr>
                <?}?>
                </tbody>
            </table>
        <?}?>

    </div>
    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
