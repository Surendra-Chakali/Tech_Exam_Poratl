<?php
session_start();
$subject_name = $_SESSION["subjectname"];
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
        $score = 00;
        $rollnumber = $_SESSION["rollnumber"];
        $optionerror = ""; 

        $student_details = mysqli_query($conn, "select * from students where rollnum = '$rollnumber'");
        $details = $student_details -> fetch_array();
        $year = $details['year'];
        $dept = $details['deptname'];

        $sql1 = mysqli_query($conn,"select * from questions where subjectname = '$subject_name' and departname = 'TPO' and year = '$year'");
        $sql = mysqli_query($conn,"select * from questions where subjectname = '$subject_name' and departname = '$dept' and year = '$year'");
    if($sql ->num_rows>0)
    {
       while( $row = mysqli_fetch_array($sql))
       {
              $sn = $row['sno'];
              $qns = $row['quation']; 
              $subjectname = $row['subjectname'];
              $cans = $row['answer'];
              $opt = array();
              $qname = array();
              
            if(isset($_POST['submit']))
            { 
               for($s = 1; $s <= $sn; $s++)
               {
                if($s == $sn && $subject_name == $subjectname)
                {
                $qname[$s] = $qns;
                $canswer[$s] = $cans;
                $opt[$s] = $_POST['q'.$s];
                if(!empty($opt[$s]))
                {
                 if($opt[$s] == $canswer[$s])
                  {
                      $score++;

                    }
                 else{ $score; } 
                }
                else{
                # Showing error regarding not select option
                } } } } } }

  else if($sql1 ->num_rows>0)
    {
       while( $row1 = mysqli_fetch_array($sql1))
       {
              $sn = $row1['sno'];
              $qns = $row1['quation']; 
              $subjectname = $row1['subjectname'];
              $cans = $row1['answer'];
              $opt = array();
              $qname = array();
              
            if(isset($_POST['submit']))
            { 
               for($s = 1; $s <= $sn; $s++)
               {
                if($s == $sn && $subject_name == $subjectname)
                {
                $qname[$s] = $qns;
                $canswer[$s] = $cans;
                $opt[$s] = $_POST['q'.$s];
                if(!empty($opt[$s]))
                {
                 if($opt[$s] == $canswer[$s])
                  {
                      $score++;

                    }
                 else{ $score; } 
                }
                else{
                # Showing error regarding not select option
                } } } } } } 
              else{
                echo "<script>alert('Question paper not found');</script>";
              }

     #Store student result into database
          

                $students = mysqli_query($conn, "select * from students where rollnum = '$rollnumber'");
                while($row = mysqli_fetch_array($students))
                {
                  $rollnum = $row['rollnum'];
                  $name = $row['stdname'];
                  $year = $row['year'];
                  if(isset($_POST['submit']))
                  {
            $result = mysqli_query($conn, "select * from result where rollnumber = '$rollnumber' && subject = '$subject_name'");
            $data = array();
            $data = mysqli_fetch_array($result);
            $newrollnumber = $data['rollnumber'];
            $newsubject = $data['subject'];
                 
                  if($rollnumber == $newrollnumber && $subject_name == $newsubject)
                  {  
                  $sql1 = mysqli_query($conn, "update result set rollnumber = '$rollnum', stdname = '$name',score = $score,subject = '$subject_name',year = '$year' where rollnumber = '$rollnum' && subject = '$subject_name'");
                   if(!$sql1){echo "<h6 clas='text-center text-danger'>Sorry! Please submit again</h6>";}
                   else{ echo "Your data is updated";;}
                  }
                 else{
                 $sql = mysqli_query($conn, "insert into result values('$rollnum', '$name', $score, '$subject_name','$year')");
                   if(!$sql){echo "<h6 clas='text-center text-danger'>Sorry! Please submit again</h6>";}
                   else{ echo "Thanking you.";}
                    
                  }
                }
              }
?>

<!--  Showing questions-->
<div class="container mt-3">
<h2> <?php echo "<h1 class='text-center text-danger '>$subject_name</h1>"; ?></h2>
</div>

<form class="container" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

                  <?php
                   $n = 1;
                      for ($i = 1; $i == $n; $i++) { 
                        # code...
                      
                        $sql = mysqli_query($conn,"select * from questions where subjectname = '$subject_name' and sno = $i order bY sno asc");

                 if($sql -> num_rows >0)
                   {
                       while ($row = mysqli_fetch_array($sql))
                         {
                            $sn = $row['sno']; 
                            $qns = $row['quation']; 
                            $subjectname = $row['subjectname']; 
                            $opt1 = $row['opt1']; 
                            $opt2 = $row['opt2']; 
                            $opt3 = $row['opt3']; 
                            $opt4 = $row['opt4']; 
                            for($s = 1; $s <= $sn; $s++)
                            {
                                if($s == $sn && $subject_name == $subjectname)
                                {
                                  $_SESSION["list"] = $subjectname;
                                  print "<div class='jumbotron'>";
                                  print '<b>'.$sn.'. <span class = "ml-2">' .$qns.'</b><br>';
                                  print '<div class="form-check ml-3 mt-3"><label class="form-check-label"><input type="radio" class="form-check-input" name="q'.$sn.'" value="a" required> '.$opt1.'<br></label></div>';
                                  print '<div class="form-check ml-3 mt-1"><label class="form-check-label"><input type="radio" class="form-check-input" name="q'.$sn.'" value="b" required> '.$opt2.'<br></label></div>';
                                  print '<div class="form-check ml-3 mt-1"><label class="form-check-label"><input type="radio" class="form-check-input" name="q'.$sn.'" value="c" required> '.$opt3.'<br></label></div>';
                                  print '<div class="form-check ml-3 mt-1"><label class="form-check-label"><input type="radio" class="form-check-input" name="q'.$sn.'" value="d" required> '.$opt4.'<br></label></div>';
                                  print "</div>";

                                  
                                }   
                            }     
                          } 
                        }
                        else{echo "<h4 class='text-center text-danger mt-3'>No questions found</h4>";}   

                      }
                      $n++; 
                 ?>
   <input type='submit' class='btn btn-block btn-outline-primary mb-2' name='submit' value='Submit'>
      </form>

</body>
</html>
