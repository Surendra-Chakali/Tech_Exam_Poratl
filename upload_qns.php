<?php
session_start();
include("db_connection.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Uploading Question paper</title>
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
		$snoerror = $qnserror = "";
	 $s = 0; 
	 $qnsnum = 1;
if(isset($_POST['submit']))
{
	$sno = $_POST['sno'];
	$qns1 = $_POST['quation'];
	
	$subname = $_SESSION["subjectname"];
	$year =  $_SESSION["year"];
	$faculty_name = $_SESSION["facultyname"];

	$count = count($_POST['quation']);

	for($sl = 1; $sl <= $count; $sl++)
        {
          if($s <= $count)
             {

		if(!empty($sno))
		{
		if(!empty($qns1))
		{
			
	$deptname = mysqli_query($conn, "select dept from faculty where fname = '$faculty_name'");
	$deptdata = mysqli_fetch_array($deptname);
	$department_name = $deptdata['dept'];
		$sql1 = mysqli_query($conn,"select * from questions1 where subjectname = '$subname' and sno = $sl");
		$result = mysqli_fetch_array($sql1);
		$subjectname = $result['subjectname'];
		$sn = $result['sno'];

						if($sn == $qnsnum && $subjectname == $subname)
						{
							$sql1 = mysqli_query($conn, "update questions1 set quation = '{$_POST['quation'][$s]}', subjectname = '$subname', sno = {$_POST['sno'][$s]}, year = '$year', departname = '$department_name' where subjectname = '$subname' && sno = $sl");
							if(!$sql1){echo "<p class='text-center text-danger'>Sorry! Please Upload again</p>";} #else{echo " <h3 align=center class=text-success>Uploaded Successfully</h3>";}
						$qnsnum++;
						}
						else{
									# insert data into database
								$sql = "INSERT INTO questions1 VALUES('{$_POST['quation'][$s]}','$subname',{$_POST['sno'][$s]}, '$year', '$department_name')";
								if($conn->query($sql))
								{
									
								}
								else{
									echo "Error in uploading";
								}
							}
							$s++;							
						}
						else{$qnserror = "Question name should not be empty.";}
					}
					else{$snoerror = "sno should not be empty.";}
				}
			}
			echo " <h3 align=center class=text-success>Uploaded Successfully</h3>";
				}
?>


<section class="container mt-4 mb-2">
	<div class="text-center text-info"><h2>Upload Question paper</h2></div>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<?php
		 for($s = 1; $s <= $_SESSION["no_of_qns"]; $s++){
		 	?>
	<div class="jumbotron">
			<div class="form-group">
				<label for="sno">Sno</label>
				  <input type="text" class="form-control" id="sno" name="sno[]" placeholder="Question Number">
			</div>
			<p class="text-danger"><?php echo $snoerror;?></p>
			<div class="form-group">
				  <label for="q<?php echo $s;?>">Question </label>
				  <input type="text" class="form-control" placeholder="Enter question" id="q<?php echo $s;?>" name="quation[]">
			</div>
			<p class="text-danger"><?php echo $qnserror;?></p>	
	</div>
	<?php }?>
	<input type="submit" class="btn btn-block btn-outline-primary" name="submit" value="Submit">
	</form>
	
</section>
</body>
</html>