f<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php
	if(isset($_POST['apply']))
	{
	$empid=$session_id;
	$leave_type=$_POST['leave_type'];
	$fromdate=date('d-m-Y', strtotime($_POST['date_from']));
	$todate=date('d-m-Y', strtotime($_POST['date_to']));
	$description=$_POST['description'];  
	$status=0;
	$isread=0;
	$leave_days=$_POST['leave_days'];
	$datePosting = date("Y-m-d");

	if($fromdate > $todate)
	{
	    echo "<script>alert('End Date should be greater than Start Date');</script>";
	  }
	

	else {
		
		$DF = date_create($_POST['date_from']);
		$DT = date_create($_POST['date_to']);

		$diff =  date_diff($DF , $DT );
		$num_days = (1 + $diff->format("%a"));

		$sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Description,Status,IsRead,empid,num_days,PostingDate) VALUES(:leave_type,:fromdate,:todate,:description,:status,:isread,:empid,:num_days,:datePosting)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':leave_type',$leave_type,PDO::PARAM_STR);
		$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
		$query->bindParam(':todate',$todate,PDO::PARAM_STR);
		$query->bindParam(':description',$description,PDO::PARAM_STR);
		$query->bindParam(':status',$status,PDO::PARAM_STR);
		$query->bindParam(':isread',$isread,PDO::PARAM_STR);
		$query->bindParam(':empid',$empid,PDO::PARAM_STR);
		$query->bindParam(':num_days',$num_days,PDO::PARAM_STR);
		$query->bindParam(':datePosting',$datePosting,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
			echo "<script>alert('Leave Application was successful.');</script>";
			echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
		}
		else 
		{
			echo "<script>alert('Something went wrong. Please try again');</script>";
		}

	}

}

?>

<body>

	<?php include('includes/navbar.php')?>

	<?php include('includes/right_sidebar.php')?>

	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pb-20">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Leave Application</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Apply for Leave</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div style="margin-left: 50px; margin-right: 50px;" class="pd-20 card-box mb-30">
          <div class="clearfix">
            <div class="pull-left">
              <h4 class="text-blue h4">Employee Form</h4>
              <p class="mb-20"></p>
            </div>
          </div>
          <div class="wizard-content">
            <form enctype="multipart/form-data" method="post" action="deductcreditquery.php?empid=
							<?php echo $session_id; ?>">
              <section> <?php if ($role_id = 'Staff'): ?> <?php $query= mysqli_query($conn,"select *, tblempcred.credits as 'cred'  from tblemployees INNER JOIN tblempcred ON tblemployees.emp_id = tblempcred.emp_id where tblempcred.emp_id = '$session_id'")or die(mysqli_error());
									$row = mysqli_fetch_array($query);
								?> <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>First Name </label>
                      <input name="firstname" type="text" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['FirstName']; ?>">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Last Name </label>
                      <input name="lastname" type="text" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['LastName']; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Email Address</label>
                      <input name="email" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['EmailId']; ?>">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Day Type </label>
                      <select name="day_type" id="my-select" class="custom-select form-control" required="true" autocomplete="off">
                        <option value="1">Whole Day</option>
                        <option value="2">Half Day</option>
                      </select>
                      <style type="text/css">
                        * {
                          transition: 0.5s;
                        }
                      </style>
                      <script>
                        let select = document.getElementById("my-select"),
                          showOption = document.querySelector('#option-selected');
                        select.addEventListener('change', function() {
                          if (this.value == 2) {
                            document.getElementById("enddate").style.opacity = "0";
                            let getdate1 = document.getElementById("date1");
                            let finadate = "";
                            console.log(this.value);

                            getdate1.addEventListener('change', function() {

                              document.getElementById("date2").setAttribute("value", this.value);

                            });

                          } else {
                            console.log(this.value);
                            document.getElementById("date2").setAttribute("value", "0000-00-00");
                            document.getElementById("enddate").style.opacity = "100";
                          }
                        });
                      </script>
                    </div>
                  </div> <?php endif ?>
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Leave Type :</label>
                      <select name="leave_type" class="custom-select form-control" required="true" autocomplete="off">
                        <option value="">Select leave type...</option> <?php $sql = "SELECT  * from tblleavetype";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{   ?> <option value="<?php echo htmlentities($result->id);?>"> <?php echo htmlentities($result->Description);?> </option> <?php }} ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Start Leave Date :</label>
                      <input name="date_from" type="date" id="date1" value="" class="form-control" required="true">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group" id="enddate">
                      <label>End Leave Date :</label>
                      <input name="date_to" type="date" id="date2" class="form-control" required="true" autocomplete="off">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                      <label>Reason For Leave :</label>
                      <textarea id="textarea1" name="description" class="form-control" required length="150" maxlength="150" required="true" autocomplete="off"></textarea>
                    </div>
                    <label style="font-size:6px;">
                      <b></b>
                    </label>
                    <input type="file" id="myFile" value="Attach file " name="files">
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label style="font-size:16px;">
                        <b></b>
                      </label>
                      <div class="modal-footer justify-content-center">
                        <button class="btn btn-primary" name="apply" data-toggle="modal">Apply&nbsp;Leave</button>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </form>
          </div>
        </div>
				</div>
			</div>
			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<?php include('includes/scripts.php')?>
</body>
</html>