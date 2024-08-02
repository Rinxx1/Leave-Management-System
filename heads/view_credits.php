<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<body>

	<?php include('includes/navbar.php')?>

	<?php include('includes/right_sidebar.php')?>

	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		

		<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4 user-icon">
						<img src="../vendors/images/banner-img.png" alt="">
					</div>
					<div class="col-md-8">

						<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
								$row = mysqli_fetch_array($query);
						?>

						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome!  <div class="weight-600 font-70 text-blue"><?php echo $row['FirstName']. " " .$row['LastName']; ?></div>
							<br>
					
						</h4>
					
					</div>

				</div>
			</div>




<style type="text/css">
	table {

  background: #142026;
  border-radius: 0.25em;
  border-collapse: collapse;
 
}
th {
  border-bottom: 1px solid #364043;
  color: #E2B842;
  font-size: 0.85em;
  font-weight: 600;
  padding: 0.5em 1em;
  text-align: left;
}
td {
  color: #fff;
  font-weight: 400;
  padding: 0.65em 1em;
}

tbody tr {
  transition: background 0.25s ease;
}
tbody tr:hover {
  background: #014055;
}


  border-radius: 0.25em;
  border-collapse: collapse;
  margin: 1em;
}
th {
  border-bottom: 1px solid #364043;
  color: #E2B842;
  font-size: 0.85em;
  font-weight: 600;
  padding: 0.5em 1em;
  text-align: left;
}
td {

  font-weight: 400;
  padding: 0.65em 1em;
}

tbody tr {
  transition: background 0.25s ease;
}
tbody tr:hover {
  background: #014055;
}


</style>





			<div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">Leave Credits</h2>
					</div>
				<div class="pb-20">
					

           <table class="table sidebar-dark">
                   
                        <thead>
                            <tr>
                            <th class="table-plus ">Type</th>
                              
                                <th>Available</th>
                            </tr>
                        </thead>
                        <tbody>
                        	  <?php 
               			 $lt = $conn->query("SELECT tblleavetype.LeaveType as 'lorsk', tblempcred.credits as 'rensk' FROM `tblempcred` INNER JOIN tblleavetype ON tblempcred.leaveid = tblleavetype.id WHERE emp_id = '$session_id' ");
                while($row=$lt->fetch_assoc()):
                ?>
                                <tr>
                                <td><?php echo $row['lorsk']; ?></td>
                               
                                <td><?php echo $row['rensk']; ?></td>
                            </tr>
<?php endwhile; ?>
               
                        </tbody>
                    </table><script>
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
			</div>


			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<?php include('includes/scripts.php')?>
</body>
</html>