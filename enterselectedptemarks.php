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

    if (isset($_POST['save'])) {

      
        $indexnumber=$_POST['indexnumber'];
        $classes=$_POST['classes'];
        $categories=$_POST['categories'];
        $streams=$_POST['streams'];
        $acyear=$_POST['acyear'];
        $subjects=$_POST['subjects'];
        $exams=$_POST['exams'];
        $points=$_POST['points'];

         $sqlcheck= "SELECT * FROM ptetotal WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND category='$categories'  AND exam='$exams' AND acyear='$acyear'";       
        $resultcheck=mysqli_query($db,$sqlcheck);

        if (mysqli_num_rows($resultcheck)>0) {

           while($rowcheck = mysqli_fetch_array($resultcheck)){
          $name=$rowcheck['name'];

          $sqltotal= "SELECT sum(points) FROM examptemarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND category='$categories' AND exam='$exams' AND acyear='$acyear'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){


 
              $total=$rowtotal['sum(points)'];
               $totals=$points+$total;

              $sql = "UPDATE ptetotal SET total='$totals' WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND category='$categories' AND exam='$exams' AND acyear='$acyear' ";
              mysqli_query($db,$sql);

          $sql="INSERT INTO examptemarks (indexnumber,name,class,stream,category,acyear,subject,exam,points) VALUES ('$indexnumber','$name','$classes','$streams','$categories','$acyear','$subjects','$exams','$points')";
            mysqli_query($db,$sql);


            
          
           }
      }

    }else if (mysqli_num_rows($resultcheck)<1){
          # code...
          $sql1= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
              $result1=mysqli_query($db,$sql1);

                  
                  while ($row=mysqli_fetch_assoc($result1)) {
                    $name=$row['name'];
                    $gender=$row['gender'];
                  
                  $sqltotal= "SELECT sum(points) FROM examptemarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND category='$categories' AND exam='$exams' AND acyear='$acyear'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){

              $total=$rowtotal['sum(points)'];
              $totals=$points+$total;

              $sqlpos="INSERT INTO  ptetotal (indexnumber,name,gender,class,stream,category,acyear,exam,total) VALUES ('$indexnumber','$name','$gender','$classes','$streams','$categories','$acyear','$exams','$totals')";
              mysqli_query($db,$sqlpos);
            mysqli_query($db,$sql);


          
                    }
                  }  
                     
              } 
              //header("location: enterselectedptemarks.php");
               
  }
                 


if(isset($_POST['update'])){
              $editid = $_POST['editid'];
              $editpoints= $_POST['editpoints'];
              $indexnumber=$_POST['indexnumber'];
        
              $sql = "UPDATE examptemarks SET points='$editpoints' WHERE id='$editid' ";
              mysqli_query($db,$sql);
 
        
      $classes=$_POST['classes'];
        $categories=$_POST['categories'];
        $streams=$_POST['streams'];
        $subjects=$_POST['subjects'];
        $exams=$_POST['exams'];
        $acyear=$_POST['acyear'];

        $sqlcheck= "SELECT * FROM ptetotal WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND category='$categories' AND exam='$exams' AND acyear='$acyear' ";
        $resultcheck=mysqli_query($db,$sqlcheck);

        if (mysqli_num_rows($resultcheck)>0) {

           while($rowcheck = mysqli_fetch_array($resultcheck)){
          $name=$rowcheck['name'];

          $sqltotal= "SELECT sum(points) FROM examptemarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND category='$categories' AND exam='$exams' AND acyear='$acyear'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){



              $total=$rowtotal['sum(points)'];
               //$totals=$editpoints+$total;

              $sqlpos = "UPDATE ptetotal SET total='$total' WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND category='$categories' AND  exam='$exams' AND acyear='$acyear'";
              mysqli_query($db,$sqlpos); 
            
        }
      }}

              header("location: enterselectedptemarks.php");
}

          //delete student    
if(isset($_POST['delete'])){
      $deleteid = $_POST['deleteid'];
      $indexnumber=$_POST['indexnumber'];
      
      $sql = "DELETE FROM examptemarks WHERE id='$deleteid' ";
      mysqli_query($db,$sql);

      $classes=$_POST['classes'];
        $categories=$_POST['categories'];
        $streams=$_POST['streams'];
        $exams=$_POST['exams'];
        $acyear=$_POST['acyear'];

        $sqlcheck= "SELECT * FROM ptetotal WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND category='$categories' AND exam='$exams' AND acyear='$acyear'";
        $resultcheck=mysqli_query($db,$sqlcheck);

        if (mysqli_num_rows($resultcheck)>0) {

           while($rowcheck = mysqli_fetch_array($resultcheck)){
          $name=$rowcheck['name'];

          $sqltotal= "SELECT sum(points) FROM examptemarks WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND category='$categories' AND exam='$exams' AND acyear='$acyear'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){



              $total=$rowtotal['sum(points)'];

              $sqlpos = "UPDATE ptetotal SET total='$total' WHERE indexnumber='$indexnumber' AND class='$classes' AND stream='$streams' AND category='$categories' AND exam='$exams' AND acyear='$acyear'";
              mysqli_query($db,$sqlpos); 
            
        }
      }}
    header("location: enterselectedptemarks.php");
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
              
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">
                <?php
                echo $_SESSION['classes']."  |  ".$_SESSION['categories']."  |  ".$_SESSION['acyear']."  |  ".$_SESSION['streams']."   |  ".$_SESSION['exams']." Exam" ;
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
                  $s_subject=$_SESSION['subjects'];
                  $s_exam=$_SESSION['exams'];
                  $s_acyear=$_SESSION['acyear'];
                   $sql= "SELECT * FROM examptemarks WHERE class='$s_class' AND stream='$s_stream' AND category='$s_category' AND subject='$s_subject' AND exam='$s_exam' AND acyear='$s_acyear'";
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
                      $points=$row['points'];
                      ?>
                  <tr>  
                    <td><?php echo $indexnumber;?></td>             
                     <td><?php echo $name;?></td>
                     <td><?php echo $points;?></td>
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
                            <h5 class="modal-title">Edit Points</h5><br>
                            <h5 class="modal-title">Index number: <?php echo $indexnumber; ?></h5><br>
                            <h5 class="modal-title">Subject :<?php echo $_SESSION['subjects']; ?></h5>
                        </div>
                        <div class="modal-body">
                    <input type="hidden" name="editid" class="form-control" value="<?php echo $id; ?>">
                    <input type="hidden" name="indexnumber" value="<?php echo $indexnumber; ?>">
                    <input type="hidden" name="classes" value="<?php echo $_SESSION['classes']; ?>">
                    <input type="hidden" name="categories" value="<?php echo $_SESSION['categories']; ?>">
                    <input type="hidden" name="streams" value="<?php echo $_SESSION['streams']; ?>">
                    <input type="hidden" name="acyear" value="<?php echo $_SESSION['acyear']; ?>">
                    <input type="hidden" name="exams" value="<?php echo $_SESSION['exams']; ?>">
                    <br>
                <label>Edit Points</label><input type="text" name="editpoints" class="form-control" value="<?php echo $points; ?>"><br>
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

<!--Delete points -->
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
                            <input type="hidden" name="deletepoints" value="<?php echo $points; ?>">
                            <input type="hidden" name="indexnumber" value="<?php echo $indexnumber; ?>">
                    <input type="hidden" name="classes" value="<?php echo $_SESSION['classes']; ?>">
                    <input type="hidden" name="categories" value="<?php echo $_SESSION['categories']; ?>">
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
    <div class="form-group">
      <label>Select Index Number</label>
      <?php 
          $sql= "SELECT * FROM students WHERE class='$s_class' AND stream='$s_stream' AND category='$s_category'";
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
      <label>Enter Points</label>
      <input type="text" name="points" class="form-control">
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
