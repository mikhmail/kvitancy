    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("tickets"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
		
		 <li>
          <a href="<?php echo site_url(). $this->uri->segment(1) . '/'. 'view' .'/'. $this->uri->segment(3) ?>">
            <?php echo ucfirst($this->uri->segment(3)); ?>
          </a> 
          <span class="divider">/</span>
        </li>
		
        <li>
          <a href="<?php echo site_url(). $this->uri->segment(1) . '/'.$this->uri->segment(2) .'/'. $this->uri->segment(3) ?>">
            <?php echo ucfirst($this->uri->segment(2)); ?>
          </a> 
          <span class="divider">/</span>
        </li>

      </ul>
      
      <div class="page-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> # <?php echo ucfirst($this->uri->segment(3));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Item  ticket updated with success.';
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

	  //var_dump($aparaty);die;
	  
	  $options_aparaty = array('' => "Выбрать");
	  foreach ($aparaty as $row)
      {
        $options_aparaty[$row['id_aparat']] = $row['aparat_name'];
      }
	  
	  $options_proizvod = array('' => "Выбрать");
	  foreach ($proizvod as $row)
      {
        $options_proizvod[$row['id_proizvod']] = $row['name_proizvod'];
      }
	  
	  $options_remonta = array('' => "Выбрать");
	  foreach ($remont as $row)
      {
        $options_remonta[$row['id_remonta']] = $row['name_remonta'];
      }
	  
	  $options_sc = array('' => "Выбрать");
	  foreach ($sc as $row)
      {
        $options_sc[$row['id_sc']] = $row['name_sc'];
      }

      $options_client = array('' => "Выбрать");
	  foreach ($client as $row)
      {
        $options_client[$row['user_id']] = $row['fam'] .' '. $row['imya'];
      }
	  
      //form validation
      echo validation_errors();

      echo form_open('tickets/update/'.$this->uri->segment(3).'', $attributes);
      ?>
 
		  
		  
		<div class="control-group">
            <label for="id_aparat" class="control-label">Дата приема</label>
           <div class="controls">
            <input type="date" id="" name="date_priemka" value="<?php echo $manufacture[0]['date_priemka']; ?>" disabled> 
            </div>
         </div>
		
		<div class="control-group">
            <label for="id_aparat" class="control-label">ID</label>
           <div class="controls">
            <p><?php echo $manufacture[0]['id_kvitancy']; ?></p>
            </div>
         </div>
		
		
         <div class="control-group">
            <label for="id_aparat" class="control-label">Аппарат</label>
           <div class="controls">
              <?php echo form_dropdown('id_aparat', $options_aparaty, $manufacture[0]['id_aparat'], 'class="span2 chzn-select"');?>
            </div>
         </div>
         
		 <div class="control-group">
            <label for="id_proizvod" class="control-label">Производитель</label>
           <div class="controls">
              <?php echo form_dropdown('id_proizvod', $options_proizvod, $manufacture[0]['id_proizvod'], 'class="span2 chzn-select"');?>
            </div>
         </div>
         
		 <div class="control-group">
            <label for="model" class="control-label">Модель</label>
            <div class="controls">
             <input type="text" id="" name="model" value="<?php echo $manufacture[0]['model']; ?>" >
            </div>
          </div>  
		 
		<div class="control-group">
            <label for="ser_nomer" class="control-label">Серийный №</label>
            <div class="controls">
             <input type="text" id="" name="ser_nomer" value="<?php echo $manufacture[0]['ser_nomer']; ?>" >
            </div>
          </div>
		 
		 <div class="control-group">
            <label for="neispravnost" class="control-label">Неисправность</label>
            <div class="controls">
              <textarea id="" rows="3" name="neispravnost"><?php echo $manufacture[0]['neispravnost']; ?></textarea>
            </div>
          </div>
		 
		<div class="control-group">
            <label for="komplektnost" class="control-label">Комплектность</label>
            <div class="controls">
              <textarea id="" rows="4" name="komplektnost"><?php echo $manufacture[0]['komplektnost']; ?></textarea>
            </div>
          </div>

        <div class="control-group">
            <label for="komplektnost" class="control-label">Внешний вид</label>
            <div class="controls">
              <textarea id="" rows="4" name="vid"><?php echo $manufacture[0]['vid']; ?></textarea>
            </div>
          </div>
		
		<div class="control-group">
            <label for="id_remonta" class="control-label">Вид ремонта</label>
            <div class="controls">
              <?php echo form_dropdown('id_remonta', $options_remonta, $manufacture[0]['id_remonta'], 'class="span2"');?>
            </div>
          </div>
		
		<div class="control-group">
            <label for="id_sc" class="control-label">Сервисный Центр</label>
            <div class="controls">
              <?php echo form_dropdown('id_sc', $options_sc, $manufacture[0]['id_sc'], 'class="span2"');?>
            </div>
          </div>
		
		<div class="control-group">
            <label for="primechaniya" class="control-label">Примечание</label>
            <div class="controls">
              <textarea id="" rows="2" name="primechaniya"><?php echo $manufacture[0]['primechaniya']; ?></textarea>
            </div>
          </div>

        <div class="control-group">
            <label for="id_sc" class="control-label">Клиент</label>
            <div class="controls">
              <?php echo form_dropdown('user_id', $options_client, $manufacture[0]['user_id'], 'class="span2 chzn-select"');?>
            </div>
          </div>

		  
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     