<?php 
   session_start();
    include 'server.php';
    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    }
    if(isset($_SESSION["classes"])){
     $_SESSION['classes'];
   }
    if(isset($_SESSION["categories"])){
     $_SESSION['categories'];
    }
    if(isset($_SESSION["exams"])){
     $_SESSION['exams'];
    } 
    if (isset($_POST['selectall'])) {
      header("location: adminselectallpteexamPDF.php");
     
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
          <!--<div class="col-md-3">
            <div class="list-group">
              <a href="admin.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="selectallexamadmin.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> View All <span class="badge"></span></a>
              <a href="selectspecificadmin.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> View Per Subject <span class="badge"></span></a>
              <br>
              
            </div>

          </div>-->
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">
                <?php
                echo $_SESSION['classes']." | ".$_SESSION['categories']."   |  ".$_SESSION['exams']." Exam";
                ?>
                </h3>
              </div>
              <br>
              <!--table from here-->

                 <table class="table table-bordered">
                  <tr>
                  <th>Adm</th>
                  <th>Name</th>
                  <th>Education</th>
                  <th>English</th>
                  <th>Kiswahili</th>
                  <th>P.E</th>
                  <th>Mathematics</th>
                  <th>I.Science</th>
                  <th>CRE</th>
                  <th>IRE</th>
                  <th>S/Studies</th>
                  <th>C/Art</th>
                  <th>ICT</th>
                  <th>Total Points</th>
                  <th>Grade</th>
                  </tr>

                 <?php 
                  $s_class=$_SESSION['classes'];
                  $s_category=$_SESSION['categories'];
                  $s_exam=$_SESSION['exams'];      

            $sqlpos="SELECT * FROM students WHERE  category='$s_category' AND  class='$s_class'";
                   
              $resultpos=mysqli_query($db,$sqlpos);

              if (mysqli_num_rows($resultpos)!=0) {
                   
                  while ($rowpos=mysqli_fetch_assoc($resultpos)) {
                      
                      
                      $id=$rowpos['id'];
                      $name=$rowpos['name'];
                      $indexnumber=$rowpos['indexnumber'];
                      $class=$rowpos['class'];
            
              ?>
                   
                     <tr> 
                    <td><?php echo $indexnumber;?></td>             
                    <td><?php echo $name;?></td>
                    <td>
                      <?php
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Education'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          echo $points;

        }
                      ?>
                    </td>
                    <td>
                      <?php
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='English'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          echo $points;

        }
        ?>
                    </td>
                    <td>
                       <?php
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Kiswahili'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          echo $points;

        }
        ?>
                    </td>
                   
                    <td>
                       <?php
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Physical Education'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          echo $points;

        }
        ?>
                    </td>
                     <td>
                       <?php
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Mathematics'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          echo $points;

        }
        ?>
                    </td>
                <td>
                   <?php
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Integrated Science'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          echo $points;

        }
        ?>
                </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='CRE'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          echo $points;

        }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='IRE'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
         $points=$rowmarks['points'];
          echo $points;

        }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Social Studies'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          echo $points;

        }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Creative Art'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          echo $points;

        }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='ICT'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          echo $points;

        }
        ?>
                 </td>
                     <?php

                       $sqlsum= "SELECT sum(points) FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class'";
                        $resultsum = mysqli_query($db, $sqlsum);

                        while($rowsum= mysqli_fetch_array($resultsum)){

                          $tgrade=$rowsum['sum(points)'];
                         if ($tgrade >=1 && $tgrade <=22) {
                            $grade="Distinction";
                          }
                          else if ($tgrade >=23 && $tgrade <50) {
                            $grade="Credit";
                          }
                           else if ($tgrade >=50 && $tgrade <69) {
                            $grade="Pass";
                          }
                          else if ($tgrade >=69 && $tgrade <=100) {
                            $grade="Fail";
                          }
                          else{
                            $grade="_";
                          }
                      }

                 ?>

                  <td style="font-weight: 900;"><?php echo $tgrade;?></td>
                  <td style="font-weight: 900;"><?php echo $grade;?></td>
                 </tr>
                 <?php
                
               }
             }
                     ?> 
                 </table>
                   <!--End of table-->
              </div>
              </div>
              </div>
              <a href="selectallexamadmin.php">GO BACK</a>
               <div>
                <br>
              </div>
              <form method="post">
                <input type="submit" value="Export to PDF" name="selectall" class="btn btn-info">
              </form>
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