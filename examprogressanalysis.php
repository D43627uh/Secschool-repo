<?php 
session_start();
    include 'server.php';

    if(isset($_SESSION["username"])){
       $_SESSION['username'];
    }

    if(isset($_SESSION["classes"])){
       $_SESSION['classes'];
    }
    if(isset($_SESSION["acyear"])){
       $_SESSION['acyear'];
    }
    if(isset($_SESSION["terms"])){
       $_SESSION['terms'];
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
              <a href="admin.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              
                <?php
              include'admin_exam_sidebar.php';
              ?>
              
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">
                  <?php
                  echo $_SESSION['classes']." | ".$_SESSION['acyear']." | ".$_SESSION['terms'];
                  ?>
                </h3>
              </div>
              <div class="panel-body">
                
                <div class="col-md-6">
                  <?php 
                  $s_username=$_SESSION['username'];
                  ?>
            <table class="table table-bordered">
              <tr>
                
                <th>Exam Name</th>
                <th>Mean</th>
                <th>Grade</th>
              </tr>
                      <?php
                      $sqlexam= "SELECT * FROM exams ";
                        $resultexam = mysqli_query($db, $sqlexam);

                        while($rowexam= mysqli_fetch_array($resultexam)){
                          $priority=$rowexam['priority'];
                          $examname=$rowexam['name'];

                         $sqlsum= "SELECT sum(marks) FROM exammarks WHERE class='".$_SESSION['classes']."' AND acyear='".$_SESSION['acyear']."' AND term='".$_SESSION['terms']."' AND exam='$priority'";
                        $resultsum = mysqli_query($db, $sqlsum);

                        while($rowsum= mysqli_fetch_array($resultsum)){
                          $totalmarks=$rowsum['sum(marks)'];

                          $sqlc= "SELECT count(1) FROM exammarks WHERE class='".$_SESSION['classes']."' AND acyear='".$_SESSION['acyear']."' AND term='".$_SESSION['terms']."' AND exam='$priority'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $genmarks=@($totalmarks/$count);
                          
                          include 'gengrading.php';
                        
                          ?>
                      <tr>
                        <td><?php echo $examname; ?></td>
                      <td><?php echo $genmarks; ?></td>
                      <td><?php echo $gengrade; ?></td>
                    </tr>
                    
                        <?php
                  }  
                  }
                }

              ?>

              
            </table>
                  
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
