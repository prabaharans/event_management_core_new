<?php
require_once './library/config.php';
require_once './library/functions.php';

$errorMessage = '&nbsp;';
$successMessage = '&nbsp;';
if(isset($_GET['err'])) {
	$errorMessage = urldecode($_GET['err']);
}
if(isset($_GET['msg'])) {
	$successMessage = urldecode($_GET['msg']);
}

if (isset($_POST['name']) && isset($_POST['pwd'])) {
	$result = registerUser();
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
    <link rel="stylesheet" href="<?php echo WEB_ROOT;?>dist/css/adminlte.css">
	<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>library/custom.css">

	<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

	<link href="<?php echo WEB_ROOT; ?>library/spry/passwordvalidation/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo WEB_ROOT; ?>library/spry/passwordvalidation/SpryValidationPassword.js" type="text/javascript"></script>

	<link href="<?php echo WEB_ROOT; ?>library/spry/passwordvalidation/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo WEB_ROOT; ?>library/spry/passwordvalidation/SpryValidationPassword.js" type="text/javascript"></script>

	<link href="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script>

	<link href="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>


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
        <p class="login-card-msg">Register a new User to System</p>
		<?php if($errorMessage != "&nbsp;" ) {?>
		<div class="alert alert-danger alert-dismissable">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4><?php echo $errorMessage; ?>
		</div>
		<?php }else if($successMessage != "&nbsp;" ) {?>
		<div class="alert alert-success alert-dismissable">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Success!</h4><?php echo $successMessage; ?>
		</div>
		<?php } ?>
        <form action="" method="post">

          <div class="form-group has-feedback">
		  	<label for="exampleInputEmail1 text-small">Name</label>
			<span id="sprytf_name">
			<input type="text" name="name" class="form-control form-control-sm input-sm" placeholder="Username">
			<span class="textfieldRequiredMsg text-small">Name is required.</span>
			<span class="textfieldMinCharsMsg text-small">Name must specify at least 6 characters.</span>
			</span>
          </div>

		  <div class="form-group has-feedback">
		  	<label for="exampleInputEmail1 text-small">Password</label>
			<span id="sprytf_pwd">
			<input type="password" name="pwd" class="form-control form-control-sm input-sm" placeholder="Password">
			<span class="passwordRequiredMsg text-small">A Password is required.</span>
			<span class="passwordMinCharsMsg text-small">Password must have minimum 6 characters.</span>
			<span class="passwordMaxCharsMsg text-small">Password must have maximum 10 characters.</span>
			<span class="passwordInvalidStrengthMsg text-small">The password strength condition not met.</span>
			</span>
          </div>

          <div class="form-group has-feedback">
		  	<label for="exampleInputEmail1 text-small">Address</label>
			<span id="sprytf_address">
			<textarea name="address" class="form-control form-control-sm input-sm" placeholder="Address"></textarea>
			<span class="textareaRequiredMsg text-small">Address is required.</span>
			<span class="textareaMinCharsMsg text-small">Address must specify at least 10 characters.</span>
			</span>
          </div>

		  <div class="form-group has-feedback">
		  	<label for="exampleInputEmail1 text-small">Phone</label>
			<span id="sprytf_phone">
			<input type="text" name="phone" class="form-control form-control-sm input-sm"  placeholder="Phone number">
			<span class="textfieldRequiredMsg text-small">Phone number is required.</span>
			</span>
          </div>

		  <div class="form-group has-feedback">
		  	<label for="exampleInputEmail1 text-small">Email address</label>
			<span id="sprytf_email">
			<input type="text" name="email" class="form-control form-control-sm input-sm" placeholder="Enter email">
			<span class="textfieldRequiredMsg text-small">Email ID is required.</span>
			<span class="textfieldInvalidFormatMsg text-small">Please enter a valid email (user@domain.com).</span>
			</span>
          </div>

		  <div class="form-group has-feedback">
		  	<label for="exampleInputEmail1 text-small">Uset Type</label>
			<span id="sprytf_type">
			<select name="type"  class="form-control form-control-sm input-sm">
				<option value=""> -- select user type --</option>
				<option value="student">Student</option>
				<option value="teacher">Teacher</option>
			</select>
			<span class="selectRequiredMsg text-small">Please select User Type.</span>
			</span>
          </div>

          <div class="row">
            <div class="col-xs-8">
              If you are already registered, <br/><a href="<?php echo WEB_ROOT; ?>login.php">Sign In</a> here.
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn bg-gradient-info btn-block">Register</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-card-body -->
    </div><!-- /.login-card -->

  </body>

<script type="text/javascript">
<!--
var sprytf_name 	= new Spry.Widget.ValidationTextField("sprytf_name", 'none', {minChars:6, validateOn:["blur", "change"]});
var sprytf_pwd 		= new Spry.Widget.ValidationPassword("sprytf_pwd", { minChars:6, maxChars:10, validateOn:["blur", "change"]} );
var sprytf_address 	= new Spry.Widget.ValidationTextarea("sprytf_address", {minChars:10, isRequired:true, validateOn:["blur", "change"]});
var sprytf_phone 	= new Spry.Widget.ValidationTextField("sprytf_phone", 'none', {validateOn:["blur", "change"]});
var sprytf_mail 	= new Spry.Widget.ValidationTextField("sprytf_email", 'email', {validateOn:["blur", "change"]});
var sprytf_type 	= new Spry.Widget.ValidationSelect("sprytf_type");
//-->
</script>

</html>
