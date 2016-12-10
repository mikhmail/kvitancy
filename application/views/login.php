<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>User Login</title>
    <meta charset="utf-8">
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
  <body id="login">
    <div class="container login">
      <?php
      $attributes = array('class' => 'form-signin');
      echo form_open(base_url(). 'login/validate_credentials', $attributes);
      echo '<h2 class="form-signin-heading">Please sign in</h2>';
      ?><p>Login: admin, password: admin</p><?
      echo form_input('user_name', '', 'placeholder="Username"');
      echo form_password('password', '', 'placeholder="Password"');?>



            <label>
                <input name="remember" type="checkbox" checked> Запомнить меня
            </label>


     <? if(isset($message_error) && $message_error){
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
          echo '</div>';
      }

      echo form_submit('submit', 'Login', 'class="btn btn-large btn-primary"');
      echo form_close();
      ?>
    </div><!--container-->

  </body>



</html>    
    