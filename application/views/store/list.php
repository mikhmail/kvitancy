<?//=print_r($store);die;?>
<div class="container-fluid">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("store"); ?>">
                <?php echo ucfirst($this->uri->segment(1));?>
            </a>
            <span class="divider">/</span>
        </li>

        <a href="<?php echo site_url('store/'. strtolower(ucfirst($this->uri->segment(2)))); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
        </a>
    </ul>

    <div class="page-header users-header">
        <h2>
            Склад
            <a  href="<?php echo site_url("store").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success pull-right">Добавить</a>
        </h2>
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

                echo form_open('store', $attributes);



                $options_id_sc = array('' => "Выбрать склад");

                foreach ($sc as $array) {
                    $options_id_sc[$array['id_sc']] = $array['name_sc'];
                }
                echo form_dropdown('id_where', $options_id_sc, $id_where_selected, 'class=""');

                ?>

                <?
                $options_id_responsible = array('' => "Выбрать ответственного");

                foreach ($users as $array) {
                    $options_id_responsible[$array['id']] = $array['user_name'];
                }

                echo form_dropdown('id_resp', $options_id_responsible, $id_resp_selected, 'class=""');?>

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

                <label class="control-label" for="order">Сортировать по:</label>
                <?
               // echo form_dropdown('order', $options_store, $order, 'class="span2"');

                //$data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Поиск');

                $options_order_type = array('Asc' => 'По возрастанию', 'Desc' => 'По убыванию');
                echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span2"');

                //echo form_submit($data_submit);
                ?>
                <input type="submit" name="mysubmit" value="Показать" class="btn btn-info">


            </div>

            </div>
    </div>
    <div class="row-fluid">
        <div class="span12 columns">

            <div class="pull-left">
                <input type="text" name="id_kvitancy" value="" placeholder="Введите номер квитанции" class="search-query">
                <input type="submit" name="mysubmit" value="Показать" class="btn btn-info">
            </div>

            <div class="pull-right">
                <input type="text" name="search_string" value="" placeholder="Поиск по описанию" title="Поиск по описанию" class="search-query">
                </label><input type="submit" name="mysubmit" value="Поиск" class="btn btn-info">    </div>
        </div>
    </div>
<?echo form_close();?>

    <div class="row-fluid">

<?

if (count($store) > 0) {

?>


            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th class="header">#</th>
                    <th class="yellow header headerSortDown">Название</th>
                    <th class="yellow header headerSortDown">Описание</th>
                    <th class="yellow header headerSortDown">Серийный номер</th>
                    <th class="yellow header headerSortDown">Внешний вид</th>
                    <th class="yellow header headerSortDown">Состояние</th>

                    <th class="yellow header headerSortDown">Себестоимость</th>
                    <th class="yellow header headerSortDown">Цена</th>
                    <th class="yellow header headerSortDown">Склад</th>
                    <th class="yellow header headerSortDown">Ответственный</th>
                    <th class="yellow header headerSortDown">Добавлено</th>
                    <th class="yellow header headerSortDown">Обновлено</th>


                    <th class="yellow header headerSortDown">Управление</th>

                </tr>
                </thead>
                <tbody>
                <?php
                foreach($store as $row)
                {?>

                    <td><?=$row['store_id']?></td>
                    <td><?=$row['name_proizvod']?> / <?=$row['aparat_name']?> / <strong><?=$row['title']?></strong></td>
                    <td><?=$row['name']?></td>
                    <td><?=$row['serial']?></td>
                    <td><?=$row['vid']?></td>
                    <td><? if($row['id_sost'] == 1) echo 'Новый'; else echo 'Б.У.';?></td>

                    <td><?=$row['cost']?></td>
                    <td><?=$row['price']?></td>
                    <td>

                        <? if ($row['status'] == 0) {?>
                            Списан на #<?=$row['id_kvitancy']?>
                        <?}else{

                                foreach ($sc as $rows)
                                {
                                    if ($rows['id_sc'] == $row['id_sc']) echo $rows['name_sc'];
                                }

                            }?>

                    </td>
                    <td>
                        <?
                        foreach ($users as $rows)
                        {
                            if ($rows['id'] == $row['id_resp']) echo $rows['user_name'];
                        }
                        ?>
                    </td>
                    <td><?=$row['date_priemka']?> / <?=$row['user_name']?> /  <?=$row['name_sc']?><??></td>
                    <td><?=$row['update_time']?> / <?
                        foreach ($users as $rows)
                        {
                            if ($rows['id'] == $row['update_user']) echo $rows['user_name'];
                        }?>
                    </td>
                    <td>
                        <?echo '
                    <a href="'.site_url("store").'/update/'.$row['store_id'].'" class="btn btn-info btn-mini">Изменить</a>
                    <a href="'.site_url("store").'/delete/'.$row['store_id'].'" class="btn btn-danger btn-mini">Удалить</a>
                            ';?>
                    </td>




                    </tr>
                <?}?>
                </tbody>
            </table>
            <?}?>

      </div>
    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
