<?php 
session_start();
    include 'server.php';

    if(isset($_SESSION["username"])){
       $_SESSION['username'];
       //$username=$_SESSION['username'];
    }

    if (isset($_POST['selectall'])) {
      # code...
      $username=$_POST['username'];
        
        $sql1= "SELECT * FROM headteachers WHERE username='$username'";
        $result1=mysqli_query($db,$sql1);

        if (mysqli_num_rows($result1)<1) {
          while ($row1=mysqli_fetch_assoc($result1)) {

            $message = "You are not assigned to this subject";
            echo "<script type='text/javascript'>alert('$message');</script>";

      
    }
  }else if (mysqli_num_rows($result1)>0) {
      header("location: headteacherremarks.php");
  }
    }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Area | Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <!--from here-->
     <nav class="navbar navbar-default">
      <div class="container">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Admin</a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome <?php echo $_SESSION['username'];?></a></li>
            <li><a href="index.php">Logout</a></li>
          </ul>
        </div>

      </div>
    </nav>
   
    

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="portalteacher.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
             <?php
              include'portalteacher_sidebar.php';
              ?>
              
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Teacher Remarks</h3>
              </div>
              <br>
              <form method="post">

              <div class="form-group">
            <label>Enter Username</label>
            <input type="text" name="username" class="form-control">
          </div>
                       
                   
                     
                <input type="submit" name="selectall" value="Enter Selected" class="btn btn-info">
              </form>
               
                </div>
              </div>
              </div>
              </div>
        </div>
    </section>

              <!--footer-->
               <footer id="footer">
      <p>Copyright &copy; <?php echo date("Y"); ?> </p>
    </footer>
              <!--footer to here-->
          </div>
        </div>
      </div>
    </section>
    <!--to here-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
