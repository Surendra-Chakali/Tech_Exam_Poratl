<?php
session_start();
include("db_connection.php");
$nameerror = $depterror = $yearerror = $rollnumbererror = $pwderror = $numerror = $smlltrerror = $capltrerror = $specialcharerror = "";"";

# User Credentials
if(isset($_POST['submit']))
{
$name = $_POST['faculty_name'];
$deptname = $_POST['dept'];
$pwd = $_POST['passwrd'];
$cpwd = $_POST['cpasswrd'];

if(!$conn){
	echo "Connection Error:".mysqli_connect_error();
}
else{
	if(!empty($name))
	{
		if(!empty($deptname))
		{ 
			if(!empty($pwd) && !empty($cpwd) && $pwd === $cpwd)
			{
				if(preg_match("@[A-Z]@", $pwd))
						{
							if(preg_match("@[a-z]@", $pwd))
							{
								if(preg_match("@[0-9]@", $pwd))
								{
									if(preg_match('/[!@#$%^&*()\,.<>:;[]|]/', $pwd))
										{
						$_SESSION["facultyname"] = $name;
						$_SESSION["departmentname"] = $deptname;
						$_SESSION["cpasswrd"] = $cpwd;
				$result = mysqli_query($conn,"select * from faculty where faculty_name = '$name'");
				$details = array();
				$fdetails = mysqli_fetch_array($result);
				$faculty_name = $fdetails['faculty_name'];
				$dept = $fdetails['dept'];

					if($faculty_name == $name){
						?>
							<script type="text/javascript">
								alert("Faculty name is already registered");
							</script>
							<meta http-equiv="refresh" content="0,url=/TecExam/index.php">
							<?php
					}
				else
				{
					
					# insert data into database
						$sql = "insert into faculty values('$name','$deptname','$pwd','$cpwd')";
						if($conn->query($sql))
						{
							?>
							<script type="text/javascript">
								alert("Registered Successfully. please login");
							</script>
							<meta http-equiv="refresh" content="0.1,url=/TecExam/index.php">
							<?php
						}else{echo "<p class = 'text-center text-danger'>Error in registration</p>";}}

						}else{$specialcharerror = "At least one Special character is required";}
						}else{$numerror = "At least one number is required";}
						}else{$smlltrerror = "At least one Small letter is required";}
						}else{$capltrerror = "At least one Capital letter is required";}
			  }else{$pwderror = "Password and confirm password do not match";}
		}else{$depterror = "department should not be empty";}
	}else{$nameerror = "Name should not be empty";}
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Faculty Registration</title>
	 <meta charset="UTF-8">
  <meta name="description" content="Online Examinaition">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/teclogo.jpg">
  <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital@1&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 
   <style type="text/css">
  	body{
  	     	font-family: 'Philosopher', sans-serif;
          counter-reset: section;
	     }
	   .passerror,.pwd_match{
	   	display: none;
	   }
	   input[type='password']:focus{
	   	outline: none;
	   }
	   form,h2{position: relative;}
	   body:before{content: '';position: absolute;width: 100%;height: 100%;background-image: url('images/clg.jpeg');background-position: center center;filter: blur(7px);background-size: 100% 100%;}
	   ul li a{font-size: 20px;}

	   #block{
	   	position: absolute;
	   	top: 50%;
	   	left: 50%;
	   	transform: translate(-50%,-50%);
	   	padding: 40px;
	   	width: 400px;
	   	background-color: white;
	   	border-radius: 10px;
	   	background-image: linear-gradient(to left bottom,#0099ff,#ff00ff);
	   }
	   input[type='text'],input[type='password'],select
	   {
	   	border: none;
	   	outline: none;
	   	border-bottom: 1px solid lightgray;
	   	background: transparent;
	   	width: 100%;
	   	color: white;
	   }
	   select{color: black;}
	   input[placeholder]
	   {
	   	color: white;
	   }
	   button[type='submit']
	   {
	   	width: 100%;
	   	border-radius: 100px;
	   	background-image: linear-gradient(to left,yellow,orange);
	   	transition: 1s;
	   }
	   button[type='submit']:hover
	   {
	   		background-image: linear-gradient(to left,orange,yellow);
	   		transition: 1s;
	   }



  	@media only screen and (min-width: 612px){
  		nav h1{
  		display: none;
  	}
  	.brand{
  		width: 90px;
  		height: 90px;
  	}
  	div ul li a:hover{
			border-bottom: 1px solid red;
		}
  	}
  	
  	@media only screen and (max-width: 610px){
  	  	
  	nav h2{display: none;}
  	.brand{width: 50px;height: 50px;}
  	div ul{font-size: 20px;}
  	div ul li a:hover{border-bottom: 1px solid green;}
  	div h2{font-size: 20px;}
  	
  	#block{
  		width: 300px;
  	}
  	}

  	@media only screen and (max-width: 690px){
  		div ul{
  			background: white;
  			position: relative;
  			z-index: 10;
 		}
  	}
  </style>
</head>
<body style="font-family: 'Philosopher', sans-serif;">

	<nav class="navbar navbar-expand-md">
		  <!-- Brand -->
		  <a class="navbar-brand" href="index.php"><img src="images/teclogo.jpg" class="brand" width="100px"></a>
		  <h2 style="color: red;">Tadipatri Engineering College</h2>
		 <h1 style="color: red;">TECH</h1>
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
			        <a class="nav-link" href="faculty_login.php">Faculty Login</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="student_login.php">Student Login</a>
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

	<div class="container mt-4">
		<div id="block">
		<h2 class="text-center text-white mb-4">Faculty Registration</h2>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
			
			  <div class="">
			    <label for="name" class="text-white">Name :)</label><br>
			    <input type="text" class="" placeholder="Your Name" id="name" name="faculty_name">
			    <p class="text-danger"><?php echo $nameerror;?></p>
			  </div>
			  <div class="">
			    <label for="dept" class="text-white">Department</label><br>
				   <select class="" id="dept" name="dept">
					   	<option></option>
					   	<option value="cse">CSE</option>
					   	<option value="civil">CIVIL</option>
					   	<option value="eee">EEE</option>
					   	<option value="ece">ECE</option>
					   	<option value="mec">MECH</option>
				   </select>
				   <p class="text-danger"><?php echo $depterror;?></p>
			  </div>
			  <div class="">
			    <label for="pwd" class="text-white">Password</label><br>
			    <input type="password" class="" placeholder="Your Password" id="pwd" name="passwrd">
<p class="text-danger passerror">Your password must contain at least 8 characters, one Capital letter, one small letter, one special character and one number.</p>
			    <p class="text-danger"><?php echo $pwderror;  echo $numerror; echo $smlltrerror; echo $capltrerror; echo $specialcharerror; ?></p>
			  </div>
			  <div class="">
			    <label for="cpwd" class="text-white">Confirm Password</label><br>
			    <input type="password" placeholder="Confirm Password" id="cpwd" name="cpasswrd">
			    <p class="text-danger pwd_match">Password do not match</p>

			    <p class="text-danger"><?php echo $pwderror;?></p>
			  </div>
			  <button type="submit" class="btn" name="submit" id="submit">Submit</button>
		</form>
		</div>
		<br><br>
			<hr>Already member then <a href="faculty_login.php">Login Here</a>
	</div>
	
</body>
</html>
<script type="text/javascript" src="js/validation_js.js"></script>