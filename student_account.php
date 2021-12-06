<?php
session_start();
$rollnum = $_SESSION["rollnumber"];
$_SESSION["rollnumber"] = $_SESSION["rollnumber"];
include("db_connection.php");

$std = mysqli_query($conn,"select * from students where rollnum = '$rollnum'");
$result = mysqli_fetch_array($std);
$year = $result['year'];
$dept = $result['deptname'];
$name = $result['stdname'];

$sql2 = mysqli_query($conn , "select * from questions1 where year = '$year' and departname = '$dept' and sno = 1");
while ($row = mysqli_fetch_array($sql2)) {$subjects = $row['subjectname'];}

$sql3 = mysqli_query($conn , "select * from questions where year = '$year' and departname = 'TPO' and sno = 1");
while ($row1 = mysqli_fetch_array($sql3)) {$subjects1 = $row1['subjectname'];}

$subnameerror = $yearerror = "";
if(isset($_POST['submit']))
{
  $subname = $_POST['subject'];
  $fillblank = $_POST['fillblank'];
  $multiplechoice = $_POST['multiplechoice'];
  #$year = $_POST['year'];
  if(!empty($subname))
  {
    if($subname == $subjects)
    {
      $_SESSION["subjectname"] = $subname;
      header('location:displayqns.php');
    }
    else{
      $_SESSION["subjectname"] = $subname;
      header('location:display_qns.php');
    }
}
  else{
    $subnameerror = "Please enter your subject";
  }
}

# TPO qns

if(isset($_POST['submit']))
{
  $tpo = $_POST['tpo'];
  $subname1 = $_POST['subject'];

  if($subname1 == $subjects1) {
      $_SESSION["subjectname"] = $subname1;
      header('location:display_qns.php'); 
  }
  else{echo "subject not found";}

}



$rollnum = $_SESSION["rollnumber"];
$std = mysqli_query($conn,"select * from students where rollnum = '$rollnum'");
$result = mysqli_fetch_array($std);
$year = $result['year'];
$dept = $result['deptname'];
$name = $result['stdname'];

$subnameerror  = "";
if(isset($_POST['submitoption']))
{
 # $subname = $_POST['subject'];
  $resultway = $_POST['resultway'];
  #$year = $_POST['year'];
  
    if($resultway == "result")
      {
        $_SESSION["subjectname"] = $subname;
       $_SESSION["rollnumber"] = $rollnum;
      header('location:std_check_result.php');
      }
      else{
        $_SESSION["subjectname"] = $subname;
      $rollnum = $_SESSION["rollnumber"];
      header('location:std_check_result_ans.php');
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
		  counter-reset: section;
	}
   button[type='submit']{width: 100%;border-radius: 100px;background-image: linear-gradient(to left bottom,#ff00ff,#0099ff);transition: 1s;}
   button[type='submit']:hover{background-image: linear-gradient(to left bottom,#0099ff,#ff00ff);transition: 1s;}
   div ul{font-size: 20px;}
    .modal-content{border: none;border-radius: 10px;}
    .modal-content:before{content: '';position: absolute;top: -2px;bottom: -2px;left: -2px;right: -2px;z-index: -1;}
    .modal-content:after{content: '';position: absolute;top: -2px;bottom: -2px;left: -2px;right: -2px;z-index: -2;filter: blur(20px);}
    .modal-content:before,.modal-content:after{border-radius: 10px;background: linear-gradient(235deg, #89ff00, #060c21, #00bcd4)}
	p::before {
  			counter-increment: section;
  			content:  counter(section) ". ";
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
  	}}
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
              <a class="nav-link" href="" data-toggle="modal" data-target="#select_subject">Results Portal</a>
            </li>
			      <li class="nav-item">
			        <a class="nav-link" href="logout.php">Logout</a>
			      </li>
			    </ul>
			 </div>
		</nav>

<!-- Result-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="select_subject" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="mt-4 mb-3">
          <h3 class="modal-title text-center text-success">Select Subject</h3>
        </div>
        <div class="modal-body">
            <form action="" method="post">
      <div class="form-group">
          <h6 for="resultway">Your question paper relates to</h6>
           <select class="form-control" id="resultway" name="resultway" required>
              <option> </option>
              <option value="result">Multiple choice qns</option>
              <option value="result1">Fill in the blank qns</option>
           </select>
            
    </div>
  <button type="submit" class="btn text-white mt-4 mb-2" name="submitoption">Submit</button>
</form>
        </div>
      </div> 
    </div>
  </div>
</div>

<!--  -->
<div class="container mt-2 mb-4">
<h2 class="text-right mt-3">Welcome <?php echo "<span class='text-success'>$name</soan>"; ?> :)</h2>
</div>
<section class="container">
<h5 class="text-primary mb-3">Question papers<hr style="width: 50px;border-bottom: 1px solid lightgray;margin-left: 0px;margin-top: 10px;"></h5>
<?php
$sql = mysqli_query($conn , "select * from questions where year = '$year' and departname = '$dept' and sno = 1");
$sql1 = mysqli_query($conn , "select * from questions1 where year = '$year' and departname = '$dept' and sno = 1");
if($sql ->num_rows>0)
{
while ($row = mysqli_fetch_array($sql)) {
  $subject = $row['subjectname'];
  echo "<p><span class='text-danger'>$subject</span> question paper is available</p>";
}}
if($sql1 ->num_rows>0)
{
while ($row1 = mysqli_fetch_array($sql1)) {
  $subject1 = $row1['subjectname'];
 
  echo "<p><span class='text-danger'>$subject1</span> question paper is available</p>";
}
}
else{echo "<p>No question are available</p>";} 
?>
<!--  T & P question papers -->
<h5 class="text-primary mb-3">T & P Question papers<hr style="width: 50px;border-bottom: 1px solid lightgray;margin-left: 0px;margin-top: 10px;"></h5>
<?php
$sql2 = mysqli_query($conn , "select * from questions where year = '$year' and departname = 'TPO' and sno = 1");
if($sql2 ->num_rows>0)
{
while ($row2 = mysqli_fetch_array($sql2)) {
  $subject2 = $row2['subjectname'];
  echo "<p><span class='text-danger'>$subject2</span> question paper is available</p>";
}}
?>
</section>

  <!--  Student select subject -->

<section class="container mt-4">
  <form action="" method="post">
     <div class="form-group">
          <label for="subject" class="text-warning" style="text-indent: 30px;"><h4 class="mt-4">Choose Subject</h4></label>
           <select name="subject" class="form-control" id="opt">
             <option class='opt'></option>
        <?php 
        $sql = mysqli_query($conn , "select * from questions where year = '$year' and departname = '$dept' and sno = 1");
        $sql1 = mysqli_query($conn , "select * from questions1 where year = '$year' and departname = '$dept' and sno = 1");
      # Muliple choice qns
        if($sql ->num_rows>0)
          {
          while ($row = mysqli_fetch_array($sql)) {
            $subject = $row['subjectname'];
           ?>
           <?php
            echo "<option value='$subject' name='multiplechoice'>$subject</option>";
          }}
      # fill in the blank qns
          if($sql1 ->num_rows>0)
          {
          while ($row1 = mysqli_fetch_array($sql1)) {
            $subject1 = $row1['subjectname'];
           ?>
           
             <option value='<?php echo $subject1; ?>' name="fillblank"><?php echo $subject1; ?></option>
             <?php
          }}
          # TPO qns
          $sql2 = mysqli_query($conn , "select * from questions where year = '$year' and departname = 'TPO' and sno = 1");
          if($sql2 ->num_rows>0)
          {
          while ($row2 = mysqli_fetch_array($sql2)) {
            $subject2 = $row2['subjectname'];
            ?>
            
            <option value='<?php echo $subject2; ?>' name="tpo"><?php echo $subject2; ?></option>
            <?php
            }}

            ?>
           </select>
           <h6 class="text-danger"><?php echo $subnameerror;?></h6>     
        </div>
 <button type="submit" class="btn text-white mt-4 mb-2" name="submit">Submit</button>
</form>
</section>
</body>
</html>
