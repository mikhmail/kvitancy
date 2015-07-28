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
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new product created with success.';
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
      $options_groups_dostupa = array('' => "Select");
      foreach ($groups_dostupa as $row)
      {
        $options_groups_dostupa[$row['id']] = $row['name'];
      }
		
		
	$options_sc = array('' => "Выбрать");
	  foreach ($sc as $row)
      {
        $options_sc[$row['id_sc']] = $row['name_sc'];
      }

	  
      //form validation
      echo validation_errors();
      
      echo form_open('admin/users/add', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">first_name</label>
            <div class="controls">
              <input type="text" id="" name="first_name" value="<?php echo set_value('first_name'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">last_name</label>
            <div class="controls">
              <input type="text" id="" name="last_name" value="<?php echo set_value('last_name'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">email_addres</label>
            <div class="controls">
              <input type="text" id="" name="email_addres" value="<?php echo set_value('email_addres'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">user_name</label>
            <div class="controls">
              <input type="text" name="user_name" value="<?php echo set_value('user_name'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
		  <div class="control-group">
            <label for="inputError" class="control-label">password</label>
            <div class="controls">
              <input type="text" name="pass_word" value="<?php echo set_value('pass_word'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
		  
		   <div class="control-group">
            <label for="id_sc" class="control-label">Сервисный Центр</label>
            <div class="controls">
              <?php echo form_dropdown('id_sc', $options_sc, set_value('id_sc'), 'class="span2"');?>
            </div>
          </div>
		  
		  <div class="control-group">
            <label for="groups_dostupa_id" class="control-label">Группа доступа</label>
            <div class="controls">
              <?php echo form_dropdown('groups_dostupa_id', $options_groups_dostupa, set_value('groups_dostupa_id'), 'class="span2"');?>
            </div>
          </div>
		  
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <button class="btn" type="reset">Отмена</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     