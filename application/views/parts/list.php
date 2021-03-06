<?//=print_r($summ);die;?>
<div class="container-fluid">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("parts"); ?>">
                <?php echo ucfirst($this->uri->segment(1));?>
            </a>
            <span class="divider">/</span>
        </li>

        <a href="<?php echo site_url('parts/'. strtolower(ucfirst($this->uri->segment(2)))); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
        </a>
    </ul>

    <div class="page-header users-header">
        <h2>Необходимые запчасти, которые надо купить</h2>
        <p>После покупки запчасти можно будет поставить на склад.</p>
            <a  href="<?php echo site_url("parts").'/'; ?>add" class="btn btn-success pull-right">Добавить</a>

    </div>

    <div class="row-fluid">
        <div class="span12 columns">

            <div class="well">

                <?php

                $options_store = array();

                if(count($store) > 0) {

                    foreach ($store as $array) {
                        foreach ($array as $key => $value) {
                            $options_store[$key] = $key;
                        }
                        break;
                    }
                }
                $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');

                echo form_open('parts', $attributes);


                $options_status = array('' => "Что показать", '1' => "Актуально", '2' => "Списано",);
                echo form_dropdown('id_status', $options_status, $id_status_selected, 'class="chzn-select"');


                $options_id_sc = array('' => "Выбрать сервис");

                foreach ($sc as $array) {
                    $options_id_sc[$array['id_sc']] = $array['name_sc'];
                }
                echo form_dropdown('id_where', $options_id_sc, $id_where_selected, 'class="chzn-select"');


                $options_id_responsible = array('' => "Выбрать ответственного");

                foreach ($users as $array) {
                    $options_id_responsible[$array['id']] = $array['user_name'];
                }

                echo form_dropdown('id_resp', $options_id_responsible, $id_resp_selected, 'class="chzn-select"');?>

                <?
                // echo form_label('Аппарат: ');
                $options_ap = array('' => "Выбрать аппарат");

                foreach ($ap as $array) {
                    $options_ap[$array['id_aparat']] = $array['aparat_name'];
                }
                echo form_dropdown('id_aparat', $options_ap, $id_aparat_selected, 'class="chzn-select"');
                ?>



                <?
                //echo form_label('Производитель: ');
                $options_proizvoditel = array('' => "Выбрать бренд");

                foreach ($proizvoditel as $array) {
                    $options_proizvoditel[$array['id_proizvod']] = $array['name_proizvod'];
                }

                echo form_dropdown('id_proizvod', $options_proizvoditel, $id_proizvod_selected, 'class="chzn-select"');
                ?>

                <label class="control-label" for="order">Сортировать по:</label>
                <?
               // echo form_dropdown('order', $options_store, $order, 'class="span2"');

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
                <input type="number" step="1" min="1" name="id_kvitancy" value="" placeholder="Введите номер квитанции" class="search-query">
                <input type="submit" name="mysubmit" value="Показать" class="btn btn-info">
            </div>

            <div class="pull-right">
                <input type="text" name="search_string" value="" placeholder="Поиск по описанию" title="Поиск по описанию" class="search-query">
                </label><input type="submit" name="mysubmit" value="Поиск" class="btn btn-info">    </div>
        </div>
   </div>
    <div class="row-fluid">
        <legend>Найдено <strong><?=$count_store?></strong>

            <div class="pagination pull-right">
                <?=$this->pagination->create_links()?>
            </div>
        </legend>
    </div>

    <?echo form_close();?>

    <div class="row-fluid">

<?

if (count($store) > 0) {//var_dump($store);die;

?>


            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th class="header">#</th>
                    <th class="header">Статус</th>

                    <th class="yellow header headerSortDown">Запчасть</th>
                    <th class="yellow header headerSortDown">Описание</th>
                    <th class="yellow header headerSortDown">Номер квитанции</th>
                    <th class="yellow header headerSortDown">Статус квитанции</th>
                    <th class="yellow header headerSortDown">Сервис</th>
                    <th class="yellow header headerSortDown">Ответственный</th>
                    <th class="yellow header headerSortDown">Добавлено</th>



                    <th class="yellow header headerSortDown">Управление</th>

                </tr>
                </thead>
                <tbody>
                <?php
                foreach($store as $row)
                {?>
                   <tr id="parts_tr_<?=$row['store_id']?>">
                    <td><p class="text-center"><?=$row['store_id']?></p></td>
                    <td><p class="text-center label"><?if ($row['status'] == 1) {echo 'Актуально';}else{echo 'Не актуально';}?></p></td>

                    <td><?=$row['aparat_name']?> <?=$row['name_proizvod']?> => <strong><?=$row['title']?></strong></td>
                    <td><p class="text-center"><?=$row['name']?></p></td>
                       <td><p class="text-center"><?=$row['id_kvitancy']?></p></td>

                       <td><p class="text-center">
                            <?
                            $sost = $this->parts_model->get_sost($row['id_kvitancy']);
                            ?>

                            <span style="background-color:<?=$sost[0]['background']?>" class="label"><?=$sost[0]['name_sost']?></span>
                        </p></td>

                    <td><p class="text-center">

                        <? if ($row['status'] == 0) {
                                if($row['id_kvitancy']){?>
                                    Списан #<?=$row['id_kvitancy']?>
                                 <? }else{ ?>
                                    Списан "<?=$row['text']?>"
                                <?}

                        }else{

                                foreach ($sc as $rows)
                                {
                                    if ($rows['id_sc'] == $row['id_where']) echo $rows['name_sc'];
                                }

                            }?>

                    </p></td>
                    <td>
                        <div class="span3 text-center">
                            <?
                            $options_id_responsible = array('' => "Выбрать ответственного");

                            foreach ($users as $array) {
                                $options_id_responsible[$array['id']] = $array['user_name'];
                            }

                            if ($row['id_resp']) {
                                $id_responsible_selected = $row['id_resp'];
                            }else{
                                $id_responsible_selected='';
                            }?>

                            <?=form_dropdown($row['store_id'], $options_id_responsible, $id_responsible_selected, 'id=parts_resp_' . $row['store_id'] . ' class=""')?>
                        </div>

                    </td>
                    <td><p class="text-center"><?=$row['date_priemka']?> / <?=$row['user_name']?></p></td>

                    <td>
                        <? if($row['status'] != 0) {?>

                    <button id="add_parts2store_<?=$row['id_kvitancy']?>" class="btn btn-primary" onclick="anichange(this); return false"><i class="icon-plus icon-white"></i>Поставить на склад</button>
                        <div class="hide">
                        <fieldset id="parts_add_2_store_<?=$row['store_id']?>">
                            <div class="control-group">
                                <label for="name" class="control-label">Описание/Название</label>
                                <div class="controls">
                                    <textarea id="name_parts_<?=$row['store_id']?>" rows="2" name="Название"><?=$row['name']?></textarea>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="inputError" class="control-label">Серийный номер</label>
                                <div class="controls">
                                    <input type="text" id="serial_parts_<?=$row['store_id']?>" name="Серийный номер" value="">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="vid" class="control-label">Внешний вид</label>
                                <div class="controls">
                                    <input type="text" id="vid_parts_<?=$row['store_id']?>" name="Внешний вид" value="Новый">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="id_sost" class="control-label">Состояние</label>
                                <div class="controls">
                                    <?php
                                    $options_sost = array('' => "Выбрать", '1' => "Новый",'0' => "БУ");
                                    echo form_dropdown('Состояние', $options_sost, '', 'id="id_sost_parts_'.$row['store_id'].'"');
                                    ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="cost" class="control-label">Себестоимость(цена покупки)</label>
                                <div class="controls">
                                    <input type="number" step="1" min="0" name="Себестоимость" value="" id="cost_parts_<?=$row['store_id']?>">
                                </div>
                            </div>



                            <div class="form-actions">
                                <button id="add_2_store_from_parts_<?=$row['store_id']?>" name="<?=$row['store_id']?>" class="btn btn-success" type="submit">Добавить на скдад</button>

                            </div>
                        </fieldset>
                        </div>

                        <a href="<?=site_url("parts")?>/delete/<?=$row['store_id']?>" class="btn btn-danger">Удалить</a>

                        <?}
                            else echo '<a href="'.site_url("parts").'/delete/'.$row['store_id'].'" class="btn btn-danger btn-mini">Удалить</a>';?>
                    </td>




                    </tr>
                <?}?>
                </tbody>
            </table>
            <?}?>

      </div>
    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
