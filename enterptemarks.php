<?php 
session_start();
    include 'server.php';

    if(isset($_SESSION["username"])){
       $_SESSION['username'];
    }

    if (isset($_POST['selectall'])) {
      # code...
      $classes=$_POST['classes'];
      $categories=$_POST['categories'];
      $terms=$_POST['terms'];
      $exams=$_POST['exams'];
      $subjects=$_POST['subjects'];
       $streams=$_POST['streams'];
        $acyear=$_POST['acyear'];

      $_SESSION['classes']=$classes;
      $_SESSION['categories']=$categories;
      $_SESSION['terms']=$terms;
      $_SESSION['exams']=$exams;
      $_SESSION['subjects']=$subjects;
      $_SESSION['streams']=$streams;
      $_SESSION['acyear']=$acyear;
      header("location: enterselectedptemarks.php");
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
               <!--<a href="addstudent.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"> Students</span> </a>-->
              <!--<a href="allexam.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Exam</span> </a>-->
              <a href="entermarks.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Enter General Marks</span> </a>
              <a href="enterptemarks.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Enter PTE Marks</span> </a>
              
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Enter PTE Marks</h3>
              </div>
              <br>
              <form method="post">

              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                <?php 
                  $sql= "SELECT * FROM classes";
                  $result = mysqli_query($db, $sql);
                  ?>
                  <select name="classes" class="form-control">
                    <option>--Select Class--</option>
                <?php while($row = mysqli_fetch_array($result)):;?>

                <option><?php echo $row['name'];?></option>

                <?php endwhile;?>

                  </select>
                        <?php

                  ?>
              </div>
                </div>
                
                 <div class="col-md-6">
                  <div class="form-group">
                <?php 
                  $sql= "SELECT * FROM exams";
                  $result = mysqli_query($db, $sql);
                  ?>
                  <select name="exams" class="form-control">
                    <option>--Select Exam Name--</option>
                <?php while($row = mysqli_fetch_array($result)):;?>

                <option><?php echo $row['name'];?></option>

                <?php endwhile;?>

                  </select>
                        <?php

                  ?>
              </div>
                </div>
              </div>

              <div class="row">

               
                <div class="col-md-6">
                  <div class="form-group">
                <?php 
                  $sql= "SELECT * FROM subjects";
                  $result = mysqli_query($db, $sql);
                  ?>
                  <select name="subjects" class="form-control">
                    <option>--Select Subject--</option>
                <?php while($row = mysqli_fetch_array($result)):;?>

                <option><?php echo $row['name'];?></option>

                <?php endwhile;?>

                  </select>
                        <?php

                  ?>
              </div>
                </div>
                 <div class="col-md-6">
                  <div class="form-group">
                <?php 
                  $sql= "SELECT * FROM academic";
                  $result = mysqli_query($db, $sql);
                  ?>
                  <select name="acyear" class="form-control">
                    <option>--Select Academic year--</option>
                <?php while($row = mysqli_fetch_array($result)):;?>

                <option><?php echo $row['acyear'];?></option>

                <?php endwhile;?>

                  </select>
                        <?php

                  ?>
              </div>
                </div>
              </div>      
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                <?php 
                  $sql= "SELECT * FROM category";
                  $result = mysqli_query($db, $sql);
                  ?>
                  <select name="categories" class="form-control">
                    <option>--Select Category--</option>
                <?php while($row = mysqli_fetch_array($result)):;?>

                <option><?php echo $row['name'];?></option>

                <?php endwhile;?>

                  </select>
                        <?php

                  ?>
              </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                <?php 
                  $sql= "SELECT * FROM streams";
                  $result = mysqli_query($db, $sql);
                  ?>
                  <select name="streams" class="form-control">
                    <option>--Select Stream--</option>
                <?php while($row = mysqli_fetch_array($result)):;?>

                <option><?php echo $row['name'];?></option>

                <?php endwhile;?>

                  </select>
                        <?php

                  ?>
              </div>
                </div>
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
