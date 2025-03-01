<?php
$userId = (isset($_GET['ID']) && $_GET['ID'] != '') ? $_GET['ID'] : 0;
$usql	= "SELECT * FROM tbl_users u WHERE u.id = $userId";
$res 	= dbQuery($dbConn, $usql);
while($row = dbFetchAssoc($res)) {
	extract($row);
	$stat = '';

	if($status == "active") {$stat = 'success';}
	else if($status == "lock") {$stat = 'warning';}
	else if($status == "inactive") {$stat = 'warning';}
	else if($status == "delete") {$stat = 'danger';}
?>
<div class="col-md-9">
  <div class="card card-solid">
    <div class="card-header with-border"> <i class="fa fa-text-width"></i>
      <h3 class="card-title">User Details</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <dl class="dl-horizontal">
        <dt>Username</dt>
        <dd><?php echo $name; ?></dd>

		<dt>Address</dt>
        <dd><?php echo $address; ?></dd>

		<dt>Email</dt>
        <dd><?php echo $email; ?></dd>

		<dt>Phone</dt>
        <dd><?php echo $phone; ?></dd>

		<dt>Booking Status</dt>
        <dd><span class="label label-<?php echo $stat; ?>"><?php echo $status; ?></span></dd>

      </dl>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<?php
}
?>
