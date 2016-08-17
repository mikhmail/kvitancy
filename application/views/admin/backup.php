<div class="container top">
  <div class="page-header">
    <h2>
      Cоздание резевной копии базы данных системы.
    </h2>
  </div>


  <?php
  //flash messages
  if($this->session->flashdata('flash_message')){
    if($this->session->flashdata('flash_message') == 'updated')
    {
      echo '<div class="alert alert-success">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo '<strong>Резервная копия создана!</strong>';
      echo '</div>';
    }else{
      echo '<div class="alert alert-error">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo '<strong>Oh snap!</strong>';
      echo '</div>';
    }
  }
  ?>

  <?php
  //form data
  $attributes = array('class' => 'form-horizontal', 'id' => '');
  //form validation
  echo validation_errors();
  echo form_open('backup', $attributes);
  ?>
    <div class="row-fluid">

        <fieldset>
        <div class="control-group">
            <label class="control-label" for="backup">Сохранить резевную копию базу данных на: </label>
            <div class="controls">

                   <select name="backup">
                       <option value="1">сервер</option>
                       <option value="2">компьютер</option>

                   </select>


            </div>
        </div>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Сохранить</button>

        </div>
        </fieldset>

    </div>



  <?php echo form_close(); ?>

</div>
