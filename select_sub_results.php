<?php
session_start();
$_SESSION["facultyname"] = $_SESSION["facultyname"];
$fname = $_SESSION["facultyname"];
include("db_connection.php");

$std = mysqli_query($conn,"select * from faculty where fname = '$fname'");
$result = mysqli_fetch_array($std);
$dept = $result['dept'];

$yearerror = $suberror = "";
if(isset($_POST['submit']))
{
  
  $selectyear = $_POST['year'];
  $subname = $_POST['subject'];
  $resultway = $_POST['resultway'];
  if(!empty($selectyear))
  {
    if(!empty($subname))
    {
      if($resultway == "result")
      {
        $_SESSION["year"] = $selectyear;
        $_SESSION["subjectname"] = $subname;
        header('location:result.php');
      }
      else{
        $_SESSION["year"] = $selectyear;
        $_SESSION["subjectname"] = $subname;
        header('location:result1.php');
      }
        
  }
  else{
        $suberror = "Please select subject";
  }
}
  else{
    $yearerror = "Plase select year";
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
  	body{font-family: 'Philosopher', sans-serif;}  	
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
            <a class="nav-link" href="faculty_account.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="select_sub_results.php">Results</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
       </div>
		</nav>

<!--  -->
<div class="container mt-3">
<h2 class="text-center">Welcome to Results Portal</h2>
</div>
<section class="container">
	<form action="" method="post">
    <div class="form-group">
          <label for="year">Select Year</label>
           <select class="form-control" id="year" name="year" required>
              <option> </option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
           </select>
           <h6 class="text-danger"><?php echo $yearerror;?></h6>
           
    </div>
     <div class="form-group">
          <label for="subject">Select Subject</label>
           <select class="form-control" id="subject" name="subject" required>
              <option> </option>
               <?php 

               
        $sql = mysqli_query($conn , "select * from questions where departname = '$dept' and sno = 1");

        if($sql ->num_rows>0)
          {
          while ($row = mysqli_fetch_array($sql)) {
            $subject = $row['subjectname'];
           ?>
           <?php
            echo "<option value='$subject'>$subject</option>";
          }}
        ?>
           </select>
           <h6 class="text-danger"><?php echo $suberror;?></h6>
           
    </div>
    <div class="form-group">
          <label for="resultway">Your question paper relates to</label>
           <select class="form-control" id="resultway" name="resultway" required>
              <option> </option>
              <option value="result1">Multiple choice qns</option>
              <option value="result">Fill in the blank qns</option>
           </select>
            
    </div>
	<input type="submit" class="btn btn-danger float-right" name="submit" value="Submit">
</form>
</section>
</body>
</html>