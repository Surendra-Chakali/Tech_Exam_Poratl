	<?php
session_start();
include("db_connection.php");
$nameerror = $passwrderror = "";
if(isset($_POST['fsubmit']))
{
	$name = $_POST['name'];
	$newpasswrd = $_POST['newpasswrd'];
	

		if(!$conn){
			echo "Connection Error:".mysqli_connect_error();
		}
else{
	if(!empty($name) && !empty($newpasswrd))
	{
		
		$result = mysqli_query($conn,"select * from faculty where fname = '$name' and cpasswrd = '$newpasswrd'");
		$row = mysqli_fetch_array($result);
		$fname = $row['fname'];
		$passwrd = $row['cpasswrd'];
		
		if($fname == $name && $passwrd == $newpasswrd)
		{
			$_SESSION["facultyname"] = $name;
			header('location:faculty_account.php');
		}
		else{
			echo "<p class='text-center text-danger mt-4'>Invalid Name or password</p>";
		}
	}
	else{
		$nameerror = "Name should not be empty";
		$passwrderror = "Password should not be empty";
	}
}
}

/* TPO login  */

if(isset($_POST['submit1']))
{
	$name = $_POST['tponame'];
	$newpasswrd = $_POST['newpasswrd'];
	
	if(!empty($name) && !empty($newpasswrd))
	{
		
		$result = mysqli_query($conn,"select * from faculty where fname = '$name' and cpasswrd = '$newpasswrd'");
		$row = mysqli_fetch_array($result);
		$fname = $row['fname'];
		$passwrd = $row['cpasswrd'];
		
		if($fname == $name && $passwrd == $newpasswrd)
		{
			$_SESSION["facultyname"] = $name;
			header('location:faculty_account.php');
		}
		else{
			echo "<p class='text-center text-danger mt-4'>Invalid Name or password</p>";
		}
	}
	else{
		$nameerror = "Name should not be empty";
		$passwrderror = "Password should not be empty";
	}
}



/* Student login */

$rollnumerror = $passwrderror = "";
if(isset($_POST['submit']))
{
	$rollnum = $_POST['rollnum'];
	$pwd = $_POST['pwd'];
	
	
if(!$conn){
		echo "Connection Error:".mysqli_connect_error();
	}

else{
		if(!empty($rollnum)) 
		{
			if(!empty($pwd))
			{
				$sql = mysqli_query($conn,"select * from students where rollnum = '$rollnum' and cpwd = '$pwd'");
				$row = mysqli_fetch_assoc($sql);
					
				if($row["rollnum"] == $rollnum && $row["cpwd"] == $pwd)
				{
					$_SESSION["rollnumber"] = $rollnum;
					header('location:student_account.php');
				}
				else{
					echo "<p class='text-center text-danger'>Roll number or Password do not match</p>";
				}
			
		}
			else{
				$passwrderror = "Password should not be empty";
			}
		}
		else{
			$rollnumerror = "Name should not be empty";
		}
	}
}	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tadipatri Engineering College</title>
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

  	  .fa{cursor: pointer;position: relative;top: -28px;right: 8px;font-size: 18px;}
      #hide,#hide1{display: none;}
      .modal-content{border: none;border-radius: 10px;}
      .modal-content:before{content: '';position: absolute;top: -2px;bottom: -2px;left: -2px;right: -2px;z-index: -1;}
      .modal-content:after{content: '';position: absolute;top: -2px;bottom: -2px;left: -2px;right: -2px;z-index: -2;filter: blur(20px);}
      .modal-content:before,.modal-content:after{border-radius: 10px;background: linear-gradient(235deg, #89ff00, #060c21, #00bcd4)}
  	button[type='submit']
	   {
	   	width: 100%;
	   	border-radius: 100px;
	   	background-image: linear-gradient(to left bottom,#ff00ff,#0099ff);
	   	transition: 1s;
	   }
	 button[type='submit']:hover
	   {
	   		background-image: linear-gradient(to left bottom,#0099ff,#ff00ff);
	   		transition: 1s;
	   }
	 input[type='text'],input[type='password']
	   {
	   	border: none;
	   	outline: none;
	   	border-bottom: 1px solid lightgray;
	   	background: transparent;
	   	width: 100%;
	   	text-decoration: none;
	   }
  	@media only screen and (min-width: 612px){

		body{
			  font-family: 'Philosopher', sans-serif;
			  animation-name: slide;
			  animation-duration: 10s;
			  animation-iteration-count: infinite;
			  background-image: url('images/tecstudents.png');background-size: 100% 600px;background-repeat: no-repeat;
			}
		#tecname {
			position: relative; 
			top: 180px;
			font-size: 30px;
		}
		div ul{
			font-size: 20px;
		}
		div ul li a{width: 100%;}
		
		div ul li a:hover{
			border-bottom: 1px solid red;
		}
		
		@keyframes slide{
			/*  0%   {background-image: url('images/tecstudents.png');background-size: cover;background-repeat: no-repeat;}  */
			   0%   {background-image: url('images/clg.jpeg');background-size: 100% 800px;background-repeat: no-repeat;}
			  50%  {background-image: url('images/tecstudents.png');background-size: 100% 800px;background-repeat: no-repeat;}
			  100% {background-image: url('images/clg3.jpeg');background-size: 100% 800px;background-repeat: no-repeat;}
			}
		}
  	@media only screen and (max-width: 610px){
  	body{
  		height: 300px;
  		font-family: 'Philosopher', sans-serif;
  		animation-name: slides;
		animation-duration: 8s;
		animation-iteration-count: infinite;
  	}
  	@keyframes slides
  			{
			  0%   {background-image: url('images/clg.jpeg');background-size: 100% 700px;background-repeat: no-repeat;}
			  50%  {background-image: url('images/tecstudents.png');background-size: 100% 700px;background-repeat: no-repeat;}
			  100% {background-image: url('images/clg3.jpeg');background-size: 100% 700px;background-repeat: no-repeat;}
			}
   .brand{
  		width: 50px;
  		height: 50px;
  	}

  	#demo,#tecname p{
  		display: none;
  	}
  	div h1{
  		display: flex;
  		align-items: center;
  		justify-content: center;
  		font-size: 40px;
  		position: relative;
  		margin-top: 50px;
  		font-weight: bolder;
  	}

  	}
  	@media only screen and (max-width: 690px)
  	{
  		  	div ul{
  			background: white;
  			position: relative;
  			z-index: 10;
  			}
  	div ul li a:hover{
  		border-bottom: 1px solid green;
  	}
  	}
  </style>
</head>
<body>
<div>
	<nav class="navbar navbar-expand-md">
		  <!-- Brand -->
		  <a class="navbar-brand" href="index.php"><img src="images/teclogo.jpg" class="brand" width="100px"></a>

		  <!-- Toggler/collapsibe Button -->
		  <button class="navbar-toggler" style="outline: none;" type="button" data-toggle="collapse" data-target="#navigation">
		    	<span class=""><hr style="width: 30px;border:1px solid red;margin-bottom: -9px;border-radius: 10px;"></span>
    			<span class=""><hr style="width: 20px;border:1px solid green;margin-bottom: -9px;border-radius: 10px;"></span>
    			<span class=""><hr style="width: 30px;border:1px solid blue;border-radius: 30%;"></span>
		  </button>

		  <!-- Navbar links -->
			 <div class="collapse navbar-collapse justify-content-end align-items-center" id="navigation">
			    <ul class="navbar-nav d-flex align-items-center">
			      <li class="nav-item">
			      <a class="nav-link" href="index.php">Home</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="" data-toggle="modal" data-target="#faculty_login">Faculty Login</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="" data-toggle="modal" data-target="#student_login">Student Login</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="" data-toggle="modal" data-target="#tpo_login">TPO Login</a>
			      </li>			      
			      <li class="nav-item">
			        <a class="nav-link" href="developers.php">Developer</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="show_feedback.php">Feedback</a>
			      </li>
			    </ul>
			 </div>
	</nav>

<!--Faculty model-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="faculty_login" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="mt-4 mb-3">
        	<h3 class="modal-title text-center text-success">Faculty login</h3>
        </div>
        <div class="modal-body">
          <form method="post">
			  <div class="">
			    <label for="name">Name</label>
			    <input type="text" placeholder="Your Name" id="name" name="name" style="text-indent: 10px;">
			    <p class="text-danger"><?php echo $nameerror;?></p>
			  </div>
			  <div class="">
			    <label for="pwd">Password</label>
			    <input type="password" placeholder="Your Password" id="pwd" name="newpasswrd" style="text-indent: 10px;">
		  <span>
              <i class="fa fa-eye float-right" aria-hidden="true" id="show" onclick="toggle()"></i>
              <i class="fa fa-eye fa-eye-slash float-right" aria-hidden="true" id="hide" onclick="toggle()"></i>
          </span>
			    <p class="text-danger"><?php echo $passwrderror;?></p>
			  </div>
			  <button type="submit" class="btn text-white" name="fsubmit" id="loginsubmit">Login</button>
		</form>
		<p class="text-center mt-4">Lost your password lets! &nbsp; <a href="faculty_forgot_password.php" class="text-danger">Forgot Password</a></p>
        </div>
        <div class="text-center mb-3">
			<hr>Don't have an account then click here to <a href="faculty_registration.php">Register</a>
        </div>
      </div>
      
    </div>
  </div>
</div>

<!--TPO model-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="tpo_login" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="mt-4 mb-3">
        	<h3 class="modal-title text-center text-success">TPO login</h3>
        </div>
        <div class="modal-body">
          <form method="post">
			  <div class="">
			    <label for="tponame">Name</label>
			    <input type="text" placeholder="Your Name" id="tponame" name="tponame" style="text-indent: 10px;">
			    <p class="text-danger"><?php echo $nameerror;?></p>
			  </div>
			  <div class="">
			    <label for="pwd">Password</label>
			    <input type="password" placeholder="Your Password" id="pwd" name="newpasswrd" style="text-indent: 10px;">
		  <span>
              <i class="fa fa-eye float-right" aria-hidden="true" id="show" onclick="toggle()"></i>
              <i class="fa fa-eye fa-eye-slash float-right" aria-hidden="true" id="hide" onclick="toggle()"></i>
          </span>
			    <p class="text-danger"><?php echo $passwrderror;?></p>
			  </div>
			  <button type="submit" class="btn text-white" name="submit1" id="loginsubmit">Login</button>
		</form>
		<p class="text-center mt-4">Lost your password lets! &nbsp; <a href="" class="text-danger">Forgot Password</a></p>
        </div>
      </div>
      
    </div>
  </div>
</div>

<!--Student model-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="student_login" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="mt-4 mb-3">
        	<h3 class="modal-title text-center text-success">Student login</h3>
        </div>
        <div class="modal-body">
          <form method="post">
			  <div class="">
				<label for="rollnum">Roll number</label>
				<input type="text" class="" id="rollnum" placeholder="Your roll number" name="rollnum" style="text-indent: 10px;">
				<p class="text-danger"><?php echo $rollnumerror;?></p>			  	
			  </div>
			  <div class="">
			    <label for="spwd">Password</label>
			    <input type="password" class="" placeholder="Your Password" id="spwd" name="pwd" style="text-indent: 10px;">
		<span>
              <i class="fa fa-eye float-right" aria-hidden="true" id="show1" onclick="toggle1()"></i>
              <i class="fa fa-eye fa-eye-slash float-right" aria-hidden="true" id="hide1" onclick="toggle1()"></i>
          </span>
			    <p class="text-danger"><?php echo $passwrderror;?></p>
			  </div>
			  <button type="submit" class="btn text-white" name="submit">Submit</button>
		</form>
		 <p class="text-center mt-4">Lost your password lets! &nbsp; <a href="forgot_password.php" class="text-danger">Forgot Password</a></p>
        </div>
        <div class="text-center mb-3">
			<hr>Don't have an account <a href="student_registration.php">Register Here</a>
        </div>
      </div>
      
    </div>
  </div>
</div>

<!-- Name -->
<div id="tecname">
	<h1 class="text-center text-white display-4 font-weight-bolder"><i><span style="color: red;">T</span>adipatri <span style="color: green;">E</span>ngineering <span style="color: blue;">C</span>ollege</i></h1>
	<p class="text-center text-white">The place where creators are born</p>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="js/password_verify.js"></script>