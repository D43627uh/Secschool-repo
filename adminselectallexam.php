<?php
   session_start();
    include 'server.php';
    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    }
    if(isset($_SESSION["classes"])){
     $_SESSION['classes'];
   }
    
    if(isset($_SESSION["exams"])){
     $_SESSION['exams'];
    }
    if(isset($_SESSION["acyear"])){
     $_SESSION['acyear'];
    }
    if(isset($_SESSION["terms"])){
     $_SESSION['terms'];
    } 
 
     /*if (isset($_POST['selectall'])) {
      header("location: adminselectallexamPDF.php");
     
    }*/
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
            <li><a href="">Welcome <?php echo $_SESSION['username'];?></a></li>
            <li><a href="index.php">Logout</a></li>
          </ul>
        </div>

      </div>
    </nav>
    
    

    <section id="main">
      <div class="container">
        <div class="row">
         
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">
                <?php
                echo $_SESSION['classes']." | ".$_SESSION['terms']." | ".$_SESSION['acyear']."   |  ".$_SESSION['exams']." Exam";
                ?>
                </h3>
              </div>
              <br>
              <!--table from here-->

                 <table class="table table-bordered">
                  <tr>
                  <th>Pos</th>
                  <th>Pos/Class</th>
                  <th>Adm</th>
                  <th width="200px">Name</th>
                  <th>KCPE</th>
                  <th>Mathematics</th>
                  <th>English</th>
                  <th>Kiswahili</th>
                  <th>Physics</th>
                  <th>Chemistry</th>
                  <th>Biology</th>
                  <th>Business Studies</th>
                  <th>Agriculture</th>
                  <th>History</th>
                  <th>C.R.E</th>
                  <th>Geography</th>
                  <th>Total</th>
                  <th>Mean</th>
                  <th>Grade</th>
                  </tr>
 
                 <?php 
                  $s_class=$_SESSION['classes'];
                  $s_term=$_SESSION['terms'];
                  $s_exam=$_SESSION['exams'];  
                  $s_acyear=$_SESSION['acyear'];     
 
            $sqlpos="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM positioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' ORDER BY total DESC) s";
                   
              $resultpos=mysqli_query($db,$sqlpos);

              if (mysqli_num_rows($resultpos)!=0) {
                   
                  while ($rowpos=mysqli_fetch_assoc($resultpos)) {
                      
                      
                      $id=$rowpos['id'];
                      $name=$rowpos['name'];
                      $indexnumber=$rowpos['indexnumber'];
                      $class=$rowpos['class'];
                       $stream=$rowpos['stream'];
                      $total=$rowpos['total'];
                      $rank=$rowpos['rank'];
?>
<tr> 
<td><?php echo $rank;?></td> 
<?php
                      //class position
                      $sqlclasspos="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM positioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  term='$s_term' AND class='$s_class' AND stream='$stream' AND exam='$s_exam' AND  acyear='$s_acyear' ORDER BY total DESC) s";
  $resultclasspos=mysqli_query($db,$sqlclasspos);
  if (mysqli_num_rows($resultclasspos)!=0) {
                   
                  while ($rowclasspos=mysqli_fetch_assoc($resultclasspos)) {
                      $classindexnumber=$rowclasspos['indexnumber'];
                      $class=$rowclasspos['class'];
                      $stream=$rowclasspos['stream'];
                      $classrank=$rowclasspos['rank'];

    if($classindexnumber==$indexnumber)
    {
   ?>
   <td><?php echo $classrank;?></td>
   <?php

      }
}
 }

//end of class position
            
              ?>
                    
                     
                     
                    <td><?php echo $indexnumber;?></td>             
                    <td><?php echo $name;?></td>
                    <td>
                      <?php
          $sqlmarks= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
                    $resultmarks = mysqli_query($db, $sqlmarks);

                    if (mysqli_num_rows($resultmarks)!=0) {
                    while($rowmarks= mysqli_fetch_array($resultmarks)){
                      $kcmarks=$rowmarks['kcmarks'];
                      $kcgrade=$rowmarks['kcgrade'];
                      echo $kcmarks;
                      echo $kcgrade; 

                    }
                  }else{
                    echo "_";
                  }
      ?>
                    </td>
                    <td>
                      <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Mathematics'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          $grade=$rowmarks['grade'];
          echo $marks." ";
          echo $grade;
        }
      }else{
        echo "_";
      }
                      ?>
                    </td>
                    <td>
                      <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='English'";
        $resultmarks = mysqli_query($db, $sqlmarks);
      if (mysqli_num_rows($resultmarks)!=0) {
              while($rowmarks= mysqli_fetch_array($resultmarks)){
               $marks=$rowmarks['marks'];
            $grade=$rowmarks['grade'];
            echo $marks." ";
            echo $grade;

              }
            }else{
              echo "_";
            }
        ?>
                    </td>
                    <td>
                       <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Kiswahili'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          $grade=$rowmarks['grade'];
          echo $marks." ";
          echo $grade;

        }
      }else{
        echo "_";
      }
        ?>
                    </td>
                   
                    <td>
                       <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Physics'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          $grade=$rowmarks['grade'];
          echo $marks." ";
          echo $grade;
        }
      }else{
        echo "_";
      }
        ?>
                    </td>
                     <td>
                       <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Chemistry'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          $grade=$rowmarks['grade'];
          echo $marks." ";
          echo $grade;

        }
      }else{
        echo "_";
      }
        ?>
                    </td>
                     <td>
                       <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Biology'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          $grade=$rowmarks['grade'];
          echo $marks." ";
          echo $grade;

        }
      }else{
        echo "_";
      }
        ?>
                    </td>
                <td>
                   <?php
      
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Business Studies'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          $grade=$rowmarks['grade'];
          echo $marks." ";
          echo $grade;
        }
      }else{
        echo "_";
      }
        ?>
                </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Agriculture'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          $grade=$rowmarks['grade'];
          echo $marks." ";
          echo $grade;

        }
      }else{
        echo "_";
      }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='History'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          $grade=$rowmarks['grade'];
          echo $marks." ";
          echo $grade;

        }
      }else{
        echo "_";
      }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='C.R.E'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          $grade=$rowmarks['grade'];
          echo $marks." ";
          echo $grade;

        }
      }else{
        echo "_";
      }
        ?>
                 </td>
                 <td>
                    <?php
      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Geography'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
          $grade=$rowmarks['grade'];
          echo $marks." ";
          echo $grade;
        }
      }else{
        echo "_";
      }
        ?>
                 </td>
                     <?php
                 //count from here

                     $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $marks=$total/$count;
                         include 'grading.php';

                      }
                       

                 ?>
 
                  <td style="font-weight: 900;"><?php echo $total;?></td>
                  <!--<td style="font-weight: 900;"><?php //echo $mean;?></td>-->
                  <td style="font-weight: 900;"><?php echo round($marks);?></td>
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
              <form action="adminselectallexamPDF.php">
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