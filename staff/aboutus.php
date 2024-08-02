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
				<div class="weight-800 font-30 text-black"><center>REALTY DEVELOPMENT GROUP</center></div><br>
						<center>
							<p align="justify">RD Realty Development Corporation was established & registered in June 24, 1985 and is one of the subsidiaries of RD Group of Companies under the management and direction of Mr. Roy C. Rivera.</p>
						</center>
						</h4>

					<br>
	<h4 class="font-20 weight-500 mb-10 text-capitalize">
		
							<p align="justify">RD Realty Development Corporation is a member of RD Group of Companies that engaged in the development of real estate projects, property management, and construction of many of the company’s future developments. It has grown into a very integrated company providing employment to over 250 people.</p>

						</h4>
						
							<h4 class="font-20 weight-500 mb-10 text-capitalize">
		
							<p align="justify">RD Realty Development Corporation is the property holding firm of the Realty Development Group. It is the largest property owner and considered as the trendsetter in the leasing industry in General Santos City which today operates a growing inventory of 45,000 sqm leasable building spaces across the country and overseas.</p>

						</h4>
						<br>
						<div class="weight-800 font-30 text-black"><center>Who we are</center></div><br>
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							<div class="weight-600 font-30 text-blue">Vision</div><br>
							A diversified real estate company delivering maximum value to customers and stockholders guided by the highest ethical standards of practice and strong faith in God.

						</h4>

						<br>
				<h4 class="font-20 weight-500 mb-10 text-capitalize">
					<div class="weight-600 font-30 text-blue">Mission</div><br>
							We are committed to a sustainable and profitable real estate development and business transactions through fostering a mutually beneficial relationship with our stakeholders.  We aim to uplift the quality of life of the communities where we operate and glorify God in everything we do.
						</h4>
						<br>
				<h4 class="font-20 weight-500 mb-10 text-capitalize">
					<div class="weight-600 font-30 text-blue">Core Values</div><br>
							<li>Integrity</li>
							<li>Innovation</li>
							<li>Excellence</li>
							<li>Interdependence</li>
							<li>Godliness</li>
						</h4>

		
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