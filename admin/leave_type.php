<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>

<?php 
	 if (isset($_GET['delete'])) {
		$leave_type_id = $_GET['delete'];
		$sql = "DELETE FROM tblleavetype where id = ".$leave_type_id;
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo "<script>alert('LeaveType deleted Successfully');</script>";
     		echo "<script type='text/javascript'> document.location = 'leave_type.php'; </script>";
			
		}
	}
?>

<?php
 if(isset($_POST['add']))
{
	 $leavetype=$_POST['leavetype'];
	 $description=$_POST['description'];

	$credits=0;



     $query = mysqli_query($conn,"select * from tblleavetype where LeaveType = '$leavetype'")or die(mysqli_error());
	 $count = mysqli_num_rows($query);
     
	 $ltID = rand(111,999).rand(1,9);

	

     if ($count > 0){ 
     	echo "<script>alert('LeaveType Already exist');</script>";
      }
      else{
        $query = mysqli_query($conn,"insert into tblleavetype (id, LeaveType, Description, default_credit)
  		 values ('$ltID', '$leavetype', '$description',  '$credits')      
		") or die(mysqli_error()); 

		if ($query) {

			$callallEmp = "SELECT * FROM tblemployees";
			$x1 = mysqli_query($conn, $callallEmp);

			while ($row = mysqli_fetch_array($x1)) {

				$empid = $row['emp_id'];
			

				$insertall = "INSERT INTO `tblempcred` (`emp_id`, `leaveid`, `credits`, `status` ) VALUES ('$empid', '$ltID', '$credits', '1')";

				if(mysqli_query($conn, $insertall)){

				}
			}

			echo "<script>alert('LeaveType Added');</script>";
			echo "<script type='text/javascript'> document.location = 'leave_type.php'; </script>";
		}
    }

}

?>
<body>


	<?php include('includes/navbar.php')?>

	<?php include('includes/right_sidebar.php')?>

	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Leave Type List</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
										<li class="breadcrumb-item active" aria-current="page">Leave Type Module</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
							<div class="card-box pd-30 pt-10 height-100-p">
								<h2 class="mb-30 h4">New Leave Type</h2>
								<section>
									<form name="save" method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label >Leave Code</label>
												<input name="leavetype" type="text" class="form-control" required="true" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Leave Description</label>
												<textarea name="description" style="height: 5em;" class="form-control text_area" type="text"></textarea>
											</div>

									<!--<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Apply Leave Credits to All</label>
												<input name="default_credit" class="form-control" type="number">
											</div>
										</div>
									</div>-->
									
									<div class="col-sm-12 text-right">
										<div class="dropdown">
										   <input class="btn btn-primary" type="submit" value="REGISTER" name="add" id="add">
									    </div>
									</div>
								   </form>
							    </section>
							</div>
						</div>
						
						<div class="col-lg-8 col-md-6 col-sm-12 mb-30">
							<div class="card-box pd-30 pt-10 height-100-p">
								<h2 class="mb-30 h4">Leave Type List</h2>
								<div class="pb-20">
									<table class="data-table table stripe hover nowrap">
										<thead>
										<tr>
											<th class="table-plus">LEAVETYPE</th>
											<th class="table-plus">DESCRIPTION</th>
											
											<th class="datatable-nosort">ACTION</th>
										</tr>
										</thead>
										<tbody>

											<?php $sql = "SELECT * from tblleavetype";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{               ?>  

											<tr>
												<td> <?php echo htmlentities($result->LeaveType);?></td>
	                                            <td><?php echo htmlentities($result->Description);?></td>
	                                           
												<td>
													<div class="table-actions">
														<a href="edit_leave_type.php?edit=<?php echo htmlentities($result->id);?>" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
														<a href="leave_type.php?delete=<?php echo htmlentities($result->id);?>" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
													</div>
												</td>
											</tr>

											<?php $cnt++;} }?>  

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

				</div>

			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<?php include('includes/scripts.php')?>
</body>
</html>