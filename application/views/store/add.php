<?php //var_dump($store);die; ?>

<div class="container top">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("store"); ?>">
                <?php echo ucfirst($this->uri->segment(1));?>
            </a>
            <span class="divider">/</span>
        </li>

        <li class="active">
            <a href="#">Add</a>
        </li>
    </ul>

    <div class="page-header">
        <h2>
            Добавление запчасти
        </h2>
    </div>


    <?php
    //flash messages
    if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
            echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Item  updated with success.';
            echo '</div>';
        }else{
            echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
            echo '</div>';
        }
    }
    ?>

    <?php
    //form data
    $attributes = array('class' => 'form-horizontal', 'id' => '');

    $options_id_resp = array('' => "Выбрать");
    foreach ($resp as $row)
    {
        $options_id_resp[$row['id']] = $row['user_name'];
    }

    $options_sc = array('' => "Выбрать");
    foreach ($sc as $row)
    {
        $options_sc[$row['id_sc']] = $row['name_sc'];
    }

    $options_aparat = array('' => "Выбрать");
    foreach ($aparat as $row)
    {
        $options_aparat[$row['id_aparat']] = $row['aparat_name'];
    }

    $options_aparat_p = array('' => "Выбрать");

    /*
    $aparat_p = $this->aparaty_model->get_aparat_p($store[0]['id_aparat']);
    //var_dump($aparat_p);die;

    foreach ($aparat_p as $row)
    {
        $options_aparat_p[$row['id_aparat_p']] = $row['title'];
    }
    // var_dump($options_aparat_p);die;
    */

    $options_proizvod = array('' => "Выбрать");
    foreach ($proizvoditel as $row)
    {
        $options_proizvod[$row['id_proizvod']] = $row['name_proizvod'];
    }

    $options_sost = array('' => "Выбрать", '1' => "Новый",'0' => "БУ");


    //form validation
    echo validation_errors();

    echo form_open('store/add', $attributes);
    ?>
    <fieldset>

        <div class="control-group">
            <label for="id_proizvod" class="control-label">Производитель</label>
            <div class="controls">
                <?php echo form_dropdown('id_proizvod', $options_proizvod, set_value('id_proizvod'), 'class="chzn-select"');?>
            </div>
        </div>

        <div class="control-group">
            <label for="id_aparat" class="control-label">Аппарат</label>
            <div class="controls">
                <?php echo form_dropdown('id_aparat', $options_aparat, set_value('id_aparat'), 'id="store_add_id_aparat" class="chzn-select"');?>
            </div>
        </div>

        <div class="control-group">
            <label for="id_aparat_p" class="control-label">Название</label>
            <div class="controls">
                <?php echo form_dropdown('id_aparat_p', $options_aparat_p, set_value('id_aparat_p'), 'id="store_add_id_aparat_p" class=""');?>
            </div>
        </div>

        <div class="control-group">
            <label for="name" class="control-label">Описание</label>
            <div class="controls">
                <textarea id="" rows="2" name="name" value="<?php echo set_value("name"); ?>"></textarea>
            </div>
        </div>

        <div class="control-group">
            <label for="inputError" class="control-label">Серийный номер</label>
            <div class="controls">
                <input type="text" id="" name="serial" value="<?php echo set_value("serial"); ?>">
            </div>
        </div>

        <div class="control-group">
            <label for="vid" class="control-label">Внешний вид</label>
            <div class="controls">
                <input type="text" id="" name="vid" value="<?php echo set_value("vid"); ?>">
            </div>
        </div>

        <div class="control-group">
            <label for="id_sost" class="control-label">Состояние</label>
            <div class="controls">
                <?php echo form_dropdown('id_sost', $options_sost, set_value("id_sost"), 'class=""');?>
            </div>
        </div>

        <div class="control-group">
            <label for="cost" class="control-label">Себестоимость</label>
            <div class="controls">
                <input type="number" step="1" min="1" name="cost" value="<?php echo set_value("cost"); ?>">
            </div>
        </div>

        <div class="control-group">
            <label for="price" class="control-label">Цена</label>
            <div class="controls">
                <input type="number" step="1" min="1" name="price" value="<?php echo set_value("price"); ?>">
            </div>
        </div>

        <div class="control-group">
            <label for="id_where" class="control-label">Склад</label>
            <div class="controls">
                <?php echo form_dropdown('id_where', $options_sc, set_value("id_where"), 'class=""');?>
            </div>
        </div>

        <div class="control-group">
            <label for="id_resp" class="control-label">Ответственный</label>
            <div class="controls">
                <?php echo form_dropdown('id_resp', $options_id_resp, set_value("id_resp"), 'class=""');?>
            </div>
        </div>

        <div class="control-group error">
            <label for="count" class="control-label">Количество</label>
            <div class="controls">
                <input type="number" step="1" min="1" max="99" size="2" id="" name="count" value="1">
            </div>
        </div>


        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <button class="btn" type="reset">Отмена</button>
        </div>
    </fieldset>

    <?php echo form_close(); ?>

</div>
