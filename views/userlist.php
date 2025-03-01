<?php
$records = getUserRecords();
$utype = '';
$type = $_SESSION['calendar_fd_user']['type'];
if($type == 'admin' || $type == 'teacher') {
	$utype = 'on';
}
?>

<div class="col-md-12">
  <div class="card">
    <div class="card-header with-border">
      <h3 class="card-title">User details</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-bordered text-nowrap text-small">
        <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>User Role</th>
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
		if($status == "active") {$stat = 'success';}
		else if($status == "lock") {$stat = 'warning';}
		else if($status == "inactive") {$stat = 'warning';}
		else if($status == "delete") {$stat = 'danger';}
		?>
        <tr>
          <td><?php echo $idx++; ?></td>
          <td><a href="<?php echo WEB_ROOT; ?>views/?v=USER&ID=<?php echo $user_id; ?>"><?php echo strtoupper($user_name); ?></a></td>
          <td><?php echo $user_email; ?></td>
          <td><?php echo $user_phone; ?></td>

          <td>
		  <i class="fa <?php echo $type == 'teacher' ? 'fa-user' : 'fa-users' ; ?> col-2" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo strtoupper($type); ?></i></td>
          <td><span class="badge badge-<?php echo $stat; ?>"><?php echo strtoupper($status); ?></span></td>
          <?php if($utype == 'on') { ?>
		  <td><?php if($status == "active") {?>
            <a href="javascript:status('<?php echo $user_id ?>', 'inactive');" class="btn btn-outline-warning btn-xs">Inactive</a>&nbsp;/
			&nbsp;<a href="javascript:status('<?php echo $user_id ?>', 'lock');" class="btn btn-outline-info btn-xs">Account Lock</a>&nbsp;/
			&nbsp;<a href="javascript:status('<?php echo $user_id ?>', 'delete');" class="btn btn-outline-danger btn-xs">Delete</a>
            <?php } else { ?>
			<a href="javascript:status('<?php echo $user_id ?>', 'active');" class="btn btn-outline-success btn-xs">Active</a>
			<?php }//else ?>
          </td>
		  <?php }?>
        </tr>
        <?php } ?>
            </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">

	<?php
	$type = $_SESSION['calendar_fd_user']['type'];
	if($type == 'admin') {
	?>
  <div class="col-sm-3">
	  <button type="button" class="btn btn-block bg-gradient-info" onclick="javascript:createUserForm();"><i class="fa fa-user-plus col-2" aria-hidden="true"></i>Create a new User</button>
  </div>
	<?php
	}
	?>
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
function createUserForm() {
	window.location.href = '<?php echo WEB_ROOT; ?>views/?v=CREATE';
}
function status(userId, status) {
	if(confirm('Are you sure you wants to ' + status+ ' it ?')) {
		window.location.href = '<?php echo WEB_ROOT; ?>views/process.php?cmd=change&action='+ status +'&userId='+userId;
	}
}


</script>
