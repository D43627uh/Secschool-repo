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
    if(isset($_SESSION["acyear"])){
     $_SESSION['acyear'];
    } 
    if (isset($_POST['selectall'])) {   

      header("location: adminselectallexamPDFsecond.php");
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
                echo $_SESSION['classes']." | ".$_SESSION['categories']."   |  ".$_SESSION['acyear']."   |  ".$_SESSION['exams']." Exam";
                ?>
                </h3>
              </div>
              <br>
              <!--table from here-->

                 <table class="table table-bordered">
                  <tr>
                  <th>Pos</th>
                  <th>Adm</th>
                  <th>Name</th>
                  <th>Education</th>
                  <th>English</th>
                  <th>Kiswahili</th>
                  <th>P.E</th>
                  <th>Mathematics</th>
                  <th>Science</th>
                  <th>CRE</th>
                  <th>IRE</th>
                  <th>S/Studies</th>
                  <th>C/Art</th>
                  <th>ICT</th>
                  <th>Agriculure</th>
                  <th>Home/S</th>
                  <th>Music</th>
                  <th>Total</th>
                  <th>Points</th>
                  <th>Grade</th>
                  </tr>

                 <?php 
                  $s_class=$_SESSION['classes'];
                  $s_category=$_SESSION['categories'];
                  $s_exam=$_SESSION['exams'];      

            $sqlpos="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM positioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE category='$s_category' AND exam='$s_exam' AND  class='$s_class' ORDER BY total DESC) s";
                   
              $resultpos=mysqli_query($db,$sqlpos);

              if (mysqli_num_rows($resultpos)!=0) {
                   
                  while ($rowpos=mysqli_fetch_assoc($resultpos)) {
                      
                      
                      $id=$rowpos['id'];
                      $name=$rowpos['name'];
                      $indexnumber=$rowpos['indexnumber'];
                      $class=$rowpos['class'];
                      $total=$rowpos['total'];
                      $rank=$rowpos['rank'];
            
              ?>
                   
                     <tr> 
                    <td><?php echo $rank;?></td> 
                    <td><?php echo $indexnumber;?></td>             
                    <td><?php echo $name;?></td>
                    <td>
                      <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Education'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
                      ?>
                    </td>
                    <td>
                      <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='English'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                    </td>
                    <td>
                       <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Kiswahili'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                    </td>
                   
                    <td>
                       <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Physical Education'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                    </td>
                     <td>
                       <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Mathematics'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                    </td>
                <td>
                   <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Science'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='CRE'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='IRE'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Social Studies'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Creative Art'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='ICT'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Agriculture'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Home Science'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='Music'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          echo $marks;

        }
        ?>
                 </td>
                     <?php
                 //count from here

                    /* $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $mean=$total/$count;
                         if ($mean >=80 && $mean <=100) {
                            $grade="1";
                          }
                          else if ($mean >=76 && $mean <80) {
                            $grade="2";
                          }
                           else if ($mean >=70 && $mean <76) {
                            $grade="3";
                          }
                          else if ($mean >=60 && $mean <70) {
                            $grade="4";
                          }
                          else if ($mean >=50 && $mean <60) {
                            $grade="5";
                          }
                          else if ($mean>=40 && $mean <50) {
                            $grade="6";
                          }
                          else if ($mean >=30 && $mean <40) {
                            $grade="7";
                          }
                          else if ($mean >=0 && $mean <30) {
                            $grade="8";
                          }

                      }*/
                       $sqlsum= "SELECT sum(grade) FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class'";
                        $resultsum = mysqli_query($db, $sqlsum);

                        while($rowsum= mysqli_fetch_array($resultsum)){

                          $totalgrade=$rowsum['sum(grade)'];
                         
                      }
                      //sum grade
                       $sqlsum= "SELECT sum(grade) FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class'";
                        $resultsum = mysqli_query($db, $sqlsum);

                        while($rowsum= mysqli_fetch_array($resultsum)){

                          $tgrade=$rowsum['sum(grade)'];
                         if ($tgrade >=0 && $tgrade <=20) {
                            $tgrade="Distinction";
                          }
                          else if ($tgrade >=26 && $tgrade <40) {
                            $tgrade="Credit";
                          }
                           else if ($tgrade >=41 && $tgrade <60) {
                            $tgrade="Pass";
                          }
                          else if ($tgrade >=61 && $tgrade <=100) {
                            $tgrade="Fail";
                          }
                      }

                 ?>

                  <td style="font-weight: 900;"><?php echo $total;?></td>
                  <!--<td style="font-weight: 900;"><?php //echo $mean;?></td>-->
                  <td style="font-weight: 900;"><?php echo $totalgrade;?></td>
                  <td style="font-weight: 900;"><?php echo $tgrade;?></td>
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