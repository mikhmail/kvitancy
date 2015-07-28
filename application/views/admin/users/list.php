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
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Добавить пользователя</a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            $options_groups_dostupa = array(0 => "all");
            foreach ($groups_dostupa as $row)
            {
              $options_groups_dostupa[$row['id']] = $row['name'];
            }
            //save the columns names in a array that we will use as filter         
            $options_users = array();    
            foreach ($users as $array) {
              foreach ($array as $key => $value) {
                $options_users[$key] = $key;
              }
              break;
            }

            echo form_open('admin/users', $attributes);
     
              echo form_label('Поиск:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'style="width: 170px;
height: 26px;"');

              echo form_label('Фильт по группе:', 'groups_dostupa_id');
              echo form_dropdown('groups_dostupa_id', $options_groups_dostupa, $groups_dostupa_selected, 'class="span2"');

              echo form_label('Фильтровать по:', 'order');
              echo form_dropdown('order', $options_users, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Поиск');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Фамилия</th>
                <th class="green header">Имя</th>
                <th class="red header">Почта</th>
                <th class="red header">Логин</th>
                <th class="red header">Группа</th>
				<th class="red header">СЦ</th>
				
                <th class="red header">Управление</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($users as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['first_name'].'</td>';
                echo '<td>'.$row['last_name'].'</td>';
                echo '<td>'.$row['email_addres'].'</td>';
                echo '<td>'.$row['user_name'].'</td>';
				
                echo '<td>';
				foreach ($groups_dostupa as $rowg)
            {
              if ($rowg['id'] == $row['id_group']) echo $rowg['name'];
            }
				echo '</td>';
                
				echo '<td>';
				foreach ($sc as $rowsc) //var_dump($sc);die;
            {
              if ($rowsc['id_sc'] == $row['id_sc']) echo $rowsc['name_sc'];
            }
				echo '</td>';
                
				
				echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/users/update/'.$row['id'].'" class="btn btn-info">Изменить</a>  
                  <a href="'.site_url("admin").'/users/delete/'.$row['id'].'" class="btn btn-danger">Удалить</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>