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
          Заявки Админ

        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            //save the columns names in a array that we will use as filter      

				//var_dump ($manufacturers);die;
				
            $options_manufacturers = array();    
            
			
			foreach ($manufacturers as $array) {
              foreach ($array as $key => $value) {
                $options_manufacturers[$key] = $key;
              }
              break;
            }
			
			
            echo form_open('admin/kvitancy', $attributes);

            ?>

              <label class="control-label" for="search_string">Поиск:</label>
              <?echo form_input('search_string', $search_string_selected, 'class="search-query"');?>

              <label class="control-label" for="order">Сортировать по:</label>
              <?
              echo form_dropdown('order', $options_manufacturers, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Поиск');

            $options_order_type = array('Asc' => 'По возрастанию', 'Desc' => 'По убыванию');
            echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span2"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

		  <div class="container">
		  
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
				<th class="yellow header headerSortDown">Сервис</th>
				
                <th class="yellow header headerSortDown">ФИО</th>
				<th class="yellow header headerSortDown">Аппарат</th>
				
				<th class="yellow header headerSortDown">Неисправность</th>
				<th class="yellow header headerSortDown">Статус</th>
				
				<th class="yellow header headerSortDown">Управление</th>
				
				
				
              </tr>
            </thead>
            <tbody>
              <?php
			  if (count($manufacturers>0)) {
              foreach($manufacturers as $row)
              {
                echo '<tr>';
				echo '<td>'.$row['id_kvitancy'].'</td>';
                
                echo '<td>'.$row['name_sc'].'</td>';
                echo '<td>'.$row['fam'].' '.$row['imya'].' '.$row['phone'].'</td>';
				echo '<td>'.$row['aparat_name'].' '.$row['name_proizvod'].' '.$row['model'].'</td>';
				
				echo '<td>'.$row['neispravnost'].'</td>';
				echo '<td>'.$row['name_sost'].'</td>';
				
				
				
				
                echo '<td class="span3">
                  <a href="'.site_url("tickets").'/update/'.$row['id_kvitancy'].'" class="btn btn-info">Изменить</a>
                  <a href="'.site_url("admin").'/kvitancy/delete/'.$row['id_kvitancy'].'" class="btn btn-danger">Удалить</a>
                </td>';
                echo '</tr>';
              }
            }
			?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>
	</div>