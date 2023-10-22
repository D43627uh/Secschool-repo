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
    if(isset($_SESSION["subjects"])){
     $_SESSION['subjects'];
    }
    if(isset($_SESSION["exams"])){
     $_SESSION['exams'];
    }

    if (isset($_POST['save'])) {

      
        $indexnumber=$_POST['indexnumber'];
        $classes=$_POST['classes'];
        $terms=$_POST['terms'];
        $subjects=$_POST['subjects'];
        $exams=$_POST['exams'];
        $marks=$_POST['marks'];

        if ($marks >=80 && $marks <=100) {
          $grade="A";
        }
        else if ($marks >=75 && $marks <80) {
          $grade="A-";
        }
         else if ($marks >=70 && $marks <75) {
          $grade="B+";
        }
        else if ($marks >=65 && $marks <70) {
          $grade="B";
        }
        else if ($marks >=60 && $marks <65) {
          $grade="B-";
        }
        else if ($marks >=55 && $marks <60) {
          $grade="C+";
        }
        else if ($marks >=50 && $marks <55) {
          $grade="C";
        }
        else if ($marks >=45 && $marks <50) {
          $grade="C-";
        }
        else if ($marks >=40 && $marks <45) {
          $grade="D+";
        }
        else if ($marks >=35 && $marks <40) {
          $grade="D";
        }
        else if ($marks >=30 && $marks <35) {
          $grade="D-";
        }
        else if ($marks >=0 && $marks <30) {
          $grade="E";
        }


        $sqlcheck= "SELECT * FROM positioning WHERE indexnumber='$indexnumber'";       
        $resultcheck=mysqli_query($db,$sqlcheck);

        if (mysqli_num_rows($resultcheck)>0) {

           while($rowcheck = mysqli_fetch_array($resultcheck)){
          $name=$rowcheck['name'];

          $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND term='$terms' AND exam='$exams'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){



              $total=$rowtotal['sum(marks)'];
               $totals=$marks+$total;

              $sql = "UPDATE positioning SET total='$totals' WHERE indexnumber='$indexnumber' AND class='$classes' AND term='$terms' AND exam='$exams' ";
              mysqli_query($db,$sql);

               $sql="INSERT INTO exammarks (indexnumber,name,class,term,subject,exam,marks,grade) VALUES ('$indexnumber','$name','$classes','$terms','$subjects','$exams','$marks','$grade')";
            mysqli_query($db,$sql);
            
        }
      }}else{
          # code...
          $sql1= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
              $result1=mysqli_query($db,$sql1);

                  
                  while ($row=mysqli_fetch_assoc($result1)) {
                    $name=$row['name'];
                  
                  $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND term='$terms' AND exam='$exams'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){

              $total=$rowtotal['sum(marks)'];
              $totals=$marks+$total;

              $sqlpos="INSERT INTO  positioning (indexnumber,name,class,term,exam,total) VALUES ('$indexnumber','$name','$classes','$terms','$exams','$totals')";

            

          $sql="INSERT INTO exammarks (indexnumber,name,class,term,subject,exam,marks,grade) VALUES ('$indexnumber','$name','$classes','$terms','$subjects','$exams','$marks','$grade')";

            mysqli_query($db,$sqlpos);
            mysqli_query($db,$sql);


            header("location: enterselectedmarks.php");
                    }
                  }  
                     
              }      
}


if(isset($_POST['update'])){
              $editid = $_POST['editid'];
              $editmarks= $_POST['editmarks'];
        if ($editmarks >=80 && $editmarks <=100) {
          $grade="A";
        }
        else if ($editmarks >=75 && $editmarks <80) {
          $grade="A-";
        }
         else if ($editmarks >=70 && $editmarks <75) {
          $grade="B+";
        }
        else if ($editmarks >=65 && $editmarks <70) {
          $grade="B";
        }
        else if ($editmarks >=60 && $editmarks <65) {
          $grade="B-";
        }
        else if ($editmarks >=55 && $editmarks <60) {
          $grade="C+";
        }
        else if ($editmarks >=50 && $editmarks <55) {
          $grade="C";
        }
        else if ($editmarks >=45 && $editmarks <50) {
          $grade="C-";
        }
        else if ($editmarks >=40 && $editmarks <45) {
          $grade="D+";
        }
        else if ($editmarks >=35 && $editmarks <40) {
          $grade="D";
        }
        else if ($editmarks >=30 && $editmarks <35) {
          $grade="D-";
        }
        else if ($editmarks >=0 && $editmarks <30) {
          $grade="E";
        }


              $sql = "UPDATE exammarks SET marks='$editmarks', grade='$grade' WHERE id='$editid' ";
              mysqli_query($db,$sql);

              //from here
               $indexnumber=$_POST['indexnumber'];
        $classes=$_POST['classes'];
        $terms=$_POST['terms'];
        $subjects=$_POST['subjects'];
        $exams=$_POST['exams'];
        $marks=$_POST['marks'];



        $sqlcheck= "SELECT * FROM positioning WHERE indexnumber='$indexnumber'";
        $resultcheck=mysqli_query($db,$sqlcheck);

        if (mysqli_num_rows($resultcheck)>0) {

           while($rowcheck = mysqli_fetch_array($resultcheck)){
          $name=$rowcheck['name'];

          $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND term='$terms' AND exam='$exams'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){



              $total=$rowtotal['sum(marks)'];
               $totals=$marks+$total;

              $sqlpos = "UPDATE positioning SET total='$totals' WHERE indexnumber='$indexnumber' AND class='$classes' AND term='$terms' AND exam='$exams' ";
              mysqli_query($db,$sqlpos); 
            
        }
      }}else{
        header("location: enterselectedmarks.php");
      }
     header("location: enterselectedmarks.php");
}

          //delete student    
if(isset($_POST['delete'])){
      $deleteid = $_POST['deleteid'];
      $deletemarks = $_POST['deletemarks'];
      
      $sql = "DELETE FROM exammarks WHERE id='$deleteid' ";
      mysqli_query($db,$sql);


      //from here

      $indexnumber=$_POST['indexnumber'];
        $classes=$_POST['classes'];
        $terms=$_POST['terms'];
        $subjects=$_POST['subjects'];
        $exams=$_POST['exams'];
        $marks=$_POST['marks'];

        $sqlcheck= "SELECT * FROM positioning WHERE indexnumber='$indexnumber'";
        $resultcheck=mysqli_query($db,$sqlcheck);

        if (mysqli_num_rows($resultcheck)>0) {

           while($rowcheck = mysqli_fetch_array($resultcheck)){
          $name=$rowcheck['name'];

          $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND term='$terms' AND exam='$exams'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){



              $total=$rowtotal['sum(marks)'];
               $totals=$marks+$total;

              $sqlpos = "UPDATE positioning SET total='$totals' WHERE indexnumber='$indexnumber' AND class='$classes' AND term='$terms' AND exam='$exams' ";
              mysqli_query($db,$sqlpos); 
            
        }
      }}else{
        header("location: enterselectedmarks.php");
      }
    header("location: enterselectedmarks.php");
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
            <li class="active"><a href="portalteacher.php">Dashboard</a></li>
            <li><a href="addstudent.php">Students</a></li>
            <li><a href="allexam.php">Exam</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome <?php echo $_SESSION['username'];?></a></li>
            <li><a href="index.php">Logout</a></li>
          </ul>
        </div>

      </div>
    </nav>
    <!--to here-->

    <!--from here-->
     <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <small> Manage Account</small></h1>
          </div>
        </div>
      </div>
    </header>
    

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="portalteacher.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">
                <?php
                echo $_SESSION['classes']." | ".$_SESSION['terms']."   |  ".$_SESSION['exams']." Exam";
                ?>
                </h3>
              </div>
              <div class="panel-body">

                <input type="submit" name="add" class="btn btn-info" value="Enter the Marks" data-toggle="modal" data-target="#add">
                <div><br></div>
                <!--table from here-->
                 <table class="table table-bordered">

                  <tr>
                  <th>Admission</th>
                  <th>Name</th>
                  <th>Marks</th>
                  </tr>
                  <?php 
                  $s_class=$_SESSION['classes'];
                  $s_term=$_SESSION['terms'];
                  $s_subject=$_SESSION['subjects'];
                  $s_exam=$_SESSION['exams'];
                   $sql= "SELECT * FROM exammarks WHERE class='$s_class' AND term='$s_term' AND subject='$s_subject' AND exam='$s_exam'";
                  //$sql= "SELECT * FROM exammarks WHERE class='".$_SESSION['classes']."'";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $id=$row['id'];
                      $indexnumber=$row['indexnumber'];
                      $name=$row['name'];
                      $class=$row['class'];
                      $term=$row['term'];
                      $subject=$row['subject'];
                      $exam=$row['exam'];
                      $marks=$row['marks'];
                      ?>
                  <tr>  
                    <td><?php echo $indexnumber;?></td>             
                     <td><?php echo $name;?></td>
                     <td><?php echo $marks;?></td>
                     <td>
                      <a href="#edit<?php echo $id;?>" data-toggle="modal"><button type='button' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button></a>
                      </td>
                      <td>
                        <a href="#delete<?php echo $id;?>" data-toggle="modal"><button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></a>
                      </td>
                     </tr>
        <!-- Edit Student -->
      <div id="edit<?php echo $id; ?>" class="modal fade" role="dialog">
            <form method="post">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title">Edit Marks</h5><br>
                            <h5 class="modal-title">Index number: <?php echo $indexnumber; ?></h5><br>
                            <h5 class="modal-title">Subject :<?php echo $_SESSION['subjects']; ?></h5>
                        </div>
                        <div class="modal-body">
                    <input type="hidden" name="editid" class="form-control" value="<?php echo $id; ?>">
                    <input type="hidden" name="indexnumber" value="<?php echo $indexnumber; ?>">
                    <input type="hidden" name="deletemarks" value="<?php echo $marks; ?>">
                    <input type="hidden" name="classes" value="<?php echo $_SESSION['classes']; ?>">
                    <input type="hidden" name="terms" value="<?php echo $_SESSION['terms']; ?>">
                    <input type="hidden" name="exams" value="<?php echo $_SESSION['exams']; ?>">
                    <br>
                <label>Edit Marks</label><input type="text" name="editmarks" class="form-control" value="<?php echo $marks; ?>"><br>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="update">Update  </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
              </form>
        </div>        
<!--End of Edit Teacher-->

<!--Delete Teacher -->
        <div id="delete<?php echo $id; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form method="post">
                    <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete</h4>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="deleteid" value="<?php echo $id; ?>">
                            <input type="hidden" name="indexnumber" value="<?php echo $indexnumber; ?>">
                            <input type="hidden" name="deletemarks" value="<?php echo $marks; ?>">
                            <input type="hidden" name="classes" value="<?php echo $_SESSION['classes']; ?>">
                            <input type="hidden" name="terms" value="<?php echo $_SESSION['terms']; ?>">
                            <input type="hidden" name="exams" value="<?php echo $_SESSION['exams']; ?>">
                            <p>
                                <div class="alert alert-danger">Are you Sure you want Delete Index : <strong><?php echo $indexnumber; ?> </strong>Marks?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="delete" class="btn btn-danger">YES</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                            </div>
                        </div>
                </form>
                </div>
            </div>
            <!--End of Delete-->

                   <?php
            }
          }
              ?>


                 </table>
                <!--End of table-->

                </div>
              </div>
              </div>
              </div>
        </div>
    </section>

    <!-- Add marks-->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Enter <?php echo $_SESSION['subjects']; ?> Marks</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="classes" value="<?php echo $_SESSION['classes']; ?>">
        <input type="hidden" name="terms" value="<?php echo $_SESSION['terms']; ?>">
        <input type="hidden" name="subjects" value="<?php echo $_SESSION['subjects']; ?>">
        <input type="hidden" name="exams" value="<?php echo $_SESSION['exams']; ?>">
    <div class="form-group">
      <label>Select Index Number</label>
      <?php 
          $sql= "SELECT * FROM students WHERE class='".$_SESSION['classes']."'";
              $result = mysqli_query($db, $sql);
              ?>
              <select name="indexnumber" class="form-control">

            <?php while($row = mysqli_fetch_array($result)):;?>

            <option><?php echo $row['indexnumber'];?></option>

            <?php endwhile;?>

        </select>
              <?php

        ?>
    </div>
    <div class="form-group">
      <label>Enter Marks</label>
      <input type="text" name="marks" class="form-control">
    </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="save" class="btn btn-primary">Save</button>
      </div>

    </form>
    </div>
  </div>
</div>
<!--End of modal-->

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
