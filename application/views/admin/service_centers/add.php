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
         Добавление сервисного центра
        </h2>
      </div>

      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new manufacturer created with success.';
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
	  
      //form validation
      echo validation_errors();

      echo form_open('admin/service_centers/add/', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Название</label>
            <div class="controls">
              <input type="text" id="" name="name_sc" value="" >
            </div>
          </div>
		  
		   <div class="control-group">
            <label for="inputError" class="control-label">Реквизиты</label>
            <div class="controls">
              <textarea id="" rows="5" name="adres_sc"></textarea>
            </div>
          </div>
		  
		   <div class="control-group">
            <label for="inputError" class="control-label">Время работы</label>
            <div class="controls">
              <textarea id="" rows="3" name="rab_sc"></textarea>
            </div>
          </div>
		  
		  <div class="control-group">
           <label for="id_gorod" class="control-label">Город</label>
           <div class="controls">
             <? echo form_dropdown('id_gorod', $options_manufacture, 'class=""'); ?>
            </div>
         </div>

		  
		  <div class="control-group">
            <label for="inputError" class="control-label">Почта</label>
            <div class="controls">
              <input type="text" id="" name="mail_sc" value="" >
            </div>
          </div>
		  
		  <div class="control-group">
            <label for="inputError" class="control-label">Сайт</label>
            <div class="controls">
              <input type="text" id="" name="site" value="" >
            </div>
          </div>
		  
		  
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Добавить</button>
            <button class="btn" type="reset">Отмена</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     