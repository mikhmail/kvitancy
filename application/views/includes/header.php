<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>CodeIgniter Admin Project</title>
  <meta charset="utf-8">
  <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
	      <a class="brand">Project Name</a>
	      <ul class="nav">
	        
			
			
			
			<li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Настройки <b class="caret"></b></a>
	          <ul class="dropdown-menu">
			
				<li <?php if($this->uri->segment(2) == 'tickets'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>tickets">Заявки</a>
	        </li>
			
			  <li <?php if($this->uri->segment(2) == 'users'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/users">Пользователи</a>
	        </li>
	        
			<li <?php if($this->uri->segment(2) == 'groups_dostupa'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/groups_dostupa">Роли</a>
	        </li>
			
			<li <?php if($this->uri->segment(2) == 'aparaty'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/aparaty">Аппараты</a>
	        </li>
	        
			<li <?php if($this->uri->segment(2) == 'proizvoditel'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/proizvoditel">Производители</a>
	        </li>
			
			<li <?php if($this->uri->segment(2) == 'sost_remonta'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/sost_remonta">Состояния ремонта</a>
	        </li>
			
			<li <?php if($this->uri->segment(2) == 'vid_remonta'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/vid_remonta">Виды ремонта</a>
	        </li>
			
			
			<li <?php if($this->uri->segment(2) == 'service_centers'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/service_centers">Сервисные центры</a>
	        </li>
			
			<li <?php if($this->uri->segment(2) == 'gorod'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/gorod">Города</a>
	        </li>
			
			<li <?php if($this->uri->segment(2) == 'clients'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/clients">Клиенты</a>
	        </li>
			
			<li <?php if($this->uri->segment(2) == 'comments'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/comments">Комментарии</a>
	        </li>
			
			
			<li <?php if($this->uri->segment(2) == 'kvitancy'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/kvitancy">Заявки-Админ</a>
	        </li>
			
			  
	          </ul>
	        </li>
			
			
			
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Система <b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li>
	              <a href="<?php echo base_url(); ?>admin/logout">[<?=$this->session->userdata('user_name');?>] Выход</a>
	            </li>
				<li>
	              <a href="<?php echo base_url(); ?>admin/cache_delete">Очистить кеш</a>
	            </li>
	          </ul>
	        </li>
	      </ul>
	    </div>
	  </div>
	</div>	
