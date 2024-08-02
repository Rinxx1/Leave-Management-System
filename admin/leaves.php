<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php
if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$sql = "DELETE FROM tblleaves where id = ".$delete;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Leave deleted Successfully');</script>";
     	echo "<script type='text/javascript'> document.location = 'leaves.php'; </script>";
		
	}
}

?>
<body>
<div id="pew">
	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			
			<div class="user-info-dropdown">
				<div class="dropdown">

					<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
								$row = mysqli_fetch_array($query);
						?>

					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" alt="">
						</span>
						<span class="user-name"><?php echo $row['FirstName']. " " .$row['LastName']; ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="my_profile.php"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="change_password.php"><i class="dw dw-help"></i> Reset Password</a>
						<a class="dropdown-item" href="../logout.php"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
	<?php include('includes/right_sidebar.php')?>

	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

			

	<div class="main-container">
		<div class="pd-ltr-20">
			<div id="pew">
			<div class="page-header">
				<div class="row">

						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Leave Portal</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">All Leave</li>
								</ol>
							</nav>
						</div>
				</div>
			</div>
			</div>

			<div class="special-element">
				<h4><center>RD REALTY DEVELOPMENT CORPORATION</center></h4>
				<h6><center>&nbsp;&nbsp;&nbsp;General Santos Business Park, National Highway, General Santos City 9500 Philippines</center></h6>
				<h6><center>Tel +63.83.552.4435 ;Fax +63.83.301.6236 www.rdrealty.ph</center></h6>
				<br>
			</div>

	

		
							
					
			<div class="card-box mb-30">
				<div class="pd-20">

						<h2 class="text-black h5" >ALL LEAVE APPLICATIONS</h2>
					</div>

				<div class="pb-20">
					
					<table class="table">

						<thead>
								<style type="text/css">
									@arrowColor: #ffcc00;
@arrow: escape('@{arrowColor}');

select {  
  background-color:#142026;
  background-image: url(~"data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20256%20448%22%20enable-background%3D%22new%200%200%20256%20448%22%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E.arrow%7Bfill%3A@{arrow}%3B%7D%3C%2Fstyle%3E%3Cpath%20class%3D%22arrow%22%20d%3D%22M255.9%20168c0-4.2-1.6-7.9-4.8-11.2-3.2-3.2-6.9-4.8-11.2-4.8H16c-4.2%200-7.9%201.6-11.2%204.8S0%20163.8%200%20168c0%204.4%201.6%208.2%204.8%2011.4l112%20112c3.1%203.1%206.8%204.6%2011.2%204.6%204.4%200%208.2-1.5%2011.4-4.6l112-112c3-3.2%204.5-7%204.5-11.4z%22%2F%3E%3C%2Fsvg%3E%0A");
  background-position: right 5px left;
  background-repeat: no-repeat;
  background-size: auto 50%;
  border-radius:5px;
  border:none;
  color: #ffffff;
  padding: 10px 20px 10px 10px;
  // disable default appearance
  outline: none;
  -moz-appearance: none;
  -webkit-appearance: none;
  appearance: none;
  &::-ms-expand { display: none };
}

// remove dotted firefox border
@-moz-document url-prefix() {
  select {
    color: rgba(0,0,0,0);
    text-shadow: 0 0 0 #ffffff;
  }
}

								</style>
							<tr id="pew">

								<form method="POST">

									<?php 

										$getdate2 = "SELECT  MIN(FromDate) as minfrom, MAX(ToDate) as maxto FROM tblleaves ORDER BY FromDate ASC";
					            		$x12 = mysqli_query($conn, $getdate2);
					            		$xrow2 = mysqli_fetch_array($x12);

										$dates1 = "";
										$dates2 = "";

										if(@$_GET['from'] == "" || @$_GET['to'] == ""){
											$dates1 = $xrow2['minfrom'];
											$dates2 = $xrow2['maxto'];
										}else{
											$dates1 = $_GET['from'];
											$dates2 = $_GET['to'];
										}

										

										if(isset($_POST['getdates'])){


											$date1 = $_POST['date1'];
											$date2 = $_POST['date2'];

											echo "<script>location.href='leaves.php?from=$date1&&to=$date2';</script>";

										}

									 ?>
								
					            <td >Date From:</td>
					            <td>
					            	<select name="date1">
					            	<?php 

					            		$getdate = "SELECT DISTINCT * FROM tblleaves ORDER BY FromDate ASC";
					            		$x1 = mysqli_query($conn, $getdate);
					            		while($xrow = mysqli_fetch_array($x1)){

					            	?>

					            	<option>
					            		<?php 

					            			echo $xrow['FromDate'];

					            		 ?>
					            	</option>

					            	<?php }?>
					            	</select>
					            </td>
					        </tr>

					        <tr id="pew">
					            <td>Date To:</td>
					            <td>
					            	<select name="date2">
					            	<?php 

					            		$getdate = "SELECT DISTINCT * FROM tblleaves ORDER BY ToDate ASC";
					            		$x1 = mysqli_query($conn, $getdate);
					            		while($xrow = mysqli_fetch_array($x1)){

					            	?>

					            	<option>
					            		<?php 

					            			echo $xrow['ToDate'];

					            		 ?>
					            	</option>

					            	<?php }?>
					            	</select>
					            </td> 

					            <td>
					            	<button name="getdates" class=" btn-primary"><h6 class="text-white light">Filter</h6></button>

					            	</form>
					            </td>

					        </tr>
				
							<tr>
								<th class="table-plus datatable-nosort">EMPLOYEE NAME</th>
								<th>LEAVE TYPE </th>
								<th>DATE FROM</th>
								<th>DATE TO</th>
								<th>NO.OF DAYS</th>
								<th>APPROVER</th>
								<th>HR STATUS</th>
								<th class="datatable-nosort">ACTION</th>
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php 
								$status=1;
								$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.location,tblemployees.emp_id,tblleaves.LeaveType,tblleaves.FromDate,tblleaves.ToDate,tblleaves.num_days,tblleaves.Status, tblleaves.admin_status, tblleavetype.LeaveType as 'leavename', tblleavetype.id as empleave from tblleaves inner join tblemployees on tblleaves.empid=tblemployees.emp_id INNER JOIN tblleavetype ON tblleaves.LeaveType = tblleavetype.id WHERE (FromDate >= '$dates1' AND ToDate <= '$dates2') order by lid desc limit 10";
									$query = mysqli_query($conn, $sql) or die(mysqli_error());
									while ($row = mysqli_fetch_array($query)) {

								 ?>  


								<td class="table-plus">
									<div class="name-avatar d-flex align-items-center">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" class="border-radius-100 shadow" width="40" height="40" alt="">
										</div>
										<div class="txt">
											<div class="weight-600"><?php echo $row['FirstName']." ".$row['LastName'];?></div>
										</div>
									</div>
								</td>
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
	<a class="dropdown-item" href="leave_details.php?leaveid=<?php echo $row['lid']; ?>&&empid=<?php echo $row['emp_id']?>&&leavetypeid=<?php echo $row['empleave']; ?>"><i class="dw dw-eye"></i> View</a>


<a class="dropdown-item" href="leaves.php?delete=<?php echo $row['lid'] ?>"><i class="dw dw-delete-3"></i> Delete</a>


										</div>
									</div>
								</td>
							</tr>
							<?php }?>
						</tbody>
					</table>


						

<style type="text/css">
	.special-element {
  visibility: hidden;
}

</style>




		&nbsp;&nbsp;
						<button onclick = "window.print()"class="btn btn-primary" id="printPageButton">Print</button>
					<style type="text/css">
						@media print {
  								#printPageButton {
   								 display: none;
 							 }
 							 #pew {
   								 display: none;
 							 }
 							 .special-element {
 							  visibility: visible;
 							   }
						}
					</style>
			   </div>
			</div>

			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<script src="../vendors/scripts/core.js"></script>
	<script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
	<script src="../vendors/scripts/layout-settings.js"></script>
	<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

	<!-- buttons for Export datatable -->
	<script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
	
	<script src="../vendors/scripts/datatable-setting.js"></script></body>
</body>
</html>