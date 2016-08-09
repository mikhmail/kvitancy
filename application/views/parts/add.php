<?php //var_dump($store);die; ?>

<div class="container top">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("parts"); ?>">
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

    $id_resp_selected = $this->session->userdata['user_id'];

    //form validation
    echo validation_errors();

    echo form_open('parts/add', $attributes);
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
            <label for="id_aparat_p" class="control-label">Запчасть</label>
            <div class="controls">
                <?php echo form_dropdown('id_aparat_p', $options_aparat_p, set_value('id_aparat_p'), 'id="store_add_id_aparat_p" class="select-container"');?>
                <a href="#" class="btn btn-mini" onclick="anichange(this); return false"><i class="icon-plus"></i></a>
					<span name="aparat_p_span" style="display: none;">
						<input class="" name="aparat_p_name" id="aparat_p_name" type="text" placeholder="Введите название">
						<input class="btn btn-mini btn-success margin-bottom-10px" name="submit" id="add_aparat_p" type="button" value="Добавить">
					</span>

            </div>
        </div>

        <div class="control-group">
            <label for="name" class="control-label">Описание/Название</label>
            <div class="controls">
                <textarea id="" rows="2" name="name" value="<?php echo set_value("name"); ?>"></textarea>
            </div>
        </div>


        <div class="control-group">
            <label for="id_resp" class="control-label">Ответственный</label>
            <div class="controls">
                <?php echo form_dropdown('id_resp', $options_id_resp, $id_resp_selected, 'class=""');?>
            </div>
        </div>



        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <button class="btn" type="reset">Отмена</button>
        </div>
    </fieldset>

    <?php echo form_close(); ?>

</div>
