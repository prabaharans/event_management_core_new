<?php
require_once './library/config.php';
require_once './library/functions.php';

$errorMessage = '&nbsp;';
if (isset($_POST['name']) && isset($_POST['pwd'])) {
	$result = doLogin();
	if ($result != '') {
		$errorMessage = $result;
	}
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo WEB_ROOT;?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>plugins/fontawesome/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>plugins/ionicons/css/icon.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo WEB_ROOT;?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>library/custom.css">

	<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

	<link href="<?php echo WEB_ROOT; ?>library/spry/passwordvalidation/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo WEB_ROOT; ?>library/spry/passwordvalidation/SpryValidationPassword.js" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-card">
      <div class="login-logo">
        <a href="#">Online Event Management</a>
      </div><!-- /.login-logo -->
      <div class="login-card-body">
        <p class="login-card-msg">Sign in to start your session</p>
		<?php if($errorMessage != "&nbsp;" ) {?>
		<div class="alert alert-danger alert-dismissable">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4><?php echo $errorMessage; ?>
		</div>
		<?php } ?>
        <form action="" method="post">
          <div class="form-group has-feedback">
		  	<span id="sprytf_name">
            <input type="text" name="name" class="form-control form-control-sm" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
			<span class="textfieldRequiredMsg text-small">Username is required.</span>
			<span class="textfieldMinCharsMsg text-small">Username must specify at least 4 characters.</span>
			</span>
          </div>
          <div class="form-group has-feedback">
		  	<span id="sprytf_pwd">
            <input type="password" name="pwd" class="form-control form-control-sm" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
			<span class="passwordRequiredMsg text-small">Password is required.</span>
			<span class="passwordMinCharsMsg text-small">You must specify at least 6 characters.</span>
			<span class="passwordMaxCharsMsg text-small">You must specify at max 10 characters.</span>
			</span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              New User <a href="<?php echo WEB_ROOT; ?>register.php">Register</a> here.
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn bg-gradient-info btn-block">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-card-body -->
    </div><!-- /.login-card -->

  </body>
<script>
<!--
var sprytf_name = new Spry.Widget.ValidationTextField("sprytf_name", "none", {minChars:4, validateOn:["blur", "change"]});
var sprytf_pwd = new Spry.Widget.ValidationPassword("sprytf_pwd", {minChars:4, maxChars: 12, validateOn:["blur", "change"]});
//-->
</script>
</html>
