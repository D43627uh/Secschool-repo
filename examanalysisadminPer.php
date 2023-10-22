<?php 
   session_start();
    include 'server.php';
    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    }
    if(isset($_SESSION["classes"])){
     $_SESSION['classes'];
   }
   if(isset($_SESSION["streams"])){
     $_SESSION['streams'];
   }
    if(isset($_SESSION["terms"])){
     $_SESSION['terms'];
    }
    if(isset($_SESSION["exams"])){
     $_SESSION['exams'];
    }
     if(isset($_SESSION["acyear"])){
     $_SESSION['acyear'];
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
                echo $_SESSION['classes']." | ".$_SESSION['streams']." | ".$_SESSION['terms']." | ".$_SESSION['acyear']."   |  ".$_SESSION['exams']." Exam";
                ?>
                </h3>
              </div>
              <br>

                <!--End of table-->
                <table class="table table-bordered">
                  <tr>
                    <th>S/N</th>
                    <th>SUBJECT</th>
                    <th>ENTRY</th>
                    <th>A</th>
                    <th>A-</th>
                    <th>B+</th>
                    <th>B</th>
                    <th>B-</th>
                    <th>C+</th>
                    <th>C</th>
                    <th>C-</th>
                    <th>D+</th>
                    <th>D</th>
                    <th>D-</th>
                    <th>E</th>
                    <th>GRADE</th>
                  </tr>
                  
                    <?php
                    $s_username=$_SESSION['username'];
                  $s_class=$_SESSION['classes'];
                  $s_stream=$_SESSION['streams'];
                  $s_term=$_SESSION['terms'];
                  $s_exam=$_SESSION['exams'];
                  $s_acyear=$_SESSION['acyear'];
                  $counter = 1; 

                  $sql= "SELECT * FROM subjects";
              $result=mysqli_query($db,$sql);
                   
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $subjectname=$row['name'];

                      ?>
                      <tr>
                        <td><?php echo $counter; ?></td>
                      <td><?php echo $subjectname; ?></td>

                      
                        <?php
                        $counter++;
                         $sqlcount= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear'";
                        $resultcount= mysqli_query($db, $sqlcount);

                        while($rowcount = mysqli_fetch_array($resultcount)){

                          $total=$rowcount[0];
                          ?>
                          <td><?php echo $total; ?></td>
                          <td>  
                          <?php
                        $sqlcountA= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term'  AND exam='$s_exam' AND grade='A' AND acyear='$s_acyear'";
                        $resultcountA= mysqli_query($db, $sqlcountA);
                        while($rowcountA = mysqli_fetch_array($resultcountA)){
                          $totalA=$rowcountA[0];
                          echo $totalA;
                        }
                          ?>
                          </td>
                          <td>  
                          <?php
                        $sqlcountA= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term' AND  exam='$s_exam' AND grade='A-' AND acyear='$s_acyear'";
                        $resultcountA= mysqli_query($db, $sqlcountA);
                        while($rowcountA = mysqli_fetch_array($resultcountA)){
                          $totalA=$rowcountA[0];
                          echo $totalA;
                        }
                          ?>
                          </td>

                          <td>  
                          <?php
                        $sqlcountA= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term' AND  exam='$s_exam' AND grade='B+' AND acyear='$s_acyear'";
                        $resultcountA= mysqli_query($db, $sqlcountA);
                        while($rowcountA = mysqli_fetch_array($resultcountA)){
                          $totalA=$rowcountA[0];
                          echo $totalA;
                        }
                          ?>
                          </td>
                          <td>  
                          <?php
                        $sqlcountA= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term' AND  exam='$s_exam' AND grade='B' AND acyear='$s_acyear'";
                        $resultcountA= mysqli_query($db, $sqlcountA);
                        while($rowcountA = mysqli_fetch_array($resultcountA)){
                          $totalA=$rowcountA[0];
                          echo $totalA;
                        }
                          ?>
                          </td>
                          <td>  
                          <?php
                        $sqlcountA= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term' AND  exam='$s_exam' AND grade='B-' AND acyear='$s_acyear'";
                        $resultcountA= mysqli_query($db, $sqlcountA);
                        while($rowcountA = mysqli_fetch_array($resultcountA)){
                          $totalA=$rowcountA[0];
                          echo $totalA;
                        }
                          ?>
                          </td>
                          <td>  
                          <?php
                        $sqlcountA= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term' AND  exam='$s_exam' AND grade='C+' AND acyear='$s_acyear'";
                        $resultcountA= mysqli_query($db, $sqlcountA);
                        while($rowcountA = mysqli_fetch_array($resultcountA)){
                          $totalA=$rowcountA[0];
                          echo $totalA;
                        }
                          ?>
                          </td>
                          <td>  
                          <?php
                        $sqlcountA= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term' AND exam='$s_exam' AND grade='C' AND acyear='$s_acyear'";
                        $resultcountA= mysqli_query($db, $sqlcountA);
                        while($rowcountA = mysqli_fetch_array($resultcountA)){
                          $totalA=$rowcountA[0];
                          echo $totalA;
                        }
                          ?>
                          </td>
                          <td>  
                          <?php
                        $sqlcountA= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term' AND  exam='$s_exam' AND grade='C-' AND acyear='$s_acyear'";
                        $resultcountA= mysqli_query($db, $sqlcountA);
                        while($rowcountA = mysqli_fetch_array($resultcountA)){
                          $totalA=$rowcountA[0];
                          echo $totalA;
                        }
                          ?>
                          </td>
                          <td>  
                          <?php
                        $sqlcountA= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term' AND  exam='$s_exam' AND grade='D+' AND acyear='$s_acyear'";
                        $resultcountA= mysqli_query($db, $sqlcountA);
                        while($rowcountA = mysqli_fetch_array($resultcountA)){
                          $totalA=$rowcountA[0];
                          echo $totalA;
                        }
                          ?>
                          </td>
                         <td>  
                          <?php
                        $sqlcountA= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term' AND  exam='$s_exam' AND grade='D' AND acyear='$s_acyear'";
                        $resultcountA= mysqli_query($db, $sqlcountA);
                        while($rowcountA = mysqli_fetch_array($resultcountA)){
                          $totalA=$rowcountA[0];
                          echo $totalA;
                        }
                          ?>
                          </td>
                          <td>  
                          <?php
                        $sqlcountA= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term' AND  exam='$s_exam' AND grade='D-' AND acyear='$s_acyear'";
                        $resultcountA= mysqli_query($db, $sqlcountA);
                        while($rowcountA = mysqli_fetch_array($resultcountA)){
                          $totalA=$rowcountA[0];
                          echo $totalA;
                        }
                          ?>
                          </td>
                          <td>  
                          <?php
                        $sqlcountA= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND stream='$s_stream' AND term='$s_term' AND  exam='$s_exam' AND grade='E' AND acyear='$s_acyear'";
                        $resultcountA= mysqli_query($db, $sqlcountA);
                        while($rowcountA = mysqli_fetch_array($resultcountA)){
                          $totalA=$rowcountA[0];
                          echo $totalA;
                        }
                          ?>
                          </td>
                          
                          <?php
                          $sql1= "SELECT sum(marks) FROM exammarks WHERE  exam='$s_exam' AND  class='$s_class' AND stream='$s_stream' AND term='$s_term' AND subject='$subjectname' AND acyear='$s_acyear'";
                        $result1=mysqli_query($db,$sql1);

                        if (mysqli_num_rows($result1)!=0) {
                             
                            while ($row1=mysqli_fetch_assoc($result1)) {
                      
                       
                      $marks=$row1['sum(marks)'];

                      //from here

                       $sqlc= "SELECT count(1) FROM exammarks WHERE  exam='$s_exam' AND  class='$s_class' AND stream='$s_stream' AND term='$s_term' AND subject='$subjectname' AND acyear='$s_acyear'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $marks=@($marks/$count);
                          include 'grading.php';
                         if ($count==0) {
                            ?>
                      <td><?php echo "_"; ?></td>
                      </tr>
                      <?php
                         }else{
                           ?>
                      <td><?php echo $grade; ?></td>
                      </tr>
                      <?php
                         }
                   }

                 
                   }
                 }
                         
                        
                     
                    }

                    }
                  
                      ?>
                  
                </table>
                 
              <!--End of table-->
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