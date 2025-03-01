<?php
$records = getBookingRecords();
$utype = '';
$type = $_SESSION['calendar_fd_user']['type'];
if($type == 'admin') {
	$utype = 'on';
}
?>

<div class="col-md-12">
  <div class="card">
    <div class="card-header with-border">
      <h3 class="card-title">Event Booking Details</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body card-body table-responsive p-0">
      <table class="table table-bordered text-nowrap text-small">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Booking Date</th>
            <th>Number of People</th>
            <th>Status</th>
            <?php if($utype == 'on') { ?>
              <th>Action</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>

        <?php
	  $idx = 1;
	  foreach($records as $rec) {
	  	extract($rec);
		$stat = '';
		if($status == "PENDING") {$stat = 'warning';}
		else if ($status == "APPROVED") {$stat = 'success';}
		else if($status == "DENIED") {$stat = 'danger';}
		?>
        <tr>
          <td><?php echo $idx++; ?></td>
          <td><a href="<?php echo WEB_ROOT; ?>views/?v=USER&ID=<?php echo $user_id; ?>"><?php echo strtoupper($user_name); ?></a></td>
          <td><?php echo $user_email; ?></td>
          <td><?php echo $user_phone; ?></td>
          <td><?php echo $res_date; ?></td>
          <td><?php echo $count; ?></td>
          <td><span class="badge badge-<?php echo $stat; ?>"><?php echo $status; ?></span></td>
          <?php if($utype == 'on') { ?>
		  <td><?php if($status == "PENDING") {?>
            <a href="javascript:approve('<?php echo $user_id ?>');" class="btn btn-outline-success btn-xs">Approve</a>&nbsp;/
			&nbsp;<a href="javascript:decline('<?php echo $user_id ?>');" class="btn btn-outline-warning btn-xs">Denied</a>&nbsp;/
			&nbsp;<a href="javascript:deleteUser('<?php echo $user_id ?>');" class="btn btn-outline-danger btn-xs">Delete</a>
            <?php } else { ?>
			<a href="javascript:deleteUser('<?php echo $user_id ?>');" class="btn btn-outline-danger btn-xs">Delete</a>
			<?php }//else ?>
          </td>
		  <?php } ?>
        </tr>
        <?php } ?>
            </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <!--
	<ul class="pagination pagination-sm no-margin pull-right">
      <li><a href="#">&laquo;</a></li>
      <li><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">&raquo;</a></li>
    </ul>
	-->
      <?php echo generatePagination(); ?> </div>
  </div>
  <!-- /.card -->
</div>

<script language="javascript">
function approve(userId) {
	if(confirm('Are you sure you wants to Approve it ?')) {
		window.location.href = '<?php echo WEB_ROOT; ?>api/process.php?cmd=regConfirm&action=approve&userId='+userId;
	}
}
function decline(userId) {
	if(confirm('Are you sure you wants to Decline the Booking ?')) {
		window.location.href = '<?php echo WEB_ROOT; ?>api/process.php?cmd=regConfirm&action=denide&userId='+userId;
	}
}
function deleteUser(userId) {
	if(confirm('Deleting user will also delete it\'s booking from calendar.\n\nAre you sure you want to priceed ?')) {
		window.location.href = '<?php echo WEB_ROOT; ?>api/process.php?cmd=delete&userId='+userId;
	}
}

</script>
