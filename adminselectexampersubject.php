<?php 
   session_start();
    include 'server.php';
    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    }
    if(isset($_SESSION["classes"])){
     $_SESSION['classes'];
   }
    if(isset($_SESSION["terms"])){
     $_SESSION['terms'];
    }
    if(isset($_SESSION["exams"])){
     $_SESSION['exams'];
    }
    if(isset($_SESSION["subjects"])){
     $_SESSION['subjects'];
    } 
    if(isset($_SESSION["acyear"])){
     $_SESSION['acyear'];
    } 
    if (isset($_POST['print'])) {
      header("location: generatePdf.php");
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
            <div class="panel">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">
                <?php
                echo $_SESSION['classes']." | ".$_SESSION['terms']." | ".$_SESSION['acyear']." | ".$_SESSION['subjects']."   |  ".$_SESSION['exams']." Exam";
                ?>
                </h3>
              </div>
              <br>
              <!--Test-->
              
              <!--End of Test-->
              <!--table from here-->
                 <table class="table table-bordered">

                  <tr>
                  <th>Position</th>
                  <th>Admission</th>
                  <th>Name</th>
                  <th><?php echo $_SESSION['subjects']; ?></th>
                  <th>Grade</th>
                  </tr>
                 <?php 
                  $s_class=$_SESSION['classes'];
                  $s_term=$_SESSION['terms'];
                  $s_acyear=$_SESSION['acyear'];
                  $s_exam=$_SESSION['exams'];
                  $s_subject=$_SESSION['subjects'];
                  
              //$sql1= "SELECT * FROM exammarks WHERE class='$s_class' AND term='$s_term' AND exam='$s_exam' AND subject='$s_subject'";
              //
              $sql1="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =marks,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := marks FROM exammarks p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  exam='$s_exam' AND  class='$s_class' AND term='$s_term' AND subject='$s_subject' AND acyear='$s_acyear' ORDER BY marks DESC) s";
              //
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      $indexnumber=$row1['indexnumber'];
                      $name=$row1['name'];
                      $marks=$row1['marks'];
                      $grade=$row1['grade'];
                      $rank=$row1['rank'];
                      ?>
                  <tr>
                      <td><?php echo $rank;?></td> 
                      <td><?php echo $indexnumber;?></td>             
                     <td><?php echo $name;?></td>
                      <td><?php echo $marks;?></td>
                      <td><?php echo $grade;?></td>
 
                     <?php
                    
                   }
                 }
                
                     ?>

                    </tr>

                    <tr>
                      <th>Total Score</th>
                      <?php
                      $sql1= "SELECT sum(marks) FROM exammarks WHERE exam='$s_exam' AND  class='$s_class' AND term='$s_term' AND subject='$s_subject' AND acyear='$s_acyear'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                       
                      $total=$row1['sum(marks)'];

                      //from here

                       $sqlc= "SELECT count(1) FROM exammarks WHERE  exam='$s_exam' AND  class='$s_class' AND term='$s_term' AND subject='$s_subject' AND acyear='$s_acyear'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $marks=@($total/$count);
                          include 'grading.php';
                          ?>
                      <th><?php echo $total; ?></th>
                      <tr>
                         <th>Mean</th>
                      <th><?php echo round($marks); ?></th>
                      </tr>

                      <tr>
                        <th>Grade</th>
                        <th>
                        <?php
                        if ($count==0) {
                          echo "_";
                        }
                        else
                        {
                          echo $grade;
                        }
                        ?>
                      </th>
                      
                      </tr>
                          <?php
                   }
                 
                   }
                 }
                      ?>
                    </tr>

                    
                 </table>
                 <!--End of table-->

                 <br>
                 <!--<form method="post">
                   <input type="submit" name="print" value="Export to PDF" class="btn btn-info">
                 </form>-->
              </div>
              </div>
              </div>
        </div>
    </section>

              <!--footer-->
               <footer id="footer">
      <p>Copyright &copy; <?php echo date("Y"); ?> </p>
    </footer>

          </div>
        </div>
      </div>
    </section>
    <!--to here-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>