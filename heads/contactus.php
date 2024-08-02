<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<body>


	<?php include('includes/navbar.php')?>

	<?php include('includes/right_sidebar.php')?>

	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
				
					<div class="col-md-8">

						<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
								$row = mysqli_fetch_array($query);
						?>
<br>
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							<div class="weight-600 font-30 text-blue">RD REALTY DEVELOPMENT CORPORATION
</div>
							<p>General Santos City Business Park, National Highway</p>
							General Santos City, Philippines 9500
							<p>Mobile: +639189797503 &#160;<br> Phone: +6383 5524435 / 8771210 Email:<br> info@rdrealty.com.ph </p>
							

						
						</h4>

						<br>
				

		
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