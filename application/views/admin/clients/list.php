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
          Клиенты
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

        if (count($manufacturers) >= 1) {

            foreach ($manufacturers as $array) {
              foreach ($array as $key => $value) {
                $options_manufacturers[$key] = $key;
              }
              break;
            }

            echo form_open('admin/clients', $attributes);

            ?>

              <label class="control-label" for="search_string">Поиск:</label>
              <?echo form_input('search_string', $search_string_selected, 'class="search-query"');?>

              <label class="control-label" for="order">Сортировать по:</label>
              <?
              //echo form_dropdown('order', $options_manufacturers, $order, 'class="span2" disabled');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Поиск');

              $options_order_type = array('Asc' => 'По возрастанию', 'Desc' => 'По убыванию');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span2"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Фамилия</th>
				<th class="yellow header headerSortDown">Имя</th>
				<th class="yellow header headerSortDown">Отчество</th>
				<th class="yellow header headerSortDown">Почта</th>
				<th class="yellow header headerSortDown">Телефон</th>
				<th class="yellow header headerSortDown">Адрес</th>
				<th class="yellow header headerSortDown">Город</th>
				<th class="yellow header headerSortDown">СЦ</th>

				<th class="yellow header headerSortDown">Управление</th>
				
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($manufacturers as $row)
              {
                echo '<tr>';
				echo '<td>'.$row['user_id'].'</td>';
                echo '<td>'.$row['fam'].'</td>';
                echo '<td>'.$row['imya'].'</td>';
				echo '<td>'.$row['otch'].'</td>';
				echo '<td>'.$row['mail'].'</td>';
				echo '<td>'.$row['phone'].'</td>';
				echo '<td>'.$row['adres'].'</td>';
				
				echo '<td>';
				foreach ($gorod as $rowg)
            {
              if ($rowg['gorod_id'] == $row['gorod_id']) echo $rowg['gorod'];
            }
				echo '</td>';
		

				echo '<td>';
				foreach ($service_centers as $rows)
            {
              if ($rows['id_sc'] == $row['id_sc']) echo $rows['name_sc'];
            }
				echo '</td>';
		
		
				

				
                echo '<td class="span3">
                  <a href="'.site_url("admin").'/clients/update/'.$row['user_id'].'" class="btn btn-info">Изменить</a>  
                  <a href="'.site_url("admin").'/clients/delete/'.$row['user_id'].'" class="btn btn-danger">Удалить</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>
<?}?>
          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>