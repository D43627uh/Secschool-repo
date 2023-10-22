<?php 
   session_start();
    include 'server.php';
    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    } 

    if (isset($_POST['selectall'])) {
      # code...
      $classes=$_POST['classes'];
      $terms=$_POST['terms'];
      $exams=$_POST['exams'];
      $subjects=$_POST['subjects'];
       $streams=$_POST['streams'];
       $acyear=$_POST['acyear'];
       
        $_SESSION['classes']=$classes;
      $_SESSION['terms']=$terms;
      $_SESSION['exams']=$exams;
      $_SESSION['subjects']=$subjects;
      $_SESSION['streams']=$streams;
      $_SESSION['acyear']=$acyear;
      header("location: adminselectallexamPer.php");
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
            <li><a href="students.php">Students</a></li>
            <li><a href="teachers.php">Teachers</a></li>
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
              <a href="admin.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <?php
              include'admin_exam_sidebar.php';
              ?>
            </div>

          </div>
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Exam Results</h3>
              </div>
              <br>

              <form method="post">
                <?php
                $sqlsubj= "SELECT * FROM subjects";
              $resultsubj=mysqli_query($db,$sqlsubj);

              if (mysqli_num_rows($resultsubj)!=0) {
                  
                  while ($rowsubj=mysqli_fetch_assoc($resultsubj)) {
                      
                      $id=$rowsubj['id'];
                     $subjectname=$rowsubj['name'];
                      ?>
                        <input type="hidden" name="subjects" value="<?php echo $subjectname;?>">
                   <?php
                  }
                }
                ?>

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
                  $sql= "SELECT * FROM academic";
                  $result = mysqli_query($db, $sql);
                  ?>
                  <select name="acyear" class="form-control">
                    <option>--Select Academic Year--</option>
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
                  $sql= "SELECT * FROM exams";
                  $result = mysqli_query($db, $sql);
                  ?>
                  <select name="exams" class="form-control">
                    <option>--Select Exam Name--</option>
                <?php while($row = mysqli_fetch_array($result)):;?>

                <option><?php echo $row['priority'];?></option>

                <?php endwhile;?>

                  </select>
                        <?php

                  ?>
              </div>
                </div>
               <div class="col-md-6">
                  <div class="form-group">
                <?php 
                  $sql= "SELECT * FROM terms";
                  $result = mysqli_query($db, $sql);
                  ?>
                  <select name="terms" class="form-control">
                    <option>--Select Term--</option>
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
                <input type="submit" name="selectall" value="Select" class="btn btn-info">
              </form>
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

    <!-- Add Class -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Term</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
      <label>Enter the term</label><input type="text" name="name" class="form-control">
    </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="save" class="btn btn-primary">Save</button>
      </div>

    </form>
    </div>
  </div>
</div>
<!--End of modal-->

          </div>
        </div>
      </div>
    </section>
    <!--to here-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
