<? //var_dump($works);die;?>
<div class="container-fluid">

<ul class="breadcrumb">
    <li>
        <a href="<?php echo site_url("works"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
        </a>
        <span class="divider">/</span>
    </li>

    <a href="<?php echo site_url('works/'. strtolower(ucfirst($this->uri->segment(2)))); ?>">
        <?php echo ucfirst($this->uri->segment(2));?>
    </a>
</ul>

<div class="page-header users-header">
    <h2>
        Выполненные работы пользователя "<?=$this->session->userdata('user_name')?>" за текущий месяц.
        <!--<a  href="<?php echo site_url("works").'/'; ?>add" class="btn btn-success pull-right">Добавить</a>-->
    </h2>
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

            echo form_open('works', $attributes);


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
            echo form_dropdown('id_sc', $options_id_sc, $id_where_selected, 'class="chzn-select"');


            /*
            $options_id_responsible = array('' => "Выбрать ответственного");

            foreach ($users as $array) {
                $options_id_responsible[$array['id']] = $array['user_name'];
            }

            echo form_dropdown('id_resp', $options_id_responsible, $id_resp_selected, 'class="chzn-select"');
            */

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
            <br>
            <label class="control-label" for="order">Сортировать по:</label>
            <?

            $options_works = array('id' => 'ID', 'cost' => 'Стоимость');
            echo form_dropdown('order', $options_works, $order_selected, 'class="span2"');

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
    <legend>Найдено <strong><?=$count_works?></strong>, на сумму <strong><?=$summ[0]['SUM']?></strong>

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
                <th class="header">#квитанции</th>
                <th class="yellow header headerSortDown">Название</th>
                <th class="yellow header headerSortDown">Стоимость</th>
                <th class="yellow header headerSortDown">Аппарат</th>
                <th class="yellow header headerSortDown">СЦ</th>
                <th class="yellow header headerSortDown">Дата</th>
                <th class="yellow header headerSortDown">Управление</th>

            </tr>
            </thead>
            <tbody>
            <?php
            foreach($works as $row)
            {?>
                <tr>
                    <td><?=$row['id_kvitancy']?></td>
                    <td><?=$row['name']?></td>
                    <td><?=$row['cost']?></td>
                    <td><?=$row['aparat_name']?> <?=$row['name_proizvod']?> <?=$row['model']?></td>
                    <td><?=$row['name_sc']?></td>
                    <td><?=$row['date_added']?></td>


                    <td>
                    <? echo '
                    <a href="'.site_url("works").'/update/'.$row['works_id'].'" class="btn btn-info btn-mini">Изменить</a>
                    <a href="'.site_url("works").'/delete/'.$row['works_id'].'" class="btn btn-danger btn-mini">Удалить</a>
                    ';?>

                    </td>




                </tr>
            <?}?>
            </tbody>
        </table>
    <?}?>

</div>
<?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
