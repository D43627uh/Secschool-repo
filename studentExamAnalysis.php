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
              <a href="portalstudent.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              
              
              <a href="viewexam.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Examination</span> </a>
              <a href="studentExamAnalysis.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Exam Analysis</span> </a>
              <!--<a href="portalstudentfinance.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> Finance</span> </a>-->
              <a href="passwordstudent.php" class="list-group-item"><span class="glyphicon glyphicon-edit" aria-hidden="true"> Change Password</span> </a>
              
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Exam Analysis</h3>
              </div>
              <div class="panel-body">
                
                <div class="col-md-6">
                  <?php 
                  $s_username=$_SESSION['username'];
                  ?>
            <table class="table table-bordered">
              <tr>
                <th>Position</th>
                <th>Class</th>
                <th>Term</th>
                <th>Exam Name</th>
                <th>Total Marks</th>
                <th>Mean</th>
                <th>Grade</th>
              </tr>
              <?php
              
              $sqlpos="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM positioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE indexnumber='$s_username'  ORDER BY total DESC) s";
                   
              $resultpos=mysqli_query($db,$sqlpos);
                  while ($rowpos=mysqli_fetch_assoc($resultpos)) {
                      
                      $indexnumber=$rowpos['indexnumber'];
                      $class=$rowpos['class'];
                      $term=$rowpos['term'];
                      $exam=$rowpos['exam'];
                      $total=$rowpos['total'];
                      $rank=$rowpos['rank'];
                     
                      ?>
              
              <tr>  
                <td>
                  <?php

        $sql="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM positioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE exam='$exam' AND  class='$class' ORDER BY total DESC) s";

  $records=mysqli_query($db,$sql);
   while ($row=mysqli_fetch_array($records)) {
    $indexnumber=$row['indexnumber'];
    $ranks=$row['rank'];
     if ($indexnumber==$s_username) {
     
    echo $ranks;
  }
}
  
                  ?>
                </td>
                      <td><?php echo $class; ?></td>
                      <td><?php echo $term; ?></td>
                      <td>
                      <?php
                         $sqlc= "SELECT * FROM exams WHERE priority='$exam'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){
                          $examname=$rowc['name'];
                          echo $examname;
                        }
                          ?>
                      </td>
                      <td><?php echo $total; ?></td>
                      <td>
                        <?php

                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$s_username' AND class='$class'  AND exam='$exam'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $marks=$total/$count;
                          include 'grading.php';
                          echo $marks;
                   }
                   //from here
                   
                   //to here
                   ?>
                      </td>
                      <td><?php echo $grade; ?></td>
                      <?php
                  }
                
              ?>
              </tr>
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
