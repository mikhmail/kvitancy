<div class="container top">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("admin"); ?>">
                <?php echo ucfirst($this->uri->segment(1));?>
            </a>
            <span class="divider">/</span>
        </li>
        <li>
            <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
                <?php echo ucfirst($this->uri->segment(2));?>
            </a>
            <span class="divider">/</span>
        </li>
        <li class="active">
            <a href="#">Update</a>
        </li>
    </ul>

    <div class="page-header">
        <h2>
            Профиль пользователя "<?php echo $product[0]['user_name']; ?>"
        </h2>
    </div>


    <?php
    //flash messages
    if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
            echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> product updated with success.';
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

    $options_manufacture = array('' => "Select");
    foreach ($groups_dostupa as $row)
    {
        $options_manufacture[$row['id']] = $row['name'];
    }

    $options_sc = array('' => "Выбрать");
    foreach ($sc as $row)
    {
        $options_sc[$row['id_sc']] = $row['name_sc'];
    }

    //form validation
    echo validation_errors();

    echo form_open('profile', $attributes);
    ?>
    <fieldset>
        <div class="control-group">
            <label for="inputError" class="control-label">Имя</label>
            <div class="controls">
                <input type="text" id="" name="first_name" value="<?php echo $product[0]['first_name']; ?>" >
                <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Фамилия</label>
            <div class="controls">
                <input type="text" id="" name="last_name" value="<?php echo $product[0]['last_name']; ?>">
                <!--<span class="help-inline">email_addres</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Email</label>
            <div class="controls">
                <input type="text" id="" name="email_addres" value="<?php echo $product[0]['email_addres'];?>">
                <!--<span class="help-inline">email_addres</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Логин</label>
            <div class="controls">
                <input type="text" name="user_name" value="<?php echo $product[0]['user_name']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>

        <div class="control-group">
            <label for="inputError" class="control-label">Пароль</label>
            <div class="controls">
                <input type="password" name="pass_word" value="<?php echo $product[0]['pass_word']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>

        <div class="control-group">
            <label for="groups_dostupa_id" class="control-label">Группа доступа</label>
            <div class="controls">
                <?php echo form_dropdown('groups_dostupa_id', $options_manufacture, $product[0]['id_group'], 'class="span2" disabled');?>
            </div>
        </div>

        <div class="control-group">
            <label for="id_sc" class="control-label">Сервисный Центр</label>
            <div class="controls">
                <?php echo form_dropdown('id_sc', $options_sc, $product[0]['id_sc'], 'class="span2" disabled');?>
            </div>
        </div>

        <div class="control-group">
            <label for="active" class="control-label">Активный</label>
            <div class="controls">
                <?php echo form_dropdown('active', array('1' => "Да", '2' => "Нет"), $product[0]['active'], 'class="span2" disabled');?>
            </div>
        </div>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <button class="btn" type="reset">Отмена</button>
        </div>
    </fieldset>

    <?php echo form_close(); ?>

</div>
