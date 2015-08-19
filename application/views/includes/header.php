<!DOCTYPE html>
    <html>


    <head>
        <meta charset="utf-8">
        <title>Admin Home Page</title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>assets/styles.css" rel="stylesheet" media="screen">


        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <script src="<?php echo base_url(); ?>assets/jquery-1.7.1.min.js"></script>

        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/func.js"></script>



    </head>

    <body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#">Mikh's Panel</a>
                <div class="nav-collapse collapse">
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?=$this->session->userdata('user_name');?> <i class="caret"></i>

                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a tabindex="-1" href="#">Профиль</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="<?php echo base_url(); ?>admin/logout">Выход</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
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

                                    <li <?php if($this->uri->segment(2) == 'groups'){echo 'class="active"';}?>>
                                        <a href="<?php echo base_url(); ?>admin/groups">Роли</a>
                                    </li>

                                    <li <?php if($this->uri->segment(2) == 'devices'){echo 'class="active"';}?>>
                                        <a href="<?php echo base_url(); ?>admin/devices">Аппараты</a>
                                    </li>

                                    <li <?php if($this->uri->segment(2) == 'brands'){echo 'class="active"';}?>>
                                        <a href="<?php echo base_url(); ?>admin/brands">Производители</a>
                                    </li>

                                    <li <?php if($this->uri->segment(2) == 'status'){echo 'class="active"';}?>>
                                        <a href="<?php echo base_url(); ?>admin/status">Состояния ремонта</a>
                                    </li>

                                    <li <?php if($this->uri->segment(2) == 'types'){echo 'class="active"';}?>>
                                        <a href="<?php echo base_url(); ?>admin/types">Виды ремонта</a>
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

                        </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>