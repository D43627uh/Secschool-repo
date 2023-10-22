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

        # code...
        $indexnumber=$_POST['indexnumber'];
        $classes=$_POST['classes'];
        $terms=$_POST['terms'];
        $exams=$_POST['exams'];
        
          # code...
          $sql1= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result1)) {
                      
              $name=$row['name'];

        $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$classes' AND term='$terms' AND exam='$exams'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){

              $total=$rowtotal['sum(marks)'];

          $sql="INSERT INTO  positioning (indexnumber,name,class,term,exam,total) VALUES ('$indexnumber','$name','$classes','$terms','$exams','$total')";

            mysqli_query($db,$sql);
            header("location: generate_totalnow.php");
                    }
                  }  
                  }    
                    
}
if(isset($_POST['update'])){
              $editid = $_POST['editid'];
              $editindex = $_POST['editindex'];
               $classes=$_POST['classes'];
        $terms=$_POST['terms'];
                $exams=$_POST['exams'];


        $sqltotal= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$editindex' AND class='$classes' AND term='$terms' AND exam='$exams'";
            $resulttotal = mysqli_query($db, $sqltotal);

            while($rowtotal = mysqli_fetch_array($resulttotal)){

              $total=$rowtotal['sum(marks)'];

              $sql = "UPDATE positioning SET total='$total' WHERE id='$editid' ";
              mysqli_query($db,$sql);
            header("location: generate_totalnow.php");
          }
        }

          //delete student    
        if(isset($_POST['delete'])){
              $deleteid = $_POST['deleteid'];
              
              $sql = "DELETE FROM positioning WHERE id='$deleteid' ";
              mysqli_query($db,$sql);
            header("location: generate_totalnow.php");
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
            <li class="active"><a href="admin.php">Dashboard</a></li>
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
              <a href="admin.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="generate_total.php" class="list-group-item"><span class="glyphicon glyphicon-list " aria-hidden="true"></span> Generate Total <span class="badge"></span></a>
              <a href="generate_position.php" class="list-group-item"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span> Generate Position <span class="badge"></span></a>
              <a href="selectallexamadmin.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> View All <span class="badge"></span></a>
              <a href="selectspecificadmin.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> View Per Subject <span class="badge"></span></a>
              <br>
              
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

                <input type="submit" name="add" class="btn btn-info" value="Generate total" data-toggle="modal" data-target="#add">
                <div><br></div>
                <!--table from here-->
                 <table class="table table-bordered">

                  <tr>
                  <th>Index</th>
                  <th>Name</th>
                  <th>Total</th>
                  </tr>
                  <?php 
                  $s_class=$_SESSION['classes'];
                  $s_term=$_SESSION['terms'];
                  //$s_subject=$_SESSION['subjects'];
                  $s_exam=$_SESSION['exams'];
                   $sql= "SELECT * FROM positioning WHERE class='$s_class' AND term='$s_term' AND exam='$s_exam'";
                  
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $id=$row['id'];
                      $indexnumber=$row['indexnumber'];
                      $name=$row['name'];
                      $class=$row['class'];
                      $term=$row['term'];
                      $exam=$row['exam'];
                      $total=$row['total'];
                      ?>
                  <tr>  
                    <td><?php echo $indexnumber;?></td>             
                     <td><?php echo $name;?></td>
                     <td><?php echo $total;?></td>
                     <td>
                      <a href="#edit<?php echo $id;?>" data-toggle="modal"><button type='button' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button></a>
                      </td>
                      <td>
                        <a href="#delete<?php echo $id;?>" data-toggle="modal"><button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></a>
                      </td>
                     </tr>
        <!-- Edit Total -->
      <div id="edit<?php echo $id; ?>" class="modal fade" role="dialog">
            <form method="post">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title">Edit Total</h5><br>
                            <h5 class="modal-title">Index number: <?php echo $indexnumber; ?></h5><br>
                            <h5 class="modal-title">Class :<?php echo $_SESSION['classes']; ?></h5>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="classes" value="<?php echo $_SESSION['classes']; ?>">
                          <input type="hidden" name="terms" value="<?php echo $_SESSION['terms']; ?>">
                          <input type="hidden" name="exams" value="<?php echo $_SESSION['exams']; ?>">
                    <input type="hidden" name="editid" class="form-control" value="<?php echo $id; ?>">
                    <input type="hidden" name="editindex" class="form-control" value="<?php echo $indexnumber; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="update">Update  </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
              </form>
        </div>        
<!--End of Edit -->

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
        </div>
    </section>

              <!--footer-->
               <footer id="footer">
      <p>Copyright &copy; <?php echo date("Y"); ?> </p>
    </footer>
              <!--footer to here-->

     <!-- Add marks-->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
        <input type="hidden" name="classes" value="<?php echo $_SESSION['classes']; ?>">
        <input type="hidden" name="terms" value="<?php echo $_SESSION['terms']; ?>">
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
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="save" class="btn btn-primary">Generate</button>
      </div>

    </form>
    </div>
  </div>
</div>
<!--End of modal-->

          </div>
        </div>
      </div>
    </section>
    <!--to here-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
