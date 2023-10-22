<?php 
   session_start();
    include 'server.php';
    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    }
    if (isset($_POST['promote'])) {

      $classfrom=$_POST['classfrom'];
      $classto=$_POST['classto'];

              $sql = "UPDATE students SET class='$classto'
                  WHERE class='$classfrom' ";
              mysqli_query($db,$sql);
            header("location: promote.php");
          
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
            <li class="active"><a href="admin.php">Dashboard</a></li>
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
    <!--to here-->

    <!--from here-->
     <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <small> Manage Account</small></h1>
          </div>
          
        </div>
      </div>
    </header>
    

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="admin.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <?php
             include'admin_sidebar.php';
             ?>
              
            </div>

          </div>
          <center>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Promote to next class</h3>
              </div>
              <form method="post">
              <div class="panel-body">
                <div class="col-md-2">
                  FROM :
                </div>
                <div class="col-md-4">
                   <div class="form-group">
                <?php 
                    $sql= "SELECT * FROM classes";
                        $result = mysqli_query($db, $sql);
                        ?>
                        <select name="classfrom" class="form-control">

                      <?php while($row = mysqli_fetch_array($result)):;?>

                      <option><?php echo $row['name'];?></option>

                      <?php endwhile;?>

                  </select>
                        <?php

                  ?>
              </div>
                </div>
                <div class="col-md-2">
                  TO :
                </div>
                <div class="col-md-4">
                   <div class="form-group">
                <?php 
                    $sql= "SELECT * FROM classes";
                        $result = mysqli_query($db, $sql);
                        ?>
                        <select name="classto" class="form-control">

                      <?php while($row = mysqli_fetch_array($result)):;?>

                      <option><?php echo $row['name'];?></option>

                      <?php endwhile;?>

                  </select>
                        <?php

                  ?>
              </div>
                </div>
                </div>
                <input type="submit" name="promote" value="Promote" class="btn btn-info">
                <div><br></div>
                </form>
                NOTE: Start with the leading class i.e Form Four
                <div><br></div>
              </div>
              </div>
              </center>
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
