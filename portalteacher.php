<?php 
session_start();
    include 'server.php';
    if(isset($_SESSION["username"])){
     $_SESSION['username'];
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
                <h3 class="panel-title">General Overview</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-6">
                  <div class="well dash-box">
                    <?php 
                    $sql= "SELECT count(1) FROM students";
                        $result = mysqli_query($db, $sql);

                        while($row = mysqli_fetch_array($result)){

                          $total=$row[0];

                          ?>
                          <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span><?php echo " ".$total;?></h2>
                          <?php
                    }

                  ?>
                    
                    <h4>Total Students</h4>
                    
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="well dash-box">
                    <?php 
                    $sql= "SELECT count(1) FROM subjects";
                        $result = mysqli_query($db, $sql);

                        while($row = mysqli_fetch_array($result)){

                          $total=$row[0];

                          ?>
                          <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><?php echo " ".$total;?></h2>
                          <?php
                    }

                  ?>
                    <h4>Total Subjects</h4>
                  </div>
                </div>
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
