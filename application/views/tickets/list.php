<div class="container-fluid">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("kvitancy"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
       <a href="<?php echo site_url('kvitancy/'. strtolower(ucfirst($this->uri->segment(2)))); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a>
      </ul>

      <div class="page-header users-header">
		
			  <a  href="#" class="btn btn-success" id="new-order-button">+Новая квитанция</a>
		
      </div>
      
<div class="row-fluid">

		  
<?php if (count($soglasovat) >1) {?>
			<p><b>Позвонить клиенту:</b>
			
		   <? foreach ($soglasovat as $arr_gog) {?>
				 
					<!--
					<a href="<?=site_url("tickets")?>/view/<?=$arr_gog['id_kvitancy']?>/">&nbsp;<b>&laquo;</b><?=$arr_gog['aparat_name']?> <?=$arr_gog['name_proizvod']?> <?=$arr_gog['model']?><b>&raquo;</b>&nbsp;&nbsp;&nbsp;</a>
					-->
					<a href="#" id="kvit_pokaz_call_<?=$arr_gog['id_kvitancy']?>" name="<?=$arr_gog['id_kvitancy']?>">&nbsp;<b>&laquo;</b><?=$arr_gog['aparat_name']?> <?=$arr_gog['name_proizvod']?> <?=$arr_gog['model']?><b>&raquo;</b>&nbsp;&nbsp;&nbsp;</a>
					
					<?}
		   }?>
	</p>
		   
		   
<?php if (count($my_kvitancy) >1) {?>
		   <p><b>Мои заявки:</b>
		   
		   <? foreach ($my_kvitancy as $arr_gog) {?>
				 		   
						<!--
						<a href="<?=site_url("tickets")?>/view/<?=$arr_gog['id_kvitancy']?>/">&nbsp;<b>&laquo;</b><?=$arr_gog['aparat_name']?> <?=$arr_gog['name_proizvod']?> <?=$arr_gog['model']?><b>&raquo;</b>&nbsp;&nbsp;&nbsp;</a>
						-->
						<a href="#" id="kvit_pokaz_my_<?=$arr_gog['id_kvitancy']?>" name="<?=$arr_gog['id_kvitancy']?>">&nbsp;<b>&laquo;</b><?=$arr_gog['aparat_name']?> <?=$arr_gog['name_proizvod']?> <?=$arr_gog['model']?><b>&raquo;</b>&nbsp;&nbsp;&nbsp;</a>
						
					<?}
		   }?>
	</p>
		   
		   
            <?php
           //var_dump($diag);die;
		   
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
           
			
    echo form_open('tickets', $attributes);
     
		echo form_label('№квит:', 'id_kvitancy');
				echo form_input('id_kvitancy', $id_kvitancy_selected);
					echo '<br>';
	 
		echo form_label('Поиск:', 'search_string');
				echo form_input('search_string', $search_string_selected);
					echo '<br>';
					
		echo form_label('Дата: ');
				$options_date = array('date_priemka' => 'Приемка', 'date_vydachi' => 'Выдачи', 'date_okonchan' => 'Окон.ремонта');
				 echo form_dropdown('date', $options_date, $date_selected, 'class="btn dropdown-toggle"');
	
				echo form_label('C: ');	
						echo form_date('start_date', $start_date);
						
				echo form_label('По: ');
						echo form_date('end_date', $end_date);

echo '<br>';

		echo form_label('Приемка: ');
				$options_id_sc = array('' => "Выбрать");
            
					foreach ($sc as $array) {
						$options_id_sc[$array['id_sc']] = $array['name_sc'];
					}
						echo form_dropdown('id_sc', $options_id_sc, $id_sc_selected, 'class="span2"');
echo '<br>';

				//var_dump($meh);die;
				echo form_label('Механик: ');
								$options_id_meh = array('' => "Выбрать");
							
									foreach ($meh as $array) {
										$options_id_meh[$array['id']] = $array['user_name'];
									}
								
								  echo form_dropdown('id_mechanic', $options_id_meh, $id_mechanic_selected, 'class="span2"');
					
echo '<br>';

		//var_dump($meh);die;
				echo form_label('Бренд: ');
												$options_proizvoditel = array('' => "Выбрать");
											
													foreach ($proizvoditel as $array) {
														$options_proizvoditel[$array['id_proizvod']] = $array['name_proizvod'];
													}
												
												  echo form_dropdown('id_proizvod', $options_proizvoditel, $id_proizvod_selected, 'class="span2"');
									
echo '<br>';


//var_dump($meh);die;
				echo form_label('Аппарат: ');
												$options_ap = array('' => "Выбрать");
											
													foreach ($ap as $array) {
														$options_ap[$array['id_aparat']] = $array['aparat_name'];
													}
												
												  echo form_dropdown('id_aparat', $options_ap, $id_aparat_selected, 'class="span2"');
									
echo '<br>';


//var_dump($meh);die;
				echo form_label('Состояние: ');
												$options_sost = array('' => "Выбрать");
												$options_sost[128] = 'Все [что в ремонте]';
												
												
													foreach ($sost as $array) {
														$options_sost[$array['id_sost']] = $array['name_sost'];
													}
												
												  echo form_dropdown('id_sost', $options_sost, $id_sost_selected, 'class="span2"');
									
echo '<br>';

			echo form_label('Сортировать как: ');
              $options_order_type = array('Asc' => 'С начала', 'Desc' => 'С конца');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span2"');


			echo form_label('Вид ремонта: ');
              
			  //$options_id_remonta = array('2' => 'Не гарантийный', '1' => 'Гарантийный');
			  
			  $options_id_remonta = array('' => "Выбрать");
											
													foreach ($remont as $array) {
														$options_id_remonta[$array['id_remonta']] = $array['name_remonta'];
													}
			  
              echo form_dropdown('id_remonta', $options_id_remonta, $id_remonta_selected, 'class="span2"');
echo '<br>';
			  
			  $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Поиск');
              echo form_submit($data_submit);

            echo form_close();
            ?>

</div>

<?php

/* Сортировка масива по аппаратам */	
$row_global1 = array ();
	foreach ($aparats as $a=>$row) { //arr63
				$row_global1[$row["aparat_name"]][] = $row;
		}

$row_global2 = array ();
	foreach ($aparats as $a=>$row) { //arr63
				$row_global2[$row["name_sost"]][] = $row;
		}
//var_dump($row_global2);die;		
/* Сортировка масива по аппаратам */						 
?>



<div class="row-fluid">    
	<ul class="nav nav-tabs">
	<!--
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" id="sost_vremonte" name="128">
			  Все что в ремонте <span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a href="#" id="sost_vigano" name="256">Все что выдано</a>
				</li>
			</ul>
		  </li>
	-->
	
	<!--
	 <?foreach ($sost as $array) {?>
		<li class="<?if($array['id_sost'] == $id_sost_selected) echo 'active';?>">
			<a href="#" id="sost_<?=$array['id_sost']?>" name="<?=$array['id_sost']?>"><?=$array['name_sost']?></a>
		</li>
	<?}?>
	-->
	
				<li class="<?if ($id_sost_selected == 128) echo 'active';?>">
					<a href="#" id="sost_128" name="128"><b>Все что в ремонте</b> <span class="label"><?=count($aparats)?></span></a>
				</li>
				
				<?foreach ($row_global2 as $name_sost => $value) {?>

				<li class="<?if($value[0]["id_sost"] == $id_sost_selected) echo 'active';?>">
					<a href="#" id="sost_<?=$value[0]["id_sost"]?>" name="<?=$value[0]["id_sost"]?>"><b><?=$name_sost?></b> <span class="label label-important"><?=count($value)?></span>
					</a>
				</li>
	<?}?>
	</ul>
</div>		  
       


<div class="row-fluid">   
		<div style="float: left; width: 20%;">
			<ul style="text-align: left;">
				<?foreach ($row_global1 as $aparat_name => $value) {
					//if ($_SESSION["id_sc"] !=1) { $id_sc_now = $filter->select_id_sc($_SESSION["id_sc"]); } else {$id_sc_now = '';} //var_dump($value);die;?>
					<li class="<?if($value[0]["id_aparat"] == $id_aparat_selected) echo 'active';?>">
					<a href="#" id="aparat_<?=$value[0]["id_aparat"]?>" name="<?=$value[0]["id_aparat"]?>"><b><?=$aparat_name?></b> <span class="label"><?=count($value)?></span>
					</a>
				<?}?>
			</ul>
		</div>

<? if (count($kvitancys)>0) {?>		
<div style="float: left; width: 80%;">

 <?if(count($count_kvitancys)>0) {?>
           <p>Найдено <?=$count_kvitancys?> квитанций</p>
			<?}?>
		
		<?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
<div class="row hero-unit">
		 
<?  foreach($kvitancys as $row)
              {
			 ?>
	
		
      
			
		<table class="table table-striped table-bordered table-condensed">
		 <tr>
				<td><?=$row['id_kvitancy']?></td>
                <td><?=$row['date_priemka']?></td>
                <td><?=$row['date_vydachi']?></td>
                <td><?=$row['name_sc']?></td>
                <td><?=$row['fam'].' '.$row['imya'].' '.$row['phone']?></td>
				<td><?=$row['aparat_name'].' '.$row['name_proizvod'].' '.$row['model']?></td>
				<td><?=$row['neispravnost']?></td>
				
										
			
			<td>
					 <a href="<?=site_url()?>tickets/update/<?=$row['id_kvitancy']?>" class="btn btn-info" target="_blank">Редактировать</a>
					 <a href="<?=site_url()?>tickets/printing/<?=$row['id_kvitancy']?>" class="btn btn-danger" target="_blank">Печать</a>
					 <a href="<?=site_url()?>tickets/printing_check/<?=$row['id_kvitancy']?>" class="btn btn-danger" target="_blank">Печать чека</a>
            </td>
	</tr>
	
	<tr>
		<td colspan="8">
					<?=form_dropdown($row['id_kvitancy'], $options_sost, $row['id_sost'], 'id=status_' . $row['id_kvitancy'] . ' class="span2"')?>
				
					<?if ($row['id_mechanic']) { 
							$id_mechanic_selected = $row['id_mechanic'];
							}else{
								$id_mechanic_selected='';
					}?>		
				
					<?=form_dropdown($row['id_kvitancy'], $options_id_meh, $id_mechanic_selected, 'id=meh_' . $row['id_kvitancy'] . ' class="span2"')?>
		</td>
	</tr>
	<tr>
		<td colspan="8">
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
			</td>
	</tr>	
</table>

			<?}?>
			
	</div>		
</div>
</div> 			
		<?}?>      

          
		<?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>	  
</div>

	
	<!-- Модальное окно -->
	
	
<div id="modal_form">
<h1>Новая заявка</h1>
	<span id="modal_close">X</span>
	
		<form name="new_kvit_form" action="" method="post">

		
			<div class="controls controls-row">
				<input class="span2" type="text" id="inputApparat" onkeyup="look_apparat(this.value);" placeholder="Поиск аппарата">
					<span>или</span>
				<?php echo form_dropdown('id_aparat', $options_ap, $id_aparat_selected, 'class="span2" id="id_aparat" required="required" title="Аппарат"');?>
					<span>или</span>
				
				<a href="#" class="btn" onclick="anichange(this); return false">Добавить</a>
					<span name="aparat_span" style="display: none;">
						<input class="span2" name="add_aparat_name" id="add_aparat_name" type="text" placeholder="Название аппарата">
						<input class="btn" name="submit" id="add_aparat" type="button" value="Добавить аппарат" >
					</span>
					 
					 <div align="left" class="suggestionsBox" id="apparat_box" style="display: none;">
                                <div class="suggestionList" id="apparat_list">
                                </div>
                        </div>
			</div>
			
		
			<div class="controls controls-row">
				<input class="span2" type="text" id="inputProizvod" onkeyup="look_proizvod(this.value);" placeholder="Поиск бренда">
					<span>или</span>
				<?php echo form_dropdown('id_proizvod', $options_proizvoditel, $id_proizvod_selected, 'class="span2" id="id_proizvod" required="required" title="Бренд"');?>
					<span>или</span>
				
				<a href="#" class="btn" onclick="anichange(this); return false">Добавить</a>
					<span name="proizvod_span" style="display: none;">
						<input class="span2" name="add_proizvod_name" id="add_proizvod_name" type="text" placeholder="Название бренда">
						<input class="btn" name="submit" id="add_proizvod" type="button" value="Добавить бренд">
					</span>
					 
					    <div class="suggestionsBox" id="proizvod_box" style="display: none;">
                                <div class="suggestionList" id="proizvod_list"> 
                                </div>
                        </div>
			</div>	
                       
		
              
          <br>
    
	
        <div class="span12">
		<input autocomplete="off" name="model" type="text" placeholder="Введите модель аппарата" required="required" title="Модель">
		<input autocomplete="off" name="ser_nomer" type="text" placeholder="Введите серийный номер" required="required" title="Серийный номер">
		</div>
		<div class="span3">
              <textarea id="" rows="3" name="neispravnost" placeholder="Введите неисправность, например: 'Не включается'" required="required" title="Неисправность"></textarea>
		</div>
		
		<div class="span3">
              <textarea id="" rows="3" name="komplektnost" placeholder="">
Без упаковки (без заводского комплекта), без блока питания, без сетевых (соединительных) кабелей, без SIM карт и съемных носителей.
			  </textarea>
		  </div>
		  
		  <div class="span3">
			  <textarea id="" rows="3" name="vid" placeholder="appearance">Внешний вид: следы эксплуатации: царапины, потёртости, б/у
			  </textarea>
			</div>  
		<div class="span4">
				<label for="id_remonta">Вид ремонта</label>
			<?php  echo form_dropdown('id_remonta', $options_id_remonta, $id_remonta_selected, 'class="span2" id="id_remonta" title="Тип ремонта"');?>
           </div>
		<div class="span4">
				<label for="id_sc">Сервисный Центр</label>
              <?php  echo form_dropdown('id_sc', $options_id_sc, '', 'class="span2" id="id_sc" required="required" title="Сервисный Центр"');?>
           </div>
		
		<div class="span12">
              <textarea id="" rows="2" name="primechaniya" placeholder="Примечание"></textarea>
		  </div>
	
          <hr>
	<input autocomplete="off" name="search_user" id="search_user" type="search" placeholder="Поиск клиентов по фамилии">
	
		 <div id="user_box" style="display: none;">
               <div id="user_list">
                       </div>
			</div>
	
	<br>
	<input name="user_id" id="user_id" type="hidden">
	<input autocomplete="off" name="fam" id="fam" type="text" placeholder="Фамилия" required="required" title="Фамилия">
	<input autocomplete="off" name="imya" id="imya" type="text" placeholder="Имя" required="required" title="Имя">
	<input autocomplete="off" name="otch" id="otch" type="text" placeholder="Отчество" title="Отчество">
	<br>
	<input autocomplete="off" name="phone" id="phone" type="text" placeholder="Телефон" required="required" title="Телефон">
	<input autocomplete="off" name="mail" id="mail" type="text" placeholder="E-MAIL">
	<input autocomplete="off" name="adres" name="adres" type="text" placeholder="Адрес">
	<br>
	
	
	
	<input type="button" name="new_kvit" value="Добавить" class="btn btn-primary">
</form>
</div>
<div id="overlay"></div>	