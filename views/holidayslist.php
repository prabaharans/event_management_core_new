<?php 
$records = getHolidayRecords();
?>
<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Holiday List</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table class="table table-bordered">
      <tr>
        <th style="width: 10px">#</th>
        <th>Date</th>
        <th>Reason</th>
        <th>Action</th>
      </tr>
      <?php
	  $idx = 1;
	  foreach($records as $rec) {
	  	extract($rec);
	  ?>
      <tr>
        <td><?php echo $idx++; ?></td>
        <td><?php echo $hdate; ?></a></td>
        <td><?php echo $hreason; ?></td>
        <td><a href="javascript:deleteHoliday('<?php echo $hid ?>');">Delete</a></td>
      </tr>
      <?php } ?>
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
