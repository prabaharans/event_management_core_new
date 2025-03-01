<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

<!-- Horizontal Form -->
<div class="card card-info">
  <div class="card-header with-border">
    <h3 class="card-title">Holiday Form</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form class="form-horizontal" action="<?php echo WEB_ROOT; ?>api/process.php?cmd=holiday" method="post">
    <div class="card-body">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Holiday Date</label>
        <div class="col-sm-8">
		<span id="sprytf_date">
          <input type="text" class="form-control input-sm" name="date" placeholder="yyyy-mm-dd">
		  <span class="textfieldRequiredMsg">Date is required.</span>
		</span>
        </div>
      </div>
	  
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-4 control-label">Holiday Reason</label>
        <div class="col-sm-8">
		<span id="sprytf_reason">
          <input type="text" class="form-control input-sm" name="reason" placeholder="Holiday reason">
		  <span class="textfieldRequiredMsg">Reason is required.</span>
		  <span class="textfieldMinCharsMsg">Reason must specify at least 8 characters.</span>
		</span>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-info pull-right">Add Holiday</button>
    </div>
    <!-- /.card-footer -->
  </form>
</div>
<!-- /.card -->
<script>
<!--
var sprytf_date = new Spry.Widget.ValidationTextField("sprytf_date", "date", {format:"yyyy-mm-dd", useCharacterMasking: true, validateOn:["blur", "change"]});
var sprytf_reason = new Spry.Widget.ValidationTextField("sprytf_reason", "none", {minChars:8, maxChars: 100, validateOn:["blur", "change"]});
//-->
</script>
