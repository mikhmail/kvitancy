<div class="container top">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("settings"); ?>">
                <?php echo ucfirst($this->uri->segment(1));?>
            </a>
            <span class="divider">/</span>
        </li>

        <a href="#">
            <?php echo ucfirst($this->uri->segment(2));?>
        </a>
    </ul>

    <div class="page-header">
        <h2>
            Настройки
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
    //form validation
    echo validation_errors();
    echo form_open('/settings/update_tickets_per_page');?>
    <fieldset>
        <div class="control-group">
            <label for="inputError" class="control-label">Введите количество показываемых квитанций на странице.</label>
            <div class="controls">
                <input class="" type="number" name="count_per_page" value="<?php echo stripslashes($count_per_page); ?>">
                <button class="btn btn-primary" type="submit">Сохранить</button>
            </div>
        </div>

    </fieldset>
    <?php echo form_close(); ?>

</div>
