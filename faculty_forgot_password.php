<?php
session_start();
include("db_connection.php");
$nameerror = $numerror = "";
if(isset($_POST['submit']))
{
  $name = $_POST['name'];
  $_SESSION['name'] = $name;
        
    if(!$conn){echo "Connection Error:".mysqli_connect_error();}

else{
    if(!empty($name)) 
    {
          $sql = mysqli_query($conn, "select fname from faculty where fname = '$name'");
        if($sql -> num_rows >0)
        {
          header('location:faculty_update_password.php');
        }
        else{$numerror = "<P class='text-center text-danger'>Name is not registered</p>";}
    }
    else{$nameerror = "Please enter roll number";}
  }
}
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
  	body{
  		font-family: 'Philosopher', sans-serif;
	}
  		
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

    <div class=" container mt-2">
    <form method="post">
        <div class="form-group">
          <label for="nam"> Enter Your Name</label>
          <input type="text" class="form-control text-center" id="nam" placeholder="Your your name" name="name">
          <p class="text-center text-danger"><?php echo $nameerror; echo $numerror;?></p>          
        </div>
        <button type="submit" class="btn btn-primary float-right" name="submit">Submit</button>
    </form>
  </div>
</body>
</html>