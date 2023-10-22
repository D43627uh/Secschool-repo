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
    
    if(isset($_SESSION["subjects"])){
     $_SESSION['subjects'];
    }
    if(isset($_SESSION["exams"])){
     $_SESSION['exams'];
    }
    if(isset($_SESSION["streams"])){
     $_SESSION['streams'];
    }
    if(isset($_SESSION["acyear"])){
     $_SESSION['acyear'];
    }
    if(isset($_SESSION["terms"])){
     $_SESSION['terms'];
    }

    if (isset($_POST['save'])) {

      
        $indexnumber=$_POST['indexnumber'];
        $classes=$_POST['classes'];
        $terms=$_POST['terms'];
        $categories=$_POST['categories'];
        $streams=$_POST['streams'];
        $acyear=$_POST['acyear'];
        $subjects=$_POST['subjects'];
        $exams=$_POST['exams'];
        $marks=$_POST['marks'];

    if($subjects=="Mathematics" && $classes=="Form One" || $subjects=="Physics" && $classes=="Form One" || $subjects=="Chemistry" && $classes=="Form One" || $subjects=="Biology" && $classes=="Form One"){
      include 'form1_grading_sciences.php';
    }
    if($subjects=="English" && $classes=="Form One" || $subjects=="Kiswahili" && $classes=="Form One" || $subjects=="History" && $classes=="Form One" || $subjects=="Geography" && $classes=="Form One" || $subjects=="Religion" && $classes=="Form One" || $subjects=="Business Studies" && $classes=="Form One" || $subjects=="Agriculture" && $classes=="Form One"){
      include 'form1_grading_hum.php';
    }
    if($subjects=="Computer" && $classes=="Form One")
    {
      include 'form1_grading_comp.php';
    }

    if($subjects=="Mathematics" && $classes=="Form Two" || $subjects=="Physics" && $classes=="Form Two" || $subjects=="Chemistry" && $classes=="Form Two" || $subjects=="Biology" && $classes=="Form Two"){
      include 'form1_grading_sciences.php';
    }

    if($subjects=="English" && $classes=="Form Two" || $subjects=="Kiswahili" && $classes=="Form Two" || $subjects=="History" && $classes=="Form Two" || $subjects=="Geography" && $classes=="Form Two" || $subjects=="Religion" && $classes=="Form Two" || $subjects=="Business Studies" && $classes=="Form Two" || $subjects=="Agriculture" && $classes=="Form Two"){
      include 'form1_grading_hum.php';
    }
    if($subjects=="Computer" && $classes=="Form Two")
    {
      include 'form1_grading_comp.php';
    }
    // form 3
    if($subjects=="Mathematics" && $classes=="Form Three" || $subjects=="Physics" && $classes=="Form Three" || $subjects=="Chemistry" && $classes=="Form Three" || $subjects=="Biology" && $classes=="Form Three"){
      include 'form1_grading_sciences.php';
    }
    if($subjects=="History" && $classes=="Form Three" || $subjects=="Geography" && $classes=="Form Three" || $subjects=="Religion" && $classes=="Form Three" || $subjects=="Business Studies" && $classes=="Form Three" || $subjects=="Agriculture" && $classes=="Form Three"){
      include 'form1_grading_hum.php';
    }
    if($subjects=="English" && $classes=="Form Three" || $subjects=="Kiswahili" && $classes=="Form Three")
    {
      include 'form1_grading_sciences.php';
    }
    if($subjects=="Computer" && $classes=="Form Three")
    {
      include 'form1_grading_comp.php';
    }

    if($subjects=="Mathematics" && $classes=="Form Four" || $subjects=="Physics" && $classes=="Form Four" || $subjects=="Chemistry" && $classes=="Form Four" || $subjects=="Biology" && $classes=="Form Four"){
      include 'form1_grading_sciences.php';
    }

    if($subjects=="History" && $classes=="Form Four" || $subjects=="Geography" && $classes=="Form Four" || $subjects=="Religion" && $classes=="Form Four" || $subjects=="Business Studies" && $classes=="Form Four" || $subjects=="Agriculture" && $classes=="Form Four"){
      include 'form1_grading_hum.php';
    }
    if($subjects=="English" && $classes=="Form Four" || $subjects=="Kiswahili" && $classes=="Form Four")
    {
      include 'form1_grading_sciences.php';
    }
    if($subjects=="Computer" && $classes=="Form Four")
    {
      include 'form3_grading_comp.php';
    }


        


        $sqlcheck= "SELECT * FROM positioning WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms'  AND exam='$exams' AND acyear='$acyear'";       
        $resultcheck=mysqli_query($db,$sqlcheck);

        if (mysqli_num_rows($resultcheck)>0) {

           while($rowcheck = mysqli_fetch_array($resultcheck)){
          $name=$rowcheck['name'];

          $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND exam='$exams' AND acyear='$acyear'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){



              $total=$rowtotal['sum(marks)'];
               $totals=$marks+$total;

              $sql = "UPDATE positioning SET total='$totals' WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND exam='$exams' AND acyear='$acyear' ";
              mysqli_query($db,$sql);

               $sql="INSERT INTO exammarks (indexnumber,name,class,stream,term,acyear,subject,exam,marks,grade) VALUES ('$indexnumber','$name','$classes','$streams','$terms','$acyear','$subjects','$exams','$marks','$grade')";
            mysqli_query($db,$sql);
            //
          /*$sqloverall= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear'";       
                  $resultoverall=mysqli_query($db,$sqloverall);

                  if (mysqli_num_rows($resultoverall)>0) {

                     while($rowoverall= mysqli_fetch_array($resultoverall)){
                      $sqlcheck= "SELECT * FROM positioning WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear'";       
                          $resultcheck=mysqli_query($db,$sqlcheck);

                          if (mysqli_num_rows($resultcheck)>0) {

                             while($rowcheck = mysqli_fetch_array($resultcheck)){
                            $ttotal=$rowcheck['total'];
                            $mytotal=$ttotal+$total;

                            $sqlupdate = "UPDATE overallpositioning SET total='$mytotal' WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear' ";
                        mysqli_query($db,$sqlupdate);
                          }
                        }
                      
                  }
                } else if (mysqli_num_rows($resultoverall)<1){
                  $sqlcheck= "SELECT * FROM positioning WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear'";       
                          $resultcheck=mysqli_query($db,$sqlcheck);

                          if (mysqli_num_rows($resultcheck)>0) {

                             while($rowcheck = mysqli_fetch_array($resultcheck)){
                            $ttotal=$rowcheck['total'];
                            $mytotal=$ttotal+$total;
                   $sqlinsert="INSERT INTO  overallpositioning (indexnumber,name,class,stream,term,acyear,total) VALUES ('$indexnumber','$name','$classes','$streams','$terms','$acyear','$mytotal')";
              mysqli_query($db,$sqlinsert);
            }
          }
                }*/
            //
            
        }
      }}else if (mysqli_num_rows($resultcheck)<1){
          # code...
          $sql1= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
              $result1=mysqli_query($db,$sql1);

                  
                  while ($row=mysqli_fetch_assoc($result1)) {
                    $name=$row['name'];
                  
                  $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND exam='$exams' AND acyear='$acyear'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){

              $total=$rowtotal['sum(marks)'];
              $totals=$marks+$total;

              $sqlpos="INSERT INTO  positioning (indexnumber,name,class,stream,term,acyear,exam,total) VALUES ('$indexnumber','$name','$classes','$streams','$terms','$acyear','$exams','$totals')";
              mysqli_query($db,$sqlpos);

            

          $sql="INSERT INTO exammarks (indexnumber,name,class,stream,term,acyear,subject,exam,marks,grade) VALUES ('$indexnumber','$name','$classes','$streams','$terms','$acyear','$subjects','$exams','$marks','$grade')";

            
            mysqli_query($db,$sql);


            
                    }
                  }  
                     
              } 
              //Overall positioning
          $sqloverall= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear'";       
                  $resultoverall=mysqli_query($db,$sqloverall);

                  if (mysqli_num_rows($resultoverall)>0) {

                     while($rowoverall= mysqli_fetch_array($resultoverall)){

                      $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear'";
                        $resulttotal = mysqli_query($db, $sqltotal);

                        while($rowtotal = mysqli_fetch_array($resulttotal)){

                          $total=$rowtotal['sum(marks)'];

                            $sqlupdate = "UPDATE overallpositioning SET total='$total' WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear' ";
                        mysqli_query($db,$sqlupdate);
                          }
                        
                      
                  }
                } else if (mysqli_num_rows($resultoverall)<1){
                  $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear'";
                        $resulttotal = mysqli_query($db, $sqltotal);

                        while($rowtotal = mysqli_fetch_array($resulttotal)){

                          $total=$rowtotal['sum(marks)'];

                   $sqlinsert="INSERT INTO  overallpositioning (indexnumber,name,class,stream,term,acyear,total) VALUES ('$indexnumber','$name','$classes','$streams','$terms','$acyear','$total')";
              mysqli_query($db,$sqlinsert);
            
          }
        }

              header("location: enterselectedmarks.php");   
 
}


if(isset($_POST['update'])){
              $editid = $_POST['editid'];
              $marks= $_POST['editmarks'];

        include 'grading.php';


         $sql = "UPDATE exammarks SET marks='$marks', grade='$grade' WHERE id='$editid' ";
              mysqli_query($db,$sql);

              //from here
               $indexnumber=$_POST['indexnumber'];
        $classes=$_POST['classes'];
        $terms=$_POST['terms'];
        $streams=$_POST['streams'];
        $exams=$_POST['exams'];
        $acyear=$_POST['acyear'];



        $sqlcheck= "SELECT * FROM positioning WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND exam='$exams' AND acyear='$acyear' ";
        $resultcheck=mysqli_query($db,$sqlcheck);

        if (mysqli_num_rows($resultcheck)>0) {

           while($rowcheck = mysqli_fetch_array($resultcheck)){
          $name=$rowcheck['name'];

          $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND exam='$exams' AND acyear='$acyear'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){



              $total=$rowtotal['sum(marks)'];
               //$totals=$marks+$total;

              $sqlpos = "UPDATE positioning SET total='$total' WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND  exam='$exams' AND acyear='$acyear'";
              mysqli_query($db,$sqlpos); 
            
        }
      }
    }/*else if (mysqli_num_rows($resultcheck)<1){
        header("location: enterselectedmarks.php");
      }*/

       //Overall positioning
          $sqloverall= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear'";       
                  $resultoverall=mysqli_query($db,$sqloverall);

                  if (mysqli_num_rows($resultoverall)>0) {

                     while($rowoverall= mysqli_fetch_array($resultoverall)){

                      $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear'";
                        $resulttotal = mysqli_query($db, $sqltotal);

                        while($rowtotal = mysqli_fetch_array($resulttotal)){

                          $total=$rowtotal['sum(marks)'];

                            $sqlupdate = "UPDATE overallpositioning SET total='$total' WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear' ";
                        mysqli_query($db,$sqlupdate);
                          }
                        
                      
                  }
                } else if (mysqli_num_rows($resultoverall)<1){
                  $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear'";
                        $resulttotal = mysqli_query($db, $sqltotal);

                        while($rowtotal = mysqli_fetch_array($resulttotal)){

                          $total=$rowtotal['sum(marks)'];

                   $sqlinsert="INSERT INTO  overallpositioning (indexnumber,name,class,stream,term,acyear,total) VALUES ('$indexnumber','$name','$classes','$streams','$terms','$acyear','$total')";
              mysqli_query($db,$sqlinsert);
            
          }
        }
        //To Here

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
        $streams=$_POST['streams'];
        $exams=$_POST['exams'];
        $acyear=$_POST['acyear'];

        $sqlcheck= "SELECT * FROM positioning WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND exam='$exams' AND acyear='$acyear'";
        $resultcheck=mysqli_query($db,$sqlcheck);

        if (mysqli_num_rows($resultcheck)>0) {

           while($rowcheck = mysqli_fetch_array($resultcheck)){
          $name=$rowcheck['name'];

          $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND exam='$exams' AND acyear='$acyear'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){



              $total=$rowtotal['sum(marks)'];
               //$totals=$deletemarks+$total;

              $sqlpos = "UPDATE positioning SET total='$total' WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND exam='$exams' AND acyear='$acyear'";
              mysqli_query($db,$sqlpos); 
            
        }
      }
    }/*else{
        header("location: enterselectedmarks.php");
      }*/

      //Overall positioning
          $sqloverall= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear'";       
                  $resultoverall=mysqli_query($db,$sqloverall);

                  if (mysqli_num_rows($resultoverall)>0) {

                     while($rowoverall= mysqli_fetch_array($resultoverall)){

                      $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear'";
                        $resulttotal = mysqli_query($db, $sqltotal);

                        while($rowtotal = mysqli_fetch_array($resulttotal)){

                          $total=$rowtotal['sum(marks)'];

                            $sqlupdate = "UPDATE overallpositioning SET total='$total' WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear' ";
                        mysqli_query($db,$sqlupdate);
                          }
                        
                      
                  }
                } else if (mysqli_num_rows($resultoverall)<1){
                  $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND term='$terms' AND acyear='$acyear'";
                        $resulttotal = mysqli_query($db, $sqltotal);

                        while($rowtotal = mysqli_fetch_array($resulttotal)){

                          $total=$rowtotal['sum(marks)'];

                   $sqlinsert="INSERT INTO  overallpositioning (indexnumber,name,class,stream,term,acyear,total) VALUES ('$indexnumber','$name','$classes','$streams','$terms','$acyear','$total')";
              mysqli_query($db,$sqlinsert);
            
          }
        }
        //To Here

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
              <a href="portalteacher.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <?php
              include'portalteacher_sidebar.php';
              ?>
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">
                <?php
                echo $_SESSION['classes']."  |  ".$_SESSION['categories']."  |  ".$_SESSION['terms']."  |  ".$_SESSION['acyear']."  |  ".$_SESSION['streams']."   |  ".$_SESSION['exams']." Exam" ;
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
                  $s_stream=$_SESSION['streams'];
                  $s_category=$_SESSION['categories'];
                  $s_term=$_SESSION['terms'];
                  $s_subject=$_SESSION['subjects'];
                  $s_exam=$_SESSION['exams'];
                  $s_acyear=$_SESSION['acyear'];
                   $sql= "SELECT * FROM exammarks WHERE class='$s_class' AND stream='$s_stream' AND term='$s_term' AND subject='$s_subject' AND exam='$s_exam' AND acyear='$s_acyear'";
                 
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $id=$row['id'];
                      $indexnumber=$row['indexnumber'];
                      $name=$row['name'];
                      $class=$row['class'];
                      $acyear=$row['acyear'];
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
                    <input type="hidden" name="classes" value="<?php echo $_SESSION['classes']; ?>">
                    <input type="hidden" name="terms" value="<?php echo $_SESSION['terms']; ?>">
                    <input type="hidden" name="streams" value="<?php echo $_SESSION['streams']; ?>">
                    <input type="hidden" name="acyear" value="<?php echo $_SESSION['acyear']; ?>">
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
                    <input type="hidden" name="streams" value="<?php echo $_SESSION['streams']; ?>">
                    <input type="hidden" name="acyear" value="<?php echo $_SESSION['acyear']; ?>">
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
        <input type="hidden" name="streams" value="<?php echo $_SESSION['streams']; ?>">
        <input type="hidden" name="categories" value="<?php echo $_SESSION['categories']; ?>">
        <input type="hidden" name="subjects" value="<?php echo $_SESSION['subjects']; ?>">
        <input type="hidden" name="exams" value="<?php echo $_SESSION['exams']; ?>">
        <input type="hidden" name="acyear" value="<?php echo $_SESSION['acyear']; ?>">
        <input type="hidden" name="terms" value="<?php echo $_SESSION['terms']; ?>">
    <div class="form-group">
      <label>Select Index Number</label>
      <?php 
          $sql= "SELECT * FROM students WHERE class='$s_class' AND stream='$s_stream'";
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
