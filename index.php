<?php
session_start();
include('includes/config.php');
if(isset($_POST['signin']))
{
  $username=$_POST['username'];
  $password=($_POST['password']);

  $sql ="SELECT * FROM tblemployees where EmailId ='$username' AND Password ='$password'";
  $query= mysqli_query($conn, $sql);
  $count = mysqli_num_rows($query);
  if($count > 0)
  {
    while ($row = mysqli_fetch_assoc($query)) {
        if ($row['role'] == 'Admin') {
          $_SESSION['alogin']=$row['emp_id'];
          $_SESSION['arole']=$row['EmailId'];
        echo "<script type='text/javascript'> document.location = 'admin/admin_dashboard.php'; </script>";
        }
        elseif ($row['role'] == 'Employee') {
          $_SESSION['alogin']=$row['emp_id'];
          $_SESSION['arole']=$row['EmailId'];
        echo "<script type='text/javascript'> document.location = 'staff/index.php'; </script>";
        }
        else {
          $_SESSION['alogin']=$row['emp_id'];
          $_SESSION['arole']=$row['EmailId'];
        echo "<script type='text/javascript'> document.location = 'heads/index.php'; </script>";
        }
    }

  } 
  else{
    
    echo "<script>alert('Invalid Details');</script>";

  }

}
// $_SESSION['alogin']=$_POST['username'];
//  echo "<script type='text/javascript'> document.location = 'changepassword.php'; </script>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title> RD Realty Development Corporation</title>


  	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/logo_web.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/logo_web.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/logo_web.png">


  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">

  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-119386393-1');
  </script>

</head>
<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
          	
            <img src="assets/images/logoo.svg" > 
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Log in</h1>
            <form name="signin" method="post">
              <div class="form-group">
                <label for="email">Company ID</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Email ID">
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="**********">
              </div>
              <input name="signin" id="signin" class="btn btn-block login-btn" type="submit" value="Sign in">
            </form>
            <a href="#!" class="forgot-password-link"></a>
            <p class="login-wrapper-footer-text"><a href="#!" class="text-reset"></a></p>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="assets/images/h.png" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
