    <div class="container-fluid">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("kvitancy"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="#" class="btn btn-success" id="new-order-button">Add new ticket</a>
        </h2>
      </div>
      
      <div class="row-fluid">
       
           <p>Найдено <?=$count_kvitancys?> квитанций</p>
		   
			<?php if (count($soglasovat) >1) {?>
			<p><b>Позвонить клиенту:</b>
			
		   <? foreach ($soglasovat as $arr_gog) {?>
				 
						<a href="<?=site_url("tickets")?>/view/<?=$arr_gog['id_kvitancy']?>/">&nbsp;<b>&laquo;</b><?=$arr_gog['aparat_name']?> <?=$arr_gog['name_proizvod']?> <?=$arr_gog['model']?><b>&raquo;</b>&nbsp;&nbsp;&nbsp;</a>
					<?}
		   }?>
		   </p>
		   
		   

		   <?php if (count($my_kvitancy) >1) {?>
		   <p><b>Мои заявки:</b>
		   
		   <? foreach ($my_kvitancy as $arr_gog) {?>
				 		   
						<a href="<?=site_url("tickets")?>/view/<?=$arr_gog['id_kvitancy']?>/">&nbsp;<b>&laquo;</b><?=$arr_gog['aparat_name']?> <?=$arr_gog['name_proizvod']?> <?=$arr_gog['model']?><b>&raquo;</b>&nbsp;&nbsp;&nbsp;</a>
					<?}
		   }?>
		   </p>
		   
		   
            <?php
           //var_dump($diag);die;
		   
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
           
			
            echo form_open('kvitancy', $attributes);
     
	  echo form_label('№квит:', 'id_kvitancy');
				echo form_input('id_kvitancy', $id_kvitancy_selected);
echo '<br>';
	 
              echo form_label('Поиск:', 'search_string');
				echo form_input('search_string', $search_string_selected);
echo '<br>';
				echo form_label('Дата: ');
				$options_date = array('' => '-select-', 'date_priemka' => 'reception', 'date_vydachi' => 'issue of repair', 'date_okonchan' => 'the end of repairs');
				
				  echo form_dropdown('date', $options_date, $date_selected, 'class="span2"');
	
				
			echo form_label('C: ');
					
				echo form_date('start_date', $start_date);
				
              echo form_label('По: ');
				echo form_date('end_date', $end_date);

echo '<br>';

				echo form_label('Приемка: ');
				$options_id_sc = array('' => "-select-");
            
					foreach ($sc as $array) {
						$options_id_sc[$array['id_sc']] = $array['name_sc'];
					}
				
				  echo form_dropdown('id_sc', $options_id_sc, $id_sc_selected, 'class="span2"');
	
echo '<br>';

				//var_dump($meh);die;
				echo form_label('Механик: ');
								$options_id_meh = array('' => "-select-");
							
									foreach ($meh as $array) {
										$options_id_meh[$array['id']] = $array['user_name'];
									}
								
								  echo form_dropdown('id_mechanic', $options_id_meh, $id_mechanic_selected, 'class="span2"');
					
echo '<br>';

		//var_dump($meh);die;
				echo form_label('Бренд: ');
												$options_proizvoditel = array('' => "-select-");
											
													foreach ($proizvoditel as $array) {
														$options_proizvoditel[$array['id_proizvod']] = $array['name_proizvod'];
													}
												
												  echo form_dropdown('id_proizvod', $options_proizvoditel, $id_proizvod_selected, 'class="span2"');
									
echo '<br>';


//var_dump($meh);die;
				echo form_label('Аппарат: ');
												$options_ap = array('' => "-select-");
											
													foreach ($ap as $array) {
														$options_ap[$array['id_aparat']] = $array['aparat_name'];
													}
												
												  echo form_dropdown('id_aparat', $options_ap, $id_aparat_selected, 'class="span2"');
									
echo '<br>';


//var_dump($meh);die;
				echo form_label('Состояние: ');
												$options_sost = array('' => "-select-");
											
													foreach ($sost as $array) {
														$options_sost[$array['id_sost']] = $array['name_sost'];
													}
												$sost_selected = 'date_vydachi';
												  echo form_dropdown('id_sost', $options_sost, $id_sost_selected, 'class="span2"');
									
echo '<br>';

			echo form_label('Сортировать как: ');
              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span2"');


			echo form_label('Вид ремонта: ');
              
			  //$options_id_remonta = array('2' => 'Не гарантийный', '1' => 'Гарантийный');
			  
			  $options_id_remonta = array('' => "-select-");
											
													foreach ($remont as $array) {
														$options_id_remonta[$array['id_remonta']] = $array['name_remonta'];
													}
			  
              echo form_dropdown('id_remonta', $options_id_remonta, $id_remonta_selected, 'class="span2"');
echo '<br>';
			  
			  $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Search');
              echo form_submit($data_submit);

            echo form_close();
            ?>

     

              <?php
			// var_dump($kvitancys);die;
if ($kvitancys) {



/* Что за аппараты есть */		
$id_aparat_arr = array();
foreach ($kvitancys as $a=>$row) {
	foreach ($row as $key=>$value) {
		if ($key == 'id_aparat') {
			$id_aparat_arr[] = $value; 
			}
	}
}
$id_aparat_arr = array_unique($id_aparat_arr); // массив из уникальных id_apatat
/* Что за аппараты есть */		



/* Сортировка масива по аппаратам */	
$row_global = array ();
foreach ($id_aparat_arr as $id_aparat_value) {
	foreach ($kvitancys as $a=>$row) { //arr63

		if ($row["id_aparat"] = $id_aparat_value) {
			$row_global[$row["aparat_name"]][] = $row;
		}
	}break;
}
/* Сортировка масива по аппаратам */

} //if ($query)

if (count($row_global) >= 1) {

//var_dump($row_global);die;
$cats_all = array_chunk($row_global, ceil(count($row_global)/2), TRUE);

	foreach ($cats_all as $row_global) {?>
<div class="span6" name="blocks">	
		<? foreach ($row_global as $aparat_name => $value) {?>
		  
<div class="span6" name="aparat" style="margin: 5px;">
<span style="display:inline-block; width:11px; height:11px; background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAALCAIAAAD0nuopAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAE1JREFUeNpinDlzJgNlgAWI09LScEnPmjWLoAImrHpIAkwMFAMqGMGC6X44GzkIsHoQooAFTTVQKdbAwxOigyMsmIh3MC7ASHnqBAgwAD4CGeOiDhXRAAAAAElFTkSuQmCC');
/*background-position:-11px 0;*/"></span>	
	<a href="#" onclick="anichange(this); return false"><b><?=$aparat_name?></b><font color="red"><sup><?=count($value)?></sup></font></a>
			
		<div style="display:none;">
              <? foreach($value as $row) {?>
				<div style="background-color: #fafafa; margin: 20px; padding: 10px; border: 1px dashed #61B0FF;">
		
				<div><?=$row['id_kvitancy']?></div>
                <div><?=$row['date_priemka']?></div>
                <div><?=$row['date_vydachi']?></div>
                <div><?=$row['name_sc']?></div>
                <div><?=$row['fam'].' '.$row['imya'].' '.$row['phone']?></div>
				<div><?=$row['aparat_name'].' '.$row['name_proizvod'].' '.$row['model']?></div>
				<div><?=$row['neispravnost']?></div>
				<div><?=form_dropdown($row['id_kvitancy'], $options_sost, $row['id_sost'], 'id=status_' . $row['id_kvitancy'] . ' class="span2"')?></div>
				

			<?
			if ($row['id_mechanic']) { 
					$id_mechanic_selected = $row['id_mechanic'];
					}else{
						$id_mechanic_selected='';
					}
			?>		
				<div><?=form_dropdown($row['id_kvitancy'], $options_id_meh, $id_mechanic_selected, 'id=meh_' . $row['id_kvitancy'] . ' class="span2"')?></div>						

                
   
				
			<div>
			<? $comments = $this->kvitancy_model->get_comments($row['id_kvitancy']); ?>
			
					<ul id="ul_<?=$row['id_kvitancy']?>">
								<?foreach($comments as $rowc)
						{?>
							 
							  <li id="li_<?=$rowc['id_comment']?>" ><?=$rowc['date'] . ' ' . $rowc['first_name'] . ' ' . $rowc['last_name'] . ' aka ' . $rowc['user_name'] . ' пишет: ' . '<br><font color="#0066CC"><b>' . $rowc['comment']?></b></font>

							 <? if ($rowc['id_user'] == $this->session->userdata['user_id'])
								{?>
									<input type="button" value="Удалить" id="dell_comment_<?=$rowc['id_comment']?>" name="<?=$rowc['id_comment']?>">
								<?}?>
								</li>
						<?}?>
					</ul>
				
				
				<textarea rows="3" name="comment_<?=$row['id_kvitancy']?>"></textarea>
				
				<input type="button" name="comment" id="comment_<?=$row['id_kvitancy']?>" value="Добавить комментарий"/>
			</div>
			
			<div>
					 <a href="<?=site_url()?>kvitancy/update/<?=$row['id_kvitancy']?>" class="btn btn-info">Изменить</a> 
					 <a href="<?=site_url()?>kvitancy/printing/<?=$row['id_kvitancy']?>" class="btn btn-danger" target="_blank">Печать</a>
					 <a href="<?=site_url()?>kvitancy/printing_check/<?=$row['id_kvitancy']?>" class="btn btn-danger" target="_blank">Печать чека</a> 
            </div>
			
		</div>
              <?}?> </div>
	</div><?}?></div>
<?}?>
<?}?>
      

          <?php //echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
		  


</div>
</div>




	<!-- Модальное окно -->
	
	
<div id="modal_form">
	<span id="modal_close">X</span>
		<form action="" method="post">

		<span class="help-block">SELECT DEVICE</span>
			<div class="controls controls-row">
				<input class="span2" type="text" id="inputApparat" onkeyup="look_apparat(this.value);" placeholder="device name">
					<span>or</span>
				<?php echo form_dropdown('id_aparat', $options_ap, $id_aparat_selected, 'class="span2" id="id_aparat"');?>
					<span>or</span>
				
				<a href="#" class="btn" onclick="anichange(this); return false">Add</a>
					<span name="aparat_span" style="display: none;">
						<input class="span2" name="add_aparat_name" id="add_aparat_name" type="text" placeholder="device name">
						<input class="btn" name="submit" id="add_aparat" type="button" value="Add device" >
					</span>
					 
					 <div align="left" class="suggestionsBox" id="apparat_box" style="display: none;">
                                <div class="suggestionList" id="apparat_list">
                                </div>
                        </div>
			</div>
			
		<span class="help-block">SELECT BRAND</span>
			<div class="controls controls-row">
				<input class="span2" type="text" id="inputProizvod" onkeyup="look_proizvod(this.value);" placeholder="brand name">
					<span>or</span>
				<?php echo form_dropdown('id_proizvod', $options_proizvoditel, $id_proizvod_selected, 'class="span2" id="id_proizvod"');?>
					<span>or</span>
				
				<a href="#" class="btn" onclick="anichange(this); return false">Add</a>
					<span name="proizvod_span" style="display: none;">
						<input class="new_kvitancy" name="add_proizvod_name" id="add_proizvod_name" type="text">
						<input class="new_kvitancy" name="submit" id="add_proizvod" type="button" value="Добавить бренд">
					</span>
					 
					    <div class="suggestionsBox" id="proizvod_box" style="display: none;">
                                <div class="suggestionList" id="proizvod_list"> 
                                </div>
                        </div>
			</div>	
                       
		
              
          <br>
    
	
        
		<input autocomplete="off" name="model" type="text" placeholder="Модель аппарата">
		<input autocomplete="off" name="ser_nomer" type="text" placeholder="Серийный №">
		<br>
              <textarea id="" rows="3" name="neispravnost" placeholder="Неисправность">не включается </textarea>
	
              <textarea id="" rows="3" name="komplektnost" placeholder="Комплектность">Без упаковки (без заводского комплекта), без блока питания, без сетевых (соединительных) кабелей, без SIM карт и съемных носителей.
			  </textarea>
		  
			  <textarea id="" rows="3" name="vid" placeholder="Внешний вид">Внешний вид: следы эксплуатации: царапины, потёртости, б/у</textarea>
		
	
			<?php  echo form_dropdown('id_remonta', $options_id_remonta, $id_remonta_selected, 'class="span2" id="id_remonta"');?>
           
		
		
              <?php  echo form_dropdown('id_sc', $options_id_sc, '', 'class="span2" id="id_sc"');?>
           
		
		
              <textarea id="" rows="2" name="primechaniya" placeholder="Примечание"></textarea>
			  
	<select name="id_where" id="id_where">
		  <option value="">--Выбрать--</option>
          <option value="10">Расклейка объяв</option>
          <option value="9">Был уже у нас</option>
          <option value="8">Затрудняюсь ответить, не помню</option>
          <option value="7">Знакомые рекомендовали</option>
          <option value="6">Доски:типа сландо</option>
          <option value="5">КАРТЫ:google,yandex</option>
          <option value="4">На улице увидел</option>
          <option value="3">По отзывам в интернете</option>
          <option value="2">В каталогах сервисных центоров</option>
          <option value="1">В поисковике нашел</option>
   </select>
			  
          <hr>
	<input autocomplete="off" name="" type="text" placeholder="Поиск клиентов по фамилии">
	<br>	  
	<input autocomplete="off" name="fam" type="text" placeholder="Фамилия">
	<input autocomplete="off" name="imya" type="text" placeholder="Имя">
	<input autocomplete="off" name="otch" type="text" placeholder="Отчество">
	<br>
	<input autocomplete="off" name="phone" type="text" placeholder="Телефон">
	<input autocomplete="off" name="mail" type="text" placeholder="E-MAIL">
	<input autocomplete="off" name="adres" type="text" placeholder="Адрес">
	<br>
	
	
	
<input type="button" name="new_kvit" value="добавить" class="btn btn-primary">
		</form>
</div>
<div id="overlay"></div>