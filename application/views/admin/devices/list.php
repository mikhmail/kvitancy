    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
       <a href="<?php echo site_url('admin/'. strtolower(ucfirst($this->uri->segment(2)))); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a>
      </ul>

      <div class="page-header users-header">
        <h2>
          Аппараты
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success pull-right">Добавить</a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            //save the columns names in a array that we will use as filter         
            $options_manufacturers = array();    
            foreach ($manufacturers as $array) {
              foreach ($array as $key => $value) {
                $options_manufacturers[$key] = $key;
              }
              break;
            }

            echo form_open('admin/devices', $attributes);?>

              <label class="control-label" for="search_string">Поиск:</label>
              <?echo form_input('search_string', $search_string_selected, 'class="search-query"');?>


              <label class="control-label" for="order">Сортировать по:</label>
              <?
              echo form_dropdown('order', $options_manufacturers, $order, 'class="span2"');



              $options_order_type = array('Asc' => 'По возрастанию', 'Desc' => 'По убыванию');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Показать');
              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Название</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($manufacturers as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id_aparat'].'</td>';
                echo '<td>'.$row['aparat_name'].'</td>';
                echo '<td class="span3">
                  <a href="'.site_url("admin").'/devices/update/'.$row['id_aparat'].'" class="btn btn-info">Изменить</a>  
                  <a href="'.site_url("admin").'/devices/delete/'.$row['id_aparat'].'" class="btn btn-danger">Удалить</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>