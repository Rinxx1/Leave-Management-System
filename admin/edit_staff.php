<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php $get_id = $_GET['edit']; ?>
<?php
	if(isset($_POST['add_staff']))
	{
	
	$fname=$_POST['firstname'];
	$lname=$_POST['lastname'];   
	$email=$_POST['email'];  
	$gender=$_POST['gender']; 
	$dob=$_POST['dob']; 
	$department=$_POST['department']; 
	$address=$_POST['address']; 
	$leave_days=$_POST['leave_days']; 
	$user_role=$_POST['user_role']; 
	$phonenumber=$_POST['phonenumber']; 

	$result = mysqli_query($conn,"update tblemployees set FirstName='$fname', LastName='$lname', EmailId='$email', Gender='$gender', Dob='$dob', Department='$department', Address='$address', Av_leave='$leave_days', role='$user_role', Phonenumber='$phonenumber' where emp_id='$get_id'         
		"); 		
	if ($result) {
     	echo "<script>alert('Record Successfully Updated');</script>";
     	echo "<script type='text/javascript'> document.location = 'staff.php'; </script>";
	} else{
	  die(mysqli_error());
   }
		
}

?>
<?php 
$meta_qry = $conn->query("SELECT * FROM employee_meta where user_id = '{$_GET['edit']}' ");
while($row = $meta_qry->fetch_assoc()){
    ${$row['meta_field']} = $row['meta_value'];
}
$leave_type_credits = isset($leave_type_credits) ? json_decode($leave_type_credits) : array();
$ltc = array();
foreach($leave_type_credits as $k=> $v){
    $ltc[$k] = $v;
}
$leave_type_ids = isset($leave_type_ids) ? explode(',',$leave_type_ids) : array();

?>

<body>
	

	<?php include('includes/navbar.php')?>

	<?php include('includes/right_sidebar.php')?>

	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Employee Portal</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Employee Edit</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Edit Employee</h4>
							<p class="mb-20"></p>
						</div>
					</div>
					<div class="wizard-content">
						<form method="post" action="">
							<section>
								<?php
									$query = mysqli_query($conn,"select * from tblemployees where emp_id = '$get_id' ")or die(mysqli_error());
									$row = mysqli_fetch_array($query);
									?>

								<div class="row">
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label >First Name :</label>
											<input name="firstname" type="text" class="form-control wizard-required" required="true" autocomplete="off" value="<?php echo $row['FirstName']; ?>">
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label >Last Name :</label>
											<input name="lastname" type="text" class="form-control" required="true" autocomplete="off" value="<?php echo $row['LastName']; ?>">
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label>Company No. :</label>
											<input name="email" type="text" class="form-control" required="true" autocomplete="off" value="<?php echo $row['EmailId']; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label>Password :</label>
											<input name="password" type="password" placeholder="**********" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['Password']; ?>">
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label>Gender :</label>
											<select name="gender" class="custom-select form-control" required="true" autocomplete="off">
												<option value="<?php echo $row['Gender']; ?>"><?php echo $row['Gender']; ?></option>
												<option value="male">Male</option>
												<option value="female">Female</option>
											</select>
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label>Phone Number :</label>
											<input name="phonenumber" type="text" class="form-control" required="true" autocomplete="off"value="<?php echo $row['Phonenumber']; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label>Date Of Birth :</label>
											<input name="dob" type="text" class="form-control date-picker" required="true" autocomplete="off"value="<?php echo $row['Dob']; ?>">
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label>Address :</label>
											<input name="address" type="text" class="form-control" required="true" autocomplete="off"value="<?php echo $row['Address']; ?>">
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label>Approver :</label>
											<select name="department" class="custom-select form-control" required="true" autocomplete="off">
												<option value="">-------</option>

												<?php
													$query = mysqli_query($conn,"select * from tbldepartments");
													while($row = mysqli_fetch_array($query)){
													
													?>
										<?php echo $row['DepartmentName']; ?>
												<?php
													$query_staff = mysqli_query($conn,"select * from tblemployees join  tbldepartments where emp_id = '$get_id'")or die(mysqli_error());
													$row_staff = mysqli_fetch_array($query_staff);
													
												 ?>

													
													<option value="<?php echo $row['DepartmentShortName']; ?>"><?php echo $row['DepartmentName']; ?></option>
													<?php } ?>
											</select>
										</div>
									</div>
								</div>

								<?php
									$query = mysqli_query($conn,"select * from tblemployees where emp_id = '$get_id' ")or die(mysqli_error());
									$new_row = mysqli_fetch_array($query);
									?>
								<div class="row">
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label>User Role :</label>
											<select name="user_role" class="custom-select form-control" required="true" autocomplete="off">
												<option value="">-------</option>
												<?php echo $new_row['role']; ?>
												<option value="Admin">Admin</option>
												<option value="Approver">Approver</option>
												<option value="Employee">Employee</option>
											</select>
										</div>
									</div>

									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label style="font-size:16px;"><b></b></label>
											<div class="modal-footer justify-content-center">
												<button class="btn btn-primary" name="add_staff" id="add_staff" data-toggle="modal">Update&nbsp;Employee</button>
											</div>
										</div>
									</div>
								</div>
							</section>
						</form>
					</div>
					 <hr class="border-dark">
									 <div class="col-md-4 col-sm-12">
                <div class="callout border-0">
                    <div class="float-right">
               <button class="btn btn-sm btn-default bg-lightblue rounded-circle text-center" type="button" data-toggle="modal" data-target="#myModal"><span class="fa fa-cog"></span></button>
                    </div>
                    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        	     <?php
				$query = mysqli_query($conn,"select * from tblemployees where emp_id = '$get_id' ")or die(mysqli_error());
				$row = mysqli_fetch_array($query);
				?>
        <h3 class="modal-title"><?php echo $row['FirstName']; ?><?php echo " ".$row['LastName']; ?></h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<form method="post" action="addleavequery.php?getid=<?php echo $get_id?>">
       <table class="table table-hover "> 
      		    <colgroup>
                <col width="10%">
                <col width="70%">
                <col width="20%">
            </colgroup>
        		<thead>
		        <tr>
                    <th class="py-1 px-1 text-center">
                        <div class="icheck-primary d-inline">
                            <label for="selectAll">
                            </label>
                        </div>
                    </th>
                    <th class="px-2 py-1">Leave Type</th>
                    <th class="px-2 py-1">Leave Credits</th>
                </tr>

                <?php 



                ?>
			</thead>
					<tbody>
  				<?php 

  					$sumstat = 0;
  					$sumcred = 0;
  					$boolcred = 0;

	                $lt = "SELECT * FROM `tblleavetype` ORDER BY id ASC ";
	                $res = mysqli_query($conn, $lt);
	                while($row = mysqli_fetch_array($res)){
	                	$id = $row['id'];

	                	$sql3 = "SELECT * FROM tblempcred RIGHT JOIN tblleavetype ON tblempcred.leaveid = tblleavetype.id WHERE leaveid = '$id' AND emp_id = '$get_id'";
	                	$sql4 = mysqli_query($conn, $sql3);
	                	$sql5 = mysqli_fetch_array($sql4);

	                	@$idcred = ""; 

	                	

	                	if(@$sql5['empcredID'] == ""){
	                		$idcred = "";
	                	}else{
	                		@$idcred = '<input type="hidden" name="ec'.$sql5['empcredID'].'" value="'.$sql5['empcredID'].'">';
	                	}

	                	$btn = "";
	                	$inpt = "";
	                	$inpt2 = "";
	                	$names = "";


	                	if(@$sql5['status'] == "1"){
	                		$btn = '<button name="btnupdate" class="btn btn-primary">Update</button>';
	                		$inpt = '<input type="number" step="any" name="lc'.$id.'" value="'.@$sql5['credits'].'" class="form-control rounded-0">';
	                		$names = $row['LeaveType'];
	                		
	                	}else{
	                		$inpt = '<input type="number" step="any" name="lc'.$id.'" value="'.@$sql5['credits'].'" class="form-control rounded-0">';
	                		$btn = '<button name="btnsave" class="btn btn-primary">Save</button>';
	                		$names = $row['LeaveType'];
	                	}

                ?>
                <tr>
	      		<td class="text-center">
                <div class="icheck-primary d-inline">
                    <!-- <input type="checkbox" class="check_item" id="select_<?php echo $row['id'] ?>" name="leave_type_id[]" value="<?php echo $row['id'] ?>" <?php echo in_array($row['id'],$leave_type_ids)? 'checked' : '' ?>> -->
                    <label for="select_<?php echo $row['id'] ?>">
                    </label>
                </div>
	            </td>
	               <td><?php echo $names ?></td>
		       	<td>
	               	<?php echo $inpt ?>
	               	<?php echo $idcred ?>

	            </td>
	                 </tr>
	               </tbody>
	               <?php 

	              $sumcred = $sumcred + 1;
	              $sumstat = $sumstat + @$sql5['status'];

	           } 

	           	if($sumcred == $sumstat){
    				$boolcred = 1;
    			}

	           ?>
	            </table>
	                                       

      </div>
      <div class="modal-footer">
   <?php echo @$btn; ?>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
</form>
  </div>
</div>
                    
                    <h5 class="mb-2">Leave Credits</h5>
                    <table class="table table-hover ">
                        <colgroup>
                            <col width="20%">
                       
                            <col width="15%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="py-1 px-2">Type</th>
                             
                                <th class="py-1 px-2">Available</th>
                            </tr>
                        </thead>
                        <tbody>
                        	  <?php 
               			 $lt = $conn->query("SELECT tblleavetype.LeaveType as 'lorsk', tblempcred.credits as 'rensk' FROM `tblempcred` INNER JOIN tblleavetype ON tblempcred.leaveid = tblleavetype.id WHERE emp_id = '$get_id' ");
                while($row=$lt->fetch_assoc()):
                ?>
                            <tr >
                                <th class="py-1 px-2"><?php echo $row['lorsk']; ?></th>
                              
                                <th class="py-1 px-2"><?php echo $row['rensk']; ?></th>
                            </tr>
<?php endwhile; ?>

               
                        </tbody>
                    </table>
                </div>
            </div>
            
				</div>
			<script>
function myFunction() {
 
      	extract($_POST);
		
		$leave_type_ids = array();
		$leave_type_credits = array();

		if(isset($leave_type_id) && count($leave_type_id) > 0){
			$leave_type_ids = $leave_type_id;
			foreach($leave_type_id as $k=> $v){
				$leave_type_credits[$v] = $leave_credit[$k];
			}
		}

		$this->conn->query("DELETE FROM `employee_meta` where (meta_field = 'leave_type_ids' or meta_field = 'leave_type_credits') and user_id = '{$user_id}' ");

		$leave_type_ids = implode(',',$leave_type_ids);
		$leave_type_credits = json_encode($leave_type_credits);
		$data = "('{$user_id}','leave_type_ids','{$leave_type_ids}')";
		$data .= ",('{$user_id}','leave_type_credits','{$leave_type_credits}')";
		$save = $this->conn->query("INSERT INTO `employee_meta` (`user_id`,`meta_field`,`meta_value`) Values {$data}");
		$this->capture_err();
		$resp['status'] = 'success';
		$this->settings->set_flashdata("success"," Leave Type Credits successfully updated.");
		return json_encode($resp);

 }
</script>


			</div>
			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->
	<?php include('includes/scripts.php')?>
</body>
</html>