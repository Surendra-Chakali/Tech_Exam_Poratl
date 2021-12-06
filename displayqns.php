<?php
session_start();

include("db_connection.php");
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
    .jumbotron{box-shadow: 5px 5px 10px lightgray;background: white;transition: .4s;background: linear-gradient(340deg, #060c21, #00bcd4);color: white;}
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


<!--  Store results in db -->
    <?php
        
        $rollnumber = $_SESSION["rollnumber"];
        $subject_name = $_SESSION["subjectname"];

        $student_details = mysqli_query($conn, "select * from students where rollnum = '$rollnumber'");
        $details = $student_details -> fetch_array();
        $year = $details['year'];
        $dept = $details['deptname'];


        $sql = mysqli_query($conn,"select * from questions1 where subjectname = '$subject_name' and departname = '$dept' and year = '$year'");
   


                               #  Store student result into database
          if($sql ->num_rows>0)
          {
                $students = mysqli_query($conn, "select * from students where rollnum = '$rollnumber'");
                while($row = mysqli_fetch_array($students))
                {
                  $rollnum = $row['rollnum'];
                  $name = $row['stdname'];
                  $year = $row['year'];
                        
                  $result = mysqli_query($conn, "select * from result1 where rollnumber = '$rollnumber' && subject = '$subject_name' and year = $year");
                  $data = array();
                  
                  while($data = mysqli_fetch_array($result))
                  {
                    $newrollnumber = $data['rollnumber'];
                  $newsubject = $data['subject'];
                  }
                  
                       
                  $result1 = mysqli_query($conn,"select * from questions1 where subjectname = '$subject_name'");
                  $data1 = array();
                  $data1 = mysqli_fetch_array($result1);
                  $sn = $data1['sno']; 
                  $subjectname = $data1['subjectname']; 
                  $sno = 0; 
                  $qnsnum = 1;
                    if(isset($_POST['submit']))
                      {
                        $count = count($_POST['answer']);
                         for($s = 1; $s <= $count; $s++)
                            {
                              if($sno<=$count)
                              { 
                              if(!empty($_POST['answer']))
                                {

                $result2 = mysqli_query($conn,"select quation from questions1 where subjectname = '$subject_name' and year = $year and sno = $s");
                 $data2 = array();
                  $data2 = mysqli_fetch_array($result2);
                  $qns = $data2['quation'];
                  if($rollnumber == $newrollnumber && $subject_name == $newsubject && $s == $qnsnum)
                  {  
                  $sql1 = "update result1 set rollnumber = '$rollnum', sno = $s, question = '$qns', answer = '{$_POST['answer'][$sno]}', subject = '$subject_name', year = $year where rollnumber = '$rollnum' && subject = '$subject_name' && sno = $s";
                   if($conn->query($sql1)){
                      header('location:question_paper_submit.php');
                   }
                   else{echo "<h6 clas='text-center text-danger'>Sorry! Please submit again</h6>"; }
                   $qnsnum++;
                  }
                  else{

               $sql2 = "insert into result1 values('$rollnum',$s,'$qns','{$_POST['answer'][$sno]}','$subject_name',$year)";
                  if($conn->query($sql2)){header('location:question_paper_submit.php');}
                   else{ echo "<h4 class='text-danger mt-3 text-center'>Sorry!</h4>";}
                   
                 }
                 $sno++;
                  }
                  else{echo "<p class='text-warning text-center'>answers are not taken to store</p>";}
                  }
                }
                }
                }
              }
        else{
            header('location:sub_select_error.php');
          }             
?>

<!--  Showing questions-->
<div class="container mt-3">
<h2> <?php echo "<h1 class='text-center text-danger '>$subject_name</h1>"; ?></h2>
</div>

<form class="container" method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

              <?php
                        
                $sql = mysqli_query($conn,"select * from questions1 where subjectname = '$subject_name' order bY sno asc"); 
                 if($sql -> num_rows >0)
                   {
                       while ($row = mysqli_fetch_array($sql))
                         {
                            $sn = $row['sno']; 
                            $qns = $row['quation']; 
                            $subjectname = $row['subjectname']; 
                            
                            for($s = 1; $s <= $sn; $s++)
                            {
                                if($s == $sn && $subject_name == $subjectname)
                                {
                                  $_SESSION["list"] = $subjectname;
                                  print '<div class="jumbotron">';
                                 print '<b>'.$sn.'. <span class = "ml-2">' .$qns.'</b><br>';
                                  print "<input type='text' name='answer[]' class='form-control mt-3 ml-3' maxlength='150' placeholder='Answer not exceeded 150 characters' required>";
                                  print '</div>';
                                }
                              }
                          } 
                        }
                        else{echo "<h4 class='text-center text-danger mt-3'>No questions found</h4>";}    
                 ?>
     <input type='submit' class='btn btn-block btn-outline-primary mb-2' name='submit' value='Submit'>
      </form>
<!--
  <script type="text/javascript" src="js/query.js"></script>
  <script type="text/javascript" src="js/quiz.js"></script>

-->
</body>
</html>
