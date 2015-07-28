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
          Обновление <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> manufacturer updated with success.';
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

      echo form_open('admin/clients/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Фамилия</label>
            <div class="controls">
              <input type="text" id="" name="fam" value="<?php echo $manufacture[0]['fam']; ?>" >
            </div>
          </div>
		  
		  <div class="control-group">
            <label for="inputError" class="control-label">Имя</label>
            <div class="controls">
              <input type="text" id="" name="imya" value="<?php echo $manufacture[0]['imya']; ?>" >
            </div>
          </div>
		  
		  <div class="control-group">
            <label for="inputError" class="control-label">Отчество</label>
            <div class="controls">
              <input type="text" id="" name="otch" value="<?php echo $manufacture[0]['otch']; ?>" >
            </div>
          </div>
		  
		  <div class="control-group">
            <label for="inputError" class="control-label">Почта</label>
            <div class="controls">
              <input type="text" id="" name="mail" value="<?php echo $manufacture[0]['mail']; ?>" >
            </div>
          </div>
		  
		  <div class="control-group">
            <label for="inputError" class="control-label">Телефон</label>
            <div class="controls">
              <input type="text" id="" name="phone" value="<?php echo $manufacture[0]['phone']; ?>" >
            </div>
          </div>

		   <div class="control-group">
            <label for="inputError" class="control-label">Адрес</label>
            <div class="controls">
              <textarea id="" rows="2" name="adres"><?php echo $manufacture[0]['adres']; ?></textarea>
            </div>
          </div>
		  
		  
		  
		  <?php
		  /*
          echo '<div class="control-group">';
            echo '<label for="id_group" class="control-label">Город</label>';
            echo '<div class="controls">';
              
              
              echo form_dropdown('id_group', $options_manufacture, $manufacture[0]['id_group'], 'class="span2"');

            echo '</div>';
          echo '</div">';
		  */
          ?>
		  
		  <div class="control-group">
            <label for="inputError" class="control-label">Группа</label>
            <div class="controls">
              <input type="text" id="" name="id_group" value="<?php echo $manufacture[0]['id_group']; ?>" >
            </div>
          </div>

		  
		  
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <button class="btn" type="reset">Отмена</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     