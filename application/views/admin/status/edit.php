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
          Обновление статуса ремонта "<?php echo $manufacture[0]['name_sost']; ?>"
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

      //form validation
      echo validation_errors();

      echo form_open('admin/status/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Название</label>
            <div class="controls">
              <input type="text" id="" name="name" value="<?php echo $manufacture[0]['name_sost']; ?>" >
            </div>
          </div>

            <div class="control-group">
                <label for="inputError" class="control-label">Цвет</label>
                <div class="controls">
                    <input type="text" id="" name="background" value="<?php echo  $manufacture[0]['background']; ?>" >

                </div>
            </div>

            <div class="control-group">
                <label for="inputError" class="control-label">Тип</label>
                <div class="controls">
                    <select name="type">
                        <option value="">Выбрать тип</option>

                        <option value="1" <?php if($manufacture[0]['type'] == 1) echo 'selected'; ?>>Аппарат находится в сервисе</option>
                        <option value="0"  <?php if($manufacture[0]['type'] == 0) echo 'selected'; ?>>Аппарат выдан</option>
                    </select>

                </div>
            </div>

          <?php if($manufacture[0]['type'] == 1){?>
            <div class="control-group">
                <label class="control-label" for="optionsCheckbox2">Позвонить клиенту</label>
                <div class="controls">
                    <label>
                        <input type="checkbox" class="uniform_on" name="call2client" <? if ($manufacture[0]['call2client']) echo 'checked'; ?>>
                       Включение поля позволит видеть заявки с этим статусом вверху страници.
                    </label>
                </div>
            </div>
          <?}?>

          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <button class="btn" type="reset">Отмена</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     