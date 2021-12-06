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
		$snoerror = $qnserror = $opt1error = $opt2error = $opt3error = $opt4error = $answererror = "";
	 $s = 0; 
	 $qnsname = 1;
if(isset($_POST['submit']))
{
	$subname = $_SESSION["subjectname"];
	$year =  $_SESSION["year"];
	$faculty_name = $_SESSION["facultyname"];
		
		 $count = count($_POST['answer']);

                         for($sl = 1; $sl <= $count; $sl++)
                            {
                            	if($s <= $count)
                            	{
							if(!empty($_POST['answer']))
							{
						$deptname = mysqli_query($conn, "select dept from faculty where fname = '$faculty_name'");
						$deptdata = mysqli_fetch_array($deptname);
						$department_name = $deptdata['dept'];
						$sql1 = mysqli_query($conn,"select * from questions where subjectname = '$subname' and sno = $sl");
						$result = mysqli_fetch_array($sql1);
						$subjectname = $result['subjectname'];
						$sn = $result['sno'];
		
						$answer = strtolower($_POST['answer'][$s]);

						if($sn == $qnsname && $subjectname == $subname)
						{
							$sql1 = mysqli_query($conn, "update questions set quation = '{$_POST['quation'][$s]}', opt1 = '{$_POST['opt1'][$s]}', opt2 = '{$_POST['opt2'][$s]}', opt3 = '{$_POST['opt3'][$s]}', opt4 = '{$_POST['opt4'][$s]}', answer = '$answer', subjectname = '$subname', sno = {$_POST['sno'][$s]}, year = '$year', departname = '$department_name' where subjectname = '$subname' && sno = $sl");
							if(!$sql1){echo "<p class='text-center text-danger'>Sorry! Please Upload again</p>";}#else{echo " <h3 align=center class=text-success>Uploaded Successfully</h3>";}
							$qnsname++;
												}
												else{
															# insert data into database
							$sql = "INSERT INTO questions VALUES('{$_POST['quation'][$s]}','{$_POST['opt1'][$s]}','{$_POST['opt2'][$s]}','{$_POST['opt3'][$s]}','{$_POST['opt4'][$s]}','$answer','$subname',{$_POST['sno'][$s]}, '$year', '$department_name')";
								if(!$conn->query($sql)){}
								else{
									echo "Error in uploading";
								}
							}
							$s++;
							}
							else{ $answererror = "Answer should not be empty";}
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
			<div class="form-group">
				  <input type="text" class="form-control" placeholder="Option 1" name="opt1[]">
			</div>
			<p class="text-danger"><?php echo $opt1error;?></p>
			<div class="form-group">
				  <input type="text" class="form-control" placeholder="Option 2" name="opt2[]">
			</div>
			<p class="text-danger"><?php echo $opt2error;?></p>
   			<div class="form-group">
				  <input type="text" class="form-control" placeholder="Option 3" name="opt3[]">
			</div>
			<p class="text-danger"><?php echo $opt3error;?></p>
   			<div class="form-group">
				  <input type="text" class="form-control" placeholder="Option 4" name="opt4[]">
			</div>
			<p class="text-danger"><?php echo $opt4error;?></p>
			<div class="form-group">
				<label for="correctans">Answer</label>
				  <input type="text" class="form-control" id="correctans" name="answer[]" placeholder="Correct option like a, b, c, d">
			</div>
			<p class="text-danger"><?php echo $answererror;?></p>
			<div class="form-group">	
			</div>
	</div>
<?php }?>
	<input type="submit" class="btn btn-block btn-outline-primary" name="submit" value="Submit">
	</form>
	
</section>
</body>
</html>