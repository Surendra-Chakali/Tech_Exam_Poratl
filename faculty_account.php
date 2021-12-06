<?php
session_start();

$yearerror = $suberror = $nameErr ="";
if(isset($_POST['submit']))
{
  
  $selectyear = $_POST['year'];
  $no_of_qns = $_POST['uploadqns'];
  $subname = strtoupper($_POST['subject']);
  $conductExam = $_POST['conductExam'];
  $uploadpaper = $_POST['uploadpaper'];


  if(!empty($selectyear))
  {
    if(!empty($subname))
    {
      if (preg_match("/^[a-zA-Z ]*$/",$subname)) 
      {
        if ($conductExam == 'multiple' && $uploadpaper == 'webpage') 
        {
        $_SESSION["year"] = $selectyear;
        $_SESSION["subjectname"] = $subname;
        $_SESSION["no_of_qns"] = $no_of_qns;
          header('location:upload_qns1.php');
        }
        else if($conductExam == 'multiple' && $uploadpaper == 'exceel')
        {
          $_SESSION["year"] = $selectyear;
        $_SESSION["subjectname"] = $subname;
        $_SESSION["no_of_qns"] = $no_of_qns;
          header('location:upload_qns_excel1.php');
        }
        else if ($conductExam == 'fillblank' && $uploadpaper == 'webpage') 
        {
        $_SESSION["year"] = $selectyear;
        $_SESSION["subjectname"] = $subname;
        $_SESSION["no_of_qns"] = $no_of_qns;
          header('location:upload_qns.php');
        }
        else if($conductExam == 'fillblank' && $uploadpaper == 'exceel')
        {
          $_SESSION["year"] = $selectyear;
        $_SESSION["subjectname"] = $subname;
        $_SESSION["no_of_qns"] = $no_of_qns;
          header('location:upload_qns_excel.php');
        }   
  }
  else{$nameErr = "Only letters and white space allowed";}}
  else{$suberror = "Please select subject";}}
  else{$yearerror = "Plase select year";}}
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
          z-index: 1;
	     }
       p::before {
        counter-increment: section;
        content:  counter(section) ".  ";
        color: red;
      }
      
      .modal-content{border: none;border-radius: 10px;}
      .modal-content:before{content: '';position: absolute;top: -2px;bottom: -2px;left: -2px;right: -2px;z-index: -1;}
      .modal-content:after{content: '';position: absolute;top: -2px;bottom: -2px;left: -2px;right: -2px;z-index: -2;filter: blur(20px);}
      .modal-content:before,.modal-content:after{border-radius: 10px;background: linear-gradient(235deg, #89ff00, #060c21, #00bcd4);}
      
      div ul{font-size: 20px;}
      button[type='submit']{width: 100%;border-radius: 100px;background-image: linear-gradient(to left bottom,#ff00ff,#0099ff);transition: 1s;}
   button[type='submit']:hover{background-image: linear-gradient(to left bottom,#0099ff,#ff00ff);transition: 1s;}
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
			        <a class="nav-link" href="" data-toggle="modal" data-target="#select_subject">Upload Qns</a>
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

<!--Faculty select subject-->
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
                <label for="subject">Enter Subject Name</label>
                 <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject name" required>
                 <h6 class="text-danger"><?php echo $suberror;echo $nameErr;?></h6> 
          </div>
          <div class="form-group mt-2">
                <label for="conductExam">how do you conduct exam</label><br>
                 <input type="radio" id="conductExam" name="conductExam" value="multiple" onclick="qns()">&nbsp;Multiple choice qns 
                 <input type="radio" id="" name="conductExam" value="fillblank" onclick="optqns()">&nbsp;Fill the blank qns
          </div>
        <div class="form-group mt-2">
                <label for="uploadpaper">how do you upload question paper</label><br>
                 <input type="radio" id="uploadpaper" name="uploadpaper" value="webpage" onclick="qns1()">&nbsp;webpage
                 <input type="radio" id="" name="uploadpaper" value="exceel" onclick="optqns1()">&nbsp;exceel sheet
          </div>
          <div class="form-group mt-2" id="uploadqns">
                <label for="uploadqns">how many questions you wanna upload</label><br>
                 <input type="text" id="uploadqns" name="uploadqns" class="form-control">
          </div>

        <button type="submit" class="btn text-white mt-4 mb-2" name="submit">Submit</button>
      </form>
        </div>
      </div> 
    </div>
  </div>
</div>
<!--  -->
<div class="container mb-4" style="margin-top: 49px;">
<h2 class="text-right">Welcome <span class="text-success"><?php echo  $_SESSION["facultyname"]; ?> </span>:)</h2>
</div>
<section class="container">
	<p>Subject name that you choose to upload question paper is unique.</p>
  <p>Make sure that subject name should be in short form like WIT ,DAA ,CD,SAP</p>
  <p>You can conduct the exam through by multiple choice questions or by fill in the blanks</p>
  <p>You may upload question paper throught exceel sheet or through webpage</p>
  <p>You may check the results of stdents in the result section</p>

</section>
</body>
</html>
<script type="text/javascript">
  document.getElementById('uploadqns').style.display = 'none';

  function qns()
  {
    document.getElementById('uploadqns').style.display = 'block';
  }
  function qns1()
  {
    document.getElementById('uploadqns').style.display = 'block';
  }
  function optqns()
  {
    document.getElementById('uploadqns').style.display = 'none';
  }
  function optqns1()
  {
    document.getElementById('uploadqns').style.display = 'none';
  }
</script>