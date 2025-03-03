<div class="col-md-8">

<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>

<div class="card card-info">
  <div class="card-header with-border">
    <h3 class="card-title"><b>User Registration</b></h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form role="form" action="<?php echo WEB_ROOT; ?>views/process.php?cmd=create" method="post">
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1" class="text-small">Name</label>
        <span id="sprytf_name">
		<input type="text" name="name" class="form-control form-control-sm input-sm" placeholder="Username">
		<span class="textfieldRequiredMsg text-small">Name is required.</span>
		<span class="textfieldMinCharsMsg text-small">Name must specify at least 6 characters.</span>
		</span>
      </div>
	  <div class="form-group">
        <label for="exampleInputEmail1" class="text-small">Address</label>
		<span id="sprytf_address">
        <textarea name="address" class="form-control form-control-sm input-sm" placeholder="Address"></textarea>
		<span class="textareaRequiredMsg text-small">Address is required.</span>
		<span class="textareaMinCharsMsg text-small">Address must specify at least 10 characters.</span>
		</span>
      </div>
	  <div class="form-group">
        <label for="exampleInputEmail1" class="text-small">Phone</label>
		<span id="sprytf_phone">
        <input type="text" name="phone" class="form-control form-control-sm input-sm"  placeholder="Phone number">
		<span class="textfieldRequiredMsg text-small">Phone number is required.</span>
		</span>
      </div>
	  <div class="form-group">
        <label for="exampleInputEmail1" class="text-small">Email address</label>
		<span id="sprytf_email">
        <input type="text" name="email" class="form-control form-control-sm input-sm" placeholder="Enter email">
		<span class="textfieldRequiredMsg text-small">Email ID is required.</span>
		<span class="textfieldInvalidFormatMsg text-small">Please enter a valid email (user@domain.com).</span>
		</span>
      </div>


	<div class="form-group">
        <label for="exampleInputEmail1" class="text-small">Uset Type</label>
		<span id="sprytf_type">
        <select name="type"  class="form-control form-control-sm input-sm">
			<option value=""> -- select user type --</option>
			<option value="student">Student</option>
			<option value="teacher">Teacher</option>
		</select>
		<span class="selectRequiredMsg text-small">Please select User Type.</span>
		</span>

      </div>


    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn bg-gradient-info">Submit</button>
    </div>
  </form>
</div>
<!-- /.card -->
<script type="text/javascript">
<!--
var sprytf_name 	= new Spry.Widget.ValidationTextField("sprytf_name", 'none', {minChars:6, validateOn:["blur", "change"]});
var sprytf_address 	= new Spry.Widget.ValidationTextarea("sprytf_address", {minChars:10, isRequired:true, validateOn:["blur", "change"]});
var sprytf_phone 	= new Spry.Widget.ValidationTextField("sprytf_phone", 'none', {validateOn:["blur", "change"]});
var sprytf_mail 	= new Spry.Widget.ValidationTextField("sprytf_email", 'email', {validateOn:["blur", "change"]});
//var sprytf_rdate 	= new Spry.Widget.ValidationTextField("sprytf_rdate", "date", {format:"yyyy-mm-dd", useCharacterMasking: true, validateOn:["blur", "change"]});
//var sprytf_rtime 	= new Spry.Widget.ValidationTextField("sprytf_rtime", "time", {hint:"i.e 20:10", useCharacterMasking: true, validateOn:["blur", "change"]});
//var sprytf_ucount 	= new Spry.Widget.ValidationTextField("sprytf_ucount", "integer", {validateOn:["blur", "change"]});
var sprytf_type 	= new Spry.Widget.ValidationSelect("sprytf_type");
//-->
</script>
</div>