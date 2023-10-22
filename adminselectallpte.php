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
                  <th>Grade</th>
                  <th>Disctinctions</th>
                  <th>Percentage</th>
                  <th>Credit</th>
                  <th>Percentage</th>
                  <th>Pass</th>
                  <th>Percentage</th>
                  <th>Fail</th>
                  <th>Percentage</th>
                  <th>Total</th>
                  </tr>

                 <?php 
                  $s_class=$_SESSION['classes'];
                  $s_category=$_SESSION['categories'];
                  $s_exam=$_SESSION['exams'];      
                  $s_acyear=$_SESSION['acyear'];  
            ?>
                   
                     <tr> 
                    <th>No. of Candidates</th>

                    <td>
                      <?php
                      $sqlmarks= "SELECT count(1) FROM  ptetotal WHERE  category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
             $totalcandidates=$rowmarks[0];

      $sqlmarks= "SELECT count(1) FROM  ptetotal WHERE  category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND total>='1' AND total<='22'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
             $total=$rowmarks[0];
            echo $total; 
            
                  ?>
                    </td>
                    <td>
                      <?php
                      $perc=($total/$totalcandidates)*100;
            echo $perc."%";
                  }
                      ?>
                    </td>  
                    
                  <td>
                      <?php
      $sqlmarks= "SELECT count(1) FROM  ptetotal WHERE  category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND total>='23' AND total<'50'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
             $total=$rowmarks[0];
            echo $total; 
            
                  ?>

                    </td>
                    <td>
                      <?php
                      $perc=($total/$totalcandidates)*100;
            echo $perc."%";
                  }
                      ?>
                    </td>
                    <td>
                      <?php
      $sqlmarks= "SELECT count(1) FROM  ptetotal WHERE  category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND total>='50' AND total<'69'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
             $total=$rowmarks[0];
            echo $total; 
           
                  ?>

                    </td>
                    <td>
                      <?php
                      $perc=($total/$totalcandidates)*100;
            echo $perc."%";
                  }
                      ?>
                    </td>
                    <td>
                      <?php
      $sqlmarks= "SELECT count(1) FROM  ptetotal WHERE  category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND total>='69' AND total<='100'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        while($rowmarks= mysqli_fetch_array($resultmarks)){
             $total=$rowmarks[0];
            echo $total; 
            
                  ?>

                    </td>
                    <td>
                      <?php
                      $perc=($total/$totalcandidates)*100;
            echo $perc."%";
                  }
                      ?>
                    </td>
                    <td>
                      <?php
      
            echo $totalcandidates; 
                  }
                  ?>

                    </td>

                  
                 </tr>
                 
                 <?php
                
               
             
                     ?> 
                 </table>
                   <!--End of table-->
              </div>
              </div>
              </div>
              <a href="selectallexamadmin.php">GO BACK</a>
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