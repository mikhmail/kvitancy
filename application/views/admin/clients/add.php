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
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Добавить клиента
        </h2>
      </div>

      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Item  created with success.';
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

	  $options_manufacture = array('' => "Выбрать");
	  foreach ($gorod as $row)
      {
        $options_manufacture[$row['gorod_id']] = $row['gorod'];
      }

     $options_sc = array('' => "Выбрать");
     foreach ($sc as $row)
     {
         $options_sc[$row['id_sc']] = $row['name_sc'];
     }

      //form validation
      echo validation_errors();

      echo form_open('admin/clients/add/', $attributes);
      ?>
        <fieldset>
            <div class="control-group">
                <label for="inputError" class="control-label">Фамилия</label>
                <div class="controls">
                    <input type="text" id="" name="fam" value="" >
                </div>
            </div>

            <div class="control-group">
                <label for="inputError" class="control-label">Имя</label>
                <div class="controls">
                    <input type="text" id="" name="imya" value="" >
                </div>
            </div>

            <div class="control-group">
                <label for="inputError" class="control-label">Отчество</label>
                <div class="controls">
                    <input type="text" id="" name="otch" value="" >
                </div>
            </div>

            <div class="control-group">
                <label for="inputError" class="control-label">Почта</label>
                <div class="controls">
                    <input type="text" id="" name="mail" value="" >
                </div>
            </div>

            <div class="control-group">
                <label for="inputError" class="control-label">Телефон</label>
                <div class="controls">
                    <input type="text" id="" name="phone" value="" >
                </div>
            </div>

            <div class="control-group">
                <label for="inputError" class="control-label">Адрес</label>
                <div class="controls">
                    <textarea id="" rows="2" name="adres"></textarea>
                </div>
            </div>

            <div class="control-group">
                <label for="id_sc" class="control-label">Сервисный Центр</label>
                <div class="controls">
                    <?php echo form_dropdown('id_sc', $options_sc, '', 'class="span2"');?>
                </div>
            </div>




            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Добавить</button>
                <button class="btn" type="reset">Отмена</button>
            </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     