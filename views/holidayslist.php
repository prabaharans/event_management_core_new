<?php
$records = getHolidayRecords();
?>
<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Holiday List</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-bordered text-nowrap text-small">
    <thead>
      <tr>
        <th>#</th>
        <th>Date</th>
        <th>Reason</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
	  $idx = 1;
	  foreach($records as $rec) {
	  	extract($rec);
	  ?>
      <tr>
        <td><?php echo $idx++; ?></td>
        <td><?php echo $hdate; ?></a></td>
        <td><?php echo $hreason; ?></td>
        <td><a href="javascript:deleteHoliday('<?php echo $hid ?>');" class="btn btn-outline-danger btn-xs">Delete</a></td>
      </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  <div class="card-footer clearfix">
    <?php echo generateHolidayPagination(); ?> </div>
</div>
<!-- /.card -->
<script language="javascript">
function deleteHoliday(hid) {
	if(confirm('Deleting holiday will allows user to book that date.\n\nAre you sure you want to proceed ?')) {
		window.location.href = '<?php echo WEB_ROOT; ?>api/process.php?cmd=hdelete&hId='+hid;
	}
}

</script>
