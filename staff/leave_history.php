<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>

<?php
if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$sql = "DELETE FROM tblleaves where id = ".$delete;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Leave deleted Successfully');</script>";
     	echo "<script type='text/javascript'> document.location = 'leave_history.php'; </script>";
		
	}
}

?>


<body>


	<?php include('includes/navbar.php')?>

	<?php include('includes/right_sidebar.php')?>

	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="title pb-20">
				<h2 class="h3 mb-0">Leave Breakdown</h2>
			</div>
			

			<div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">All Leave</h2>
					</div>
				<div class="pb-20">
											<table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
					
								<th>LEAVE TYPE</th>
								<th>DATE FROM</th>
								<th>DATE TO</th>
								<th>NO. OF DAYS</th>
								<th>APPROVER</th>
								<th>HR STATUS</th>
								<th class="datatable-nosort">ACTION</th>
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php 
								$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.location,tblemployees.emp_id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status,tblleaves.admin_status,tblleaves.ToDate,tblleaves.FromDate,tblleaves.num_days, tblleavetype.LeaveType as 'leavename' from tblleaves inner join tblemployees on tblleaves.empid=tblemployees.emp_id INNER JOIN tblleavetype ON tblleaves.LeaveType = tblleavetype.id where tblemployees.emailid='$session_depart' order by lid desc limit 10";
									$query = mysqli_query($conn, $sql) or die(mysqli_error());
									while ($row = mysqli_fetch_array($query)) {

								 ?>  

						
								<td><?php echo $row['leavename']; ?></td>
	                            <td><?php echo $row['FromDate']; ?></td>
	                             <td><?php echo $row['ToDate']; ?></td>
	                              <td><?php echo $row['num_days']; ?></td>
								<td><?php $stats=$row['Status'];
	                             if($stats==1){
	                              ?>
	                                  <span style="color: green">Approved</span>
	                                  <?php } if($stats==2)  { ?>
	                                 <span style="color: red">Rejected</span>
	                                  <?php } if($stats==0)  { ?>
	                             <span style="color: blue">Pending</span>
	                             <?php } ?>
	                            </td>
	                            <td><?php $stats=$row['admin_status'];
	                             if($stats==1){
	                              ?>
	                                  <span style="color: green">Posted</span>
	                                  <?php } if($stats==2)  { ?>
	                                 <span style="color: red">Rejected</span>
	                                  <?php } if($stats==0)  { ?>
	                             <span style="color: blue">Pending</span>
	                             <?php } ?>
	                            </td>
								<td>
		<div class="dropdown">
<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
											<i class="dw dw-more"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="view_leave.php?edit=<?php echo $row['lid'] ?>"><i class="dw dw-eye"></i> View</a>
<a class="dropdown-item" href="leave_history.php?delete=<?php echo $row['lid'] ?>"><i class="dw dw-delete-3"></i> Delete</a>
										</div>
									</div>
								</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
			   </div>
			</div>

			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<?php include('includes/scripts.php')?>
</body>
</html>