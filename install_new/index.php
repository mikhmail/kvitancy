<?php

error_reporting(E_ALL); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.
ini_set("display_errors", 1);

$db_config_path = '../config.php';

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		}
/*
		else if ($core->write_autoload() == false) {
			$message = $core->show_message('error',"The autoload configuration file could not be written, please chmod application/config/autoload.php file to 777");
		}
*/
		// If no errors, redirect to registration page
		if(!isset($message)) {
		  $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://".$_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
      $redir = str_replace('install/','',$redir); 
			header( 'Location: ' . $redir . 'login' ) ;
		}

	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, password, and database name are required.');
	}
}

?>
<html>

<head>
    <meta charset="utf-8">
    <title>Install Fixinka</title>
    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="/assets/styles.css" rel="stylesheet" media="screen">


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="/assets/jquery-1.7.1.min.js"></script>

    <script src="/bootstrap/js/bootstrap.js"></script>
    <script src="/assets/func.js"></script>



</head>

	<body>

    <?php if(is_writable($db_config_path)){?>

		<?php if(isset($message)) {?>

        <div class="alert alert-error">
            <button class="close" data-dismiss="alert">×</button>
            <strong>Error!</strong> <?=$message?>
        </div>
        <?}?>

        <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">Install Fixinka</div>
                </div>
                <div class="block-content collapse in">
                    <div class="span12">
                        <form class="form-horizontal">
                            <fieldset>
                                <legend>Введите значения доступа к базе данных MySQL</legend>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Имя сервера</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="hostname" placeholder="">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Пользователь</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="username">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Пароль</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="password">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">База данных</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="database">
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Установить</button>

                                </div>
                            </fieldset>
                        </form>

                    </div>
                </div>
            </div>
        </form>


    <?php } else { ?>
    <div class="alert alert-error">
      <p class="error">Please make the /config.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 config.php</code></p>
	  </div>
        <?php } ?>



	</body>
</html>
