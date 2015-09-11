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
          Группы доступа
         <!-- <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success pull-right">Добавить</a>-->
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline', 'id' => 'myform');
           
            //save the columns names in a array that we will use as filter         
            $options_groups_dostupa = array();

        if (count($groups_dostupa) >= 1) {


            foreach ($groups_dostupa as $array) {
              foreach ($array as $key => $value) {
                $options_groups_dostupa[$key] = $key;
              }
              break;
            }

            echo form_open('admin/groups', $attributes);?>

              <label class="control-label" for="search_string">Поиск:</label>
              <?echo form_input('search_string', $search_string_selected, 'class="search-query"');?>

              <label class="control-label" for="order">Фильтровать по:</label>
              <?echo form_dropdown('order', $options_groups_dostupa, $order, 'class="span2"');?>

             <?

              $options_order_type = array('Asc' => 'По возрастанию', 'Desc' => 'По убыванию');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Поиск');
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
              foreach($groups_dostupa as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['name'].'</td>';


                echo '<td class="span3">
                 <!-- <a href="'.site_url("admin").'/groups/update/'.$row['id'].'" class="btn btn-info">Изменить</a> -->
                 <!-- <a href="'.site_url("admin").'/groups/delete/'.$row['id'].'" class="btn btn-danger">Удалить</a> -->
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

        <div class="row">
            <div class="span12 columns">
                <div class="well">
                    <p><b>Администраторы</b> - имеют полный доступ во всех сервисных центрах.</p>
                    <p><b>Менеджеры</b> - имеют ограниченный доступ в своем сервисном центре.</p>
                    <p><b>Механики</b> - имеют ограниченный доступ в своем сервисном центре.</p>

                </div>
                </div>
            </div>