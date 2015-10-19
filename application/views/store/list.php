<?//=print_r($store);die;?>
<div class="container-fluid">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("store"); ?>">
                <?php echo ucfirst($this->uri->segment(1));?>
            </a>
            <span class="divider">/</span>
        </li>

        <a href="<?php echo site_url('admin/'. strtolower(ucfirst($this->uri->segment(2)))); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
        </a>
    </ul>

    <div class="page-header users-header">
        <h2>
            Склад
            <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success pull-right">Добавить</a>
        </h2>
    </div>

    <div class="row-fluid">
        <div class="span12 columns">
            <div class="well">

                <?php

                $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');

                //save the columns names in a array that we will use as filter
                $options_store = array();

                if (count($store) >= 1) {

                foreach ($store as $array) {
                    foreach ($array as $key => $value) {
                        $options_store[$key] = $key;
                    }
                    break;
                }

                echo form_open('store', $attributes);

                ?>

                <label class="control-label" for="search_string">Поиск:</label>
                <?echo form_input('search_string', $search_string_selected, 'class="search-query"');?>

                <label class="control-label" for="order">Сортировать по:</label>
                <?
                echo form_dropdown('order', $options_store, $order, 'class="span2"');

                $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Поиск');

                $options_order_type = array('Asc' => 'По возрастанию', 'Desc' => 'По убыванию');
                echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span2"');

                echo form_submit($data_submit);

                echo form_close();
                ?>

            </div>

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
                        <?=$row['name_sc']?> / 
                        <? if ($row['status'] == 0) {?>
                            Списан на #<?=$row['id_kvitancy']?>
                        <?}?>

                    </td>
                    <td>
                        <?
                        foreach ($users as $rows)
                        {
                            if ($rows['id'] == $row['id_resp']) echo $rows['user_name'];
                        }
                        ?>
                    </td>
                    <td><?=$row['date_priemka']?> / <?=$row['user_name']?></td>
                    <td><?=$row['update_time']?> / <?
                        foreach ($users as $rows)
                        {
                            if ($rows['id'] == $row['update_user']) echo $rows['user_name'];
                        }?>
                    </td>





                    <td>Кнопки</td>




                    </tr>
                <?}?>
                </tbody>
            </table>
            <?}?>
            <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

        </div>
    </div>