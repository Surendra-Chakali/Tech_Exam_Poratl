
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
    div ul li a:hover{
      border-bottom: 1px solid red;
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

	<nav class="navbar navbar-expand-md"  style="background: skyblue;">
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

<?php
session_start();
include("db_connection.php");
if(isset($_POST['submit'])){
	$subname = $_SESSION["subjectname"];
	$year =  $_SESSION["year"];
	$faculty_name = $_SESSION["facultyname"];
	$deptname = mysqli_query($conn, "select dept from faculty where fname = '$faculty_name'");
	$deptdata = mysqli_fetch_array($deptname);
	$department_name = $deptdata['dept'];

	
require('PHPExcel/Classes/PHPExcel.php');
require('PHPExcel/Classes/PHPExcel/IOFactory.php');
$file = $_FILES['file']['tmp_name'];	
$obj = PHPExcel_IOFactory::load($file);
foreach ($obj->getWorksheetIterator() as $sheet){
	$highestrow = $sheet->getHighestRow();
		for($i = 1;$i<=$highestrow;$i++){
			$sno = $sheet->getCellByColumnAndRow(0,$i)->getValue();
			$qns = $sheet->getCellByColumnAndRow(1,$i)->getValue();

	$sql1 = mysqli_query($conn,"select * from questions1 where subjectname = '$subname' and sno = $i");
	$result = array();
	$result = mysqli_fetch_array($sql1);
	$subjectname = $result['subjectname'];
	$sn = $result['sno'];

if($i == $sn && $subjectname == $subname){
	mysqli_query($conn, "update questions1 set quation = '$qns', subjectname = '$subname', sno = $sno, year = '$year', departname = '$department_name' where subjectname = '$subname' && sno = $i");}
	else{
		mysqli_query($conn,"insert into questions1 values('$qns','$subname','$sno', '$year', '$department_name')");}}

}
echo "<h4 class='text-center text-success'>Question paper uploaded successfully</h4>";
}
?>
<div class="container">
<div align="center" style="margin-top: 70px;" class="row">
	<div class="text-left">
		<b> <p>-> Click the image to know the format of question paper that you wanna upload</p>
		<p>-> The sno and the question name should be entered as same as shown in image</p></b>
	</div>
	<div style="width: 300px;height: auto;" class="ml-4">
		<a href="images/capture.png">
			<img src="images/capture.png" width="100%" height="100%">
		</a>
	</div>
</div>
</div>
<form method="post" action="" enctype="multipart/form-data">
<div class="text-center container" style="position: relative;top: 80px;">
	<h4 class="mb-4">Please select sheet</h4>
	<input type="file" name="file" class="form-control" style="width: 100%;" align="center" required><br>
	<input type="submit" name="submit" value="upload" class="btn btn-outline-success">
</div>
</form>
</body>
</html>