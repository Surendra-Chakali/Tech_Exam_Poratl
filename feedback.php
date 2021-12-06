<!DOCTYPE html>
<html>
<head>
	<title>Feedback</title>
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
	}	
	.container{
		position: relative;
		top: 40px;
	}	
      @media only screen and (min-width: 612px){
      nav h1{
      display: none;
    }
  }
  	
  	@media only screen and (max-width: 610px){
  	  	
  	nav h2{
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
<div>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		  <!-- Brand -->
		  <a class="navbar-brand" href="index.html"><img src="images/teclogo.jpg" class="brand" width="100px"></a>
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
			      <a class="nav-link text-white" href="index.html">Home</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link text-white" href="faculty_login.php">Faculty Login</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link text-white" href="student_login.php">Student Login</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link text-white" href="developers.php">Developer</a>
			      </li>
			    </ul>
			 </div>
	</nav>

	<?php
		include("db_connection.php");

		$nameerror = $feedbackerror = "";
		if(isset($_POST['submit']))
		{
			$name = $_POST['name'];
			$feedback = $_POST['feedback'];
			if(!empty($name))
			{
				if(!empty($feedback))
				{
					$sql = mysqli_query($conn,"INSERT INTO feedback VALUES ('$name','$feedback')");
					if($sql){echo "<h4 class = 'text-center text-success mt-3'>Thanks for your valuable feedback :)</h4>";}
					else{echo "<h4 class = 'text-center text-danger mt-3'>Sorry! please try agin later</h4>";}
				}
				else{$feedbackerror = "Comment should not be empty";}
			}
			else{$nameerror = "Name should not be empty";}
		}

	?>

	<div class="container">
		<h1 class="text-center text-danger">Feedback</h1>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="mb-3">
				<label for="name">Enter your name</label>
				<input type="text" name="name" id="name" class="form-control" placeholder="Your name">
				<p class="text-center text-danger"><?php echo $nameerror;?></p>
			</div>
			<div class="mb-3">
				<label for="feedback">Feedback</label>
				<textarea class="form-control" name="feedback" placeholder="Type your Comment here" id="feedback"></textarea>
				<p class="text-center text-danger"><?php echo $feedbackerror;?></p>
			</div>
			<div>
				<input type="submit" name="submit" class="btn btn-primary btn-block mt-4">
			</div>
		</form>
	</div>


</body>
</html>