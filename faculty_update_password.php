<?php
session_start();
include("db_connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tech Test</title>
	<meta charset="UTF-8">
  <meta name="description" content="Online Examinaition">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/teclogo.jpg">
  <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital@1&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
  	body{font-family: 'Philosopher', sans-serif;}
  		.fa{cursor: pointer;position: relative;top: -28px;right: 8px;font-size: 18px;}
      #hide,#hide1{display: none;}
      .passerror,.pwd_match{display: none;}
    @media only screen and (min-width: 612px){
      nav h1{
      display: none;
    }
    div ul li a:hover{
      border-bottom: 1px solid red;
    }
    }
  	
  	@media only screen and (max-width: 610px){
  	  	
  	nav h2{$host = "localhost";
  		display: none;
  	}
  	.brand{
  		width: 50px;
  		height: 50px;
  	}
  	div ul{
  		font-size: 20px;
  	}
  	div ul li a:hover{
  		border-bottom: 1px solid green;
  	}
  	div h2{
  		font-size: 20px;
  	}
  	}
  </style>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
		  <!-- Brand -->
		  <a class="navbar-brand" href="index.html"><img src="images/teclogo.jpg" class="brand" width="90px"></a>
		 <h2 class="text-white">Tadipatri Engineering College</h2>
     <h1 class="text-white">TECH</h1>
		  <!-- Toggler/collapsibe Button -->
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <!-- Navbar links -->
			 <div class="collapse navbar-collapse justify-content-end align-items-center" id="navigation">
			    <ul class="navbar-nav d-flex align-items-center">
			      <li class="nav-item">
			      <a class="nav-link text-white" href="user_account.php">Home</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link text-white" href="logout.php">Logout</a>
			      </li>
			    </ul>
			 </div>
		</nav>

    <?php

    $newpasserror = $cpasserror = "";
if(isset($_POST['submit']))
{
  $newpass = $_POST['newpass'];
  $cpass = $_POST['cpass'];
$name = $_SESSION['name'];

    if(!$conn){echo "Connection Error:".mysqli_connect_error();}

else{
    if(!empty($newpass)) 
    {
      if(!empty($cpass))
      {
        if($newpass == $cpass)
        {
  $sql = mysqli_query($conn, "update faculty set passwrd = '$newpass', cpasswrd = '$cpass' where fname = '$name'");
   if($sql){
    ?>
              <script type="text/javascript">
                alert("Password updated successfully");
              </script>
              <meta http-equiv="refresh" content="0,url=/TecExam/faculty_login.php">
    <?php
   }
        }
        else{echo "<h5 class='text-center text-danger mt-2'>Conform password do not match</h5>";}
        }
        else{$cpasserror = "Please Conform Password";}
        }
        else{$newpasserror = "Please enter assword";}
      }}
    ?>
    <div class=" container mt-2">
    <form method="post">
        <div class="form-group">
          <label for="pwd"> New Password</label>
          <input type="password" class="form-control text-center" id="pwd" placeholder="New Password" name="newpass">
          <span>
              <i class="fa fa-eye float-right" aria-hidden="true" id="show" onclick="toggle()"></i>
              <i class="fa fa-eye fa-eye-slash float-right" aria-hidden="true" id="hide" onclick="toggle()"></i>
          </span>
        <p class="text-danger passerror">Your password must contain at least 8 characters, one Capital letter, one small letter, one special character and one number.</p>
          <p class="text-center text-danger"><?php echo $newpasserror;?></p>          
        </div>
        <div class="form-group">
          <label for="cpwd"> Conform Password</label>
     <input type="password" class="form-control text-center" id="cpwd" placeholder="Conform Password" name="cpass">
     <span>
          <i class="fa fa-eye float-right" aria-hidden="true" id="show1" onclick="togglle()"></i>
          <i class="fa fa-eye fa-eye-slash float-right" aria-hidden="true" id="hide1" onclick="togglle()"></i>
        </span>
        <p class="text-danger pwd_match">Password do not match</p>
          <p class="text-center text-danger"><?php echo $cpasserror;?></p>          
        </div>
        <button type="submit" class="btn btn-primary float-right" name="submit" id="submit">Submit</button>
    </form>
  </div>
</body>
</html>
<script type="text/javascript" src="js/validation_js.js"></script>
<script type="text/javascript" src="js/password_verify.js"></script>