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
  body:before{content: '';position: absolute;width: 100%;height: 200%;background-image: url('images/clg.jpeg');background-position: center center;filter: blur(7px);background-size: 100% 100%;}
      #imgblock{width: 400px;height: auto;overflow: hidden;position: relative;transition: .4s;box-shadow: 1px 1px 4px lightgray;}
      #imgblock:hover{box-shadow: 2px 2px 6px 5px lightgray;transition: .4s;}
      .block{display: flex;flex-wrap: wrap;justify-content: space-around;margin-top: 50px;}
      #img{height: 400px;overflow: hidden;}
      #imghover{transition: 1s;}
      #imghover:hover{height: 105%; transition: 1s;}
      #cse{font-size: 30px;}
      ul li a{font-size: 20px;color: black;}

  		
    @media only screen and (min-width: 612px){
      nav h1{
      display: none;
    }
    div ul li a:hover{
      border-bottom: 1px solid red;
    } }
  	
  	@media only screen and (max-width: 611px)
    {  	
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
      #cse{
        font-size: 23px;
      }
      body:before{
    content: '';
    position: absolute;
    width: 100%;
    
    background-image: url('images/clg.jpeg');
    background-position: center center;
    filter: blur(7px);
    background-size: 100% 100%;
  }

  	}
  </style>
</head>
<body>
<div id="background"></div>
<nav class="navbar navbar-expand-md">
      <!-- Brand -->
      <a class="navbar-brand" href="index.html"><img src="images/teclogo.jpg" class="brand" width="100px"></a>
      <h2 class="" style="color: red;">Tadipatri Engineering College</h2>
     <h1 class="" style="color: red;">TECH</h1>
      <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" style="outline: none;" type="button" data-toggle="collapse" data-target="#navigation">
    <span class=""><hr style="width: 30px;border:1px solid red;margin-bottom: -9px;border-radius: 10px;"></span>
    <span class=""><hr style="width: 20px;border:1px solid green;margin-bottom: -9px;border-radius: 10px;"></span>
    <span class=""><hr style="width: 30px;border:1px solid blue;border-radius: 30%;"></span>
      </button>

      <!-- Navbar links -->
       <div class="collapse navbar-collapse justify-content-end align-items-center" id="navigation">
          <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="faculty_login.php">Faculty Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="student_login.php">Student Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="developers.php">Developer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="show_feedback.php">Feedback</a>
            </li>
          </ul>
       </div>
  </nav>



<!--  Showing questions-->
<div class="container mt-3">
<div class="text-center mb-4" style="position: relative;"><p>Department of</p><h5 id="cse" class="text-success font-weight-bolder">Computer Science & Engineering</h5></div>
<section class="block">
<div id="imgblock" class="mb-4 text-white">
  <div id="img">
    <img src="images/Mr.Nagesh.jpeg" width="100%" height="100%" id="imghover">
  </div>
  <div class="text-center mt-4">
    <h4 class="font-weight-bold">C Nagesh</h4>
    <small>HOD of CSE</small>
    <h5>Co-ordinator</h5>
  </div>
</div>

<div id="imgblock" class="mb-4 text-white">
  <div id="img">
    <img src="images/developer.jpeg" width="100%" height="100%" id="imghover">
  </div>
  <div class="text-center mt-4">
    <h4 class="font-weight-bold">C Surendra</h4>
    <small>Student</small>
    <h5>Developer</h5>
  </div>
</div>

</section>
</div>
</body>
</html>
