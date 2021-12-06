<?php
session_start();
$rollnum = $_SESSION["rollnumber"];
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
  div ul{font-size: 20px;}
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

<nav class="navbar navbar-expand-md" style="background: skyblue;">
      <!-- Brand -->
      <a class="navbar-brand" href="index.php"><img src="images/teclogo.jpg" class="brand" width="90px"></a>
     <h2 style="color: red;">Tadipatri Engineering College</h2>
     <h1 style="color: red;">TECH</h1>
      <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" type="button" style="outline: none;" data-toggle="collapse" data-target="#navigation">
  <span class=""><hr style="width: 30px;border:1px solid red;margin-bottom: -9px;border-radius: 10px;"></span>
    <span class=""><hr style="width: 20px;border:1px solid green;margin-bottom: -9px;border-radius: 10px;"></span>
    <span class=""><hr style="width: 30px;border:1px solid blue;border-radius: 30%;"></span>
      </button>

		  <!-- Navbar links -->
			 <div class="collapse navbar-collapse justify-content-end align-items-center" id="navigation">
          <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item">
            <a class="nav-link" href="student_account.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
       </div>
		</nav>
<section class="container">
  <?php
include("db_connection.php");

      $result1 = mysqli_query($conn,"select * from result where rollnumber = '$rollnum' ");

        if($result1 -> num_rows >0)
        { 
          echo "<table class='table table-hover text-center'><thead class=''><tr><th style='color:red;'>Subject</th><th style='color:green;'>Score</th></tr></thead>";
        while($data = mysqli_fetch_array($result1))
        {
          $name = $data['stdname'];
          $score = $data['score'];
          $subject = $data['subject'];
          $totalscore = mysqli_query($conn, "select MAX(sno) as ttl from questions where subjectname ='$subject' ");
          while($row = mysqli_fetch_array($totalscore)){$ttl = $row['ttl'];}
          echo "<tbody><tr><td>".$subject."</td><td>".$score." / ".$ttl."</td></tr></tbody>";
        } 
      echo "</table>";
  }
  else{
    echo "<h4 class='text-center text-danger mt-3'>No data found</h4>";
  }
  ?>

</section>

</body>
</html>


