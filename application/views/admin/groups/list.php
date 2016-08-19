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

                    <h2>Администраторы</h2>
                    <p> Имеют <span class="alert-success">полный доступ</span> во всех сервисных центрах.</p>

                    <h2><b>Менеджеры</b></h2>
                            <ul><p><b>Доступ:</b></p>
                                <ul>
                                    <li><p><b>Заявки:</b> видят все заявки в своем сервисном центре и <b>свои</b> заявки в другом сервисном центре.</p></li>
                                    <li><p><b>Аппараты:</b> <span class="alert-success">полный доступ</span>.</p></li>
                                    <li><p><b>Производители:</b> <span class="alert-success">полный доступ</span>.</p></li>
                                    <li><p><b>Склад:</b> полный доступ в своем сервисном центре.</p></li>
                                    <li><p><b>Запчасти:</b> полный доступ в своем сервисном центре.</p></li>
                                    <li><p><b>Касса:</b> полный доступ в своем сервисном центре.</p></li>
                                </ul>
                            </ul>


                    <h2><b>Мастера</b></h2>
                    <ul><p><b>Доступ:</b></p>
                        <ul>
                            <li><p><b>Заявки:</b> видят заявки назначенные менеджером своего сервисного центра.</p></li>
                            <li><p><b>Склад:</b> полный доступ в своем сервисном центре.</p></li>
                            <li><p><b>Запчасти:</b> полный доступ в своем сервисном центре.</p></li>
                        </ul>
                    </ul>

                </div>
                </div>
            </div>