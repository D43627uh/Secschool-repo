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
    if(isset($_SESSION["acyear"])){
     $_SESSION['acyear'];
    }
    if(isset($_SESSION["exams"])){
     $_SESSION['exams'];
    } 
     $s_username=$_SESSION['username'];
      $s_class=$_SESSION['classes'];
      $s_term=$_SESSION['terms'];
    $s_acyear=$_SESSION['acyear'];
    $s_exam=$_SESSION['exams'];
     
    if (isset($_POST['print'])) {
      header("location: generatestudentPdf.php");
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
              <a href="portalstudentfinance.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> Finance</span> </a>
              
            </div>

          </div>
          <center>
          <div class="col-md-9">
            <!-- Website Overview -->
            <?php
            $sqlrank="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM positioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE acyear='$s_acyear' AND exam='$s_exam' AND  class='$s_class' AND  term='$s_term' ORDER BY total DESC) s";
                   
//indexnumber='$s_username' AND 
  $recordrank=mysqli_query($db,$sqlrank);
  while ($rowrank=mysqli_fetch_array($recordrank)) {

    $rank=$rowrank['rank'];
    $indexnumber=$rowrank['indexnumber'];

    if ($indexnumber==$s_username) {
            ?>
              
              <br>
              
                  <div class="row">
                  <div class="col-md-2">
                    
                  </div>
                  
                  <div class="col-md-8">
                    
                    <p><strong>PAUL BOIT BOYS HIGH SCHOOL</strong></p>
                    <p>P.O BOX 277, ELDORET</p>
                    <p>info@paulboithigh.sc.ke || www.paulboithigh.sc.ke</p>
                   
                  </div>

                  <div class="col-md-2">
                    
                  </div>
                  </div>
                  <table class="table table-bordered">
                    <tr>
                      
                      <?php
                         $sql= "SELECT * FROM students WHERE indexnumber='".$_SESSION['username']."'";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                   
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $name=$row['name'];
                  ?>
                  <tr> 
                    
                    <td>Name: <?php echo $name?></td>
                   
                     <?php
                   }
                 }
                ?>

                      
                      <td>Admission: <?php echo $_SESSION['username']; ?></td>
                      <td>Term: <?php echo $_SESSION['terms']; ?></td>
                      
                    </tr>
                    <tr>
                      <td>Class: <?php echo $_SESSION['classes']; ?></td>
                       <td>Academic Year: <?php echo $_SESSION['acyear']; ?></td>
                       <td>Exam: <?php echo $_SESSION['exams']; ?></td>
                    </tr>
                  </table>
               <!--table from here-->
                 <table class="table table-bordered">
                
                  <tr>
                  <th>Subject</th>
                  <th>Marks</th>
                  <th>Grade</th>

                  </tr>
                 <?php 
                  $s_username=$_SESSION['username'];
                  $s_class=$_SESSION['classes'];
                  $s_term=$_SESSION['terms'];
                  $s_exam=$_SESSION['exams'];

                  $sql1= "SELECT * FROM exammarks WHERE indexnumber='$s_username' AND class='$s_class' AND term='$s_term' AND acyear='$s_acyear' AND exam='$s_exam'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                      $subject=$row1['subject'];
                      $marks=$row1['marks'];
                      $grade=$row1['grade'];
                  ?>
                  <tr> 
                    
                    <td><?php echo $subject?></td>
                    <td><?php echo $marks?></td>
                    <td><?php echo $grade?></td>
                     <?php
                   }
                 }
                ?>
                 </tr>  

                 </table>
                <!--End of table-->
                <table class="table table-bordered">
                  <tr>
                   <td><strong>Total Marks</strong></td>
                   <?php
                    $sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$s_username' AND class='$s_class' AND term='$s_term' AND acyear='$s_acyear' AND exam='$s_exam'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                       
                      $tmarks=$row1['sum(marks)'];

                      //from here

                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$s_username' AND class='$s_class' AND term='$s_term' AND acyear='$s_acyear' AND exam='$s_exam'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $marks=@($tmarks/$count);
                          include 'grading.php';
                      
                   //to here
                  ?> 
                    
                    <td><?php echo $tmarks?></td>
                    </tr>
                    <tr>
                   <td><strong>Mean Marks</strong></td>
                    <td>
                      <?php echo $marks; ?>
                    </td>
                 </tr>
                 
                 <tr>
                   <td><strong>Grade</strong></td>
                    <td>
                      <?php echo $grade; ?>
                    </td>
                 </tr>
                     <?php
                   }
                 $sqlcount= "SELECT count(1) FROM positioning WHERE class='$s_class' AND term='$s_term' AND acyear='$s_acyear' AND exam='$s_exam' ";
                        $resultcount = mysqli_query($db, $sqlcount);

                        while($rowcount = mysqli_fetch_array($resultcount)){

                          $total=$rowcount[0];
                          ?>
                    <tr>
                      <th>Position</th>
                      <td><?php echo $rank." Out of ".$total; ?></td>
                    </tr>
                      <?php
                          
                    }
                   }  
                 }

               }
             }
                 ?>
                 
                 
                </table>
              
              <form method="post">
                   <input type="submit" name="print" value="Export to PDF" class="btn btn-info">
                 </form>
               
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
