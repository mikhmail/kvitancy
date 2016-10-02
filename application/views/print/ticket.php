<div class="container top">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("printing"); ?>">
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
            Шаблон квитанции
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

    echo form_open('/printing/ticket_update');
    ?>
    <fieldset>
        <div class="control-group">
            <label for="inputError" class="control-label alert alert-danger">Значения в скобках [...] менять нельзя!</label>
            <div class="controls">
                <textarea id="text" name="text"><?php echo stripslashes($text->value); ?></textarea>

            </div>
        </div>
        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <button class="btn" type="reset">Отмена</button>
        </div>
    </fieldset>

    <?php echo form_close(); ?>

</div>

<script src="<?echo base_url()?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('text');
</script>
