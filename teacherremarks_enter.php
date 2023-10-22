<?php 
   session_start();
    include 'server.php'; 
    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    }

    if (isset($_POST['saveTeacher'])) {

        # code...
        $class=$_POST['class'];
        $stream=$_POST['stream'];
        $username=$_POST['username'];
        $subject=$_POST['subject'];
        $acyear=$_POST['acyear'];
        $grade=$_POST['grade'];
        $remarks=$_POST['remarks'];

       $sql1= "SELECT * FROM teachers WHERE username='$username'";
        $result1=mysqli_query($db,$sql1);

        if (mysqli_num_rows($result1)>0) {
          while ($row1=mysqli_fetch_assoc($result1)) {

          $name=$row1['name'];
          $initials=$row1['initials'];

            $sql="INSERT INTO teacherremarks(username,name,initials,class,stream,subject,acyear,grade,remarks) VALUES ('$username','$name','$initials','$class','$stream','$subject','$acyear','$grade','$remarks')";
            
            mysqli_query($db,$sql);
            
            header("location: teacherremarks_enter.php");
 }
        }
      }
    

//edit teacher    
        if(isset($_POST['updateTeacher'])){
              $editid = $_POST['id'];
              $grade = $_POST['grade'];
              $remarks = $_POST['remarks'];

              $sql = "UPDATE teacherremarks SET grade='$grade',remarks='$remarks' WHERE id='$editid' ";
              mysqli_query($db,$sql);
            header("location: teacherremarks_enter.php");
          }

          //Delete teacher    
        if(isset($_POST['deleteTeacher'])){
              $deleteid = $_POST['deleteid'];
              
              $sql = "DELETE FROM teacherremarks WHERE id='$deleteid' ";
              mysqli_query($db,$sql);
            header("location: teacherremarks_enter.php");
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
    <!--to here-->

    <!--from here-->
     
    

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="admin.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
             <?php
              include'portalteacher_sidebar.php';
              ?>
              
            </div>

          </div>
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">
                  <?php
                  echo $_SESSION['classes']." | ".$_SESSION['streams']." | ".$_SESSION['acyear']." | ".$_SESSION['subjects'];
                  ?>

                </h3>
              </div>
              <br>
              <!--<div class="panel-body">-->
                <input type="submit" name="addteacher" class="btn btn-info" value="Enter Remark" data-toggle="modal" data-target="#addTeacher">
                <div><br></div>

                <?php
                 $s_class=$_SESSION['classes'];
                 $s_stream=$_SESSION['streams'];
                  $s_subject=$_SESSION['subjects'];
                  $s_acyear=$_SESSION['acyear'];
                ?>

                <!--table from here-->
                 <table class="table table-bordered">

                  <tr>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Stream</th>
                  <th>Subject</th>
                  <th>Year</th>
                  <th>Grade</th>
                  <th>Remarks</th>
                  </tr>
                  <?php 
                   $sql= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$s_stream' AND subject='$s_subject'  AND acyear='$s_acyear'";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $id=$row['id'];
                      $name=$row['name'];
                      $class=$row['class'];
                      $stream=$row['stream'];
                      $subject=$row['subject'];
                      $acyear=$row['acyear'];
                      $grade=$row['grade'];
                      $remarks=$row['remarks'];
                      ?>
                  <tr>               
                     <td><?php echo $name;?></td>
                   <td><?php echo $class;?></td>
                   <td><?php echo $stream;?></td>
                   <td><?php echo $subject;?></td>
                   <td><?php echo $acyear;?></td>
                     <td><?php echo $grade;?></td>
                     <td><?php echo $remarks;?></td>
                     <td>
                      <a href="#edit<?php echo $id;?>" data-toggle="modal"><button type='button' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button></a>
                      </td>
                        <td>
                        <a href="#delete<?php echo $id;?>" data-toggle="modal"><button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></a>
                      </td>
                     </tr>


 <!-- Edit Teacher -->
        <div id="edit<?php echo $id; ?>" class="modal fade" role="dialog">
            <form method="post">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Details</h4>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id" value="<?php echo $id ?>">
                          <!--from here-->
                          <div class="form-group">
                          <label>Select Grade</label>
                        <select name="grade" class="form-control">
                          <option>A</option>
                          <option>A-</option>
                          <option>B+</option>
                          <option>B</option>
                          <option>B-</option>
                          <option>C+</option>
                          <option>C</option>
                          <option>C-</option>
                          <option>D+</option>
                          <option>D</option>
                          <option>D-</option>
                          <option>E</option>
                        </select>
                      </div>
                      <div class="form-group">
                      <label>Edit Remarks</label>
                      <textarea class="form-control" name="remarks" rows="2"></textarea>
                    </div>
                          <!--to here-->

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="updateTeacher">Update  </button>
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
                            <p>
                                <div class="alert alert-danger">Are you Sure you want Delete <strong><?php echo $name; ?>?</strong></p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="deleteTeacher" class="btn btn-danger">YES</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                            </div>
                        </div>
                </form>
                </div>
            </div>
        

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
    </section>

              <!--footer-->
               <footer id="footer">
      <p>Copyright &copy; <?php echo date("Y"); ?> </p>
    </footer>
              <!--footer to here-->

    <!-- Add Teacher -->
    <div class="modal fade" id="addTeacher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Assign Classes</h4>
      </div>
      <div class="modal-body">
       <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
        <input type="hidden" name="class" value="<?php echo $_SESSION['classes']; ?>">
        <input type="hidden" name="stream" value="<?php echo $_SESSION['streams']; ?>">
        <input type="hidden" name="subject" value="<?php echo $_SESSION['subjects']; ?>">
        <input type="hidden" name="acyear" value="<?php echo $_SESSION['acyear']; ?>">
        <div class="form-group">
          <label>Select Grade</label>
        <select name="grade" class="form-control">
          <option>A</option>
          <option>A-</option>
          <option>B+</option>
          <option>B</option>
          <option>B-</option>
          <option>C+</option>
          <option>C</option>
          <option>C-</option>
          <option>D+</option>
          <option>D</option>
          <option>D-</option>
          <option>E</option>
        </select>
      </div>
    <div class="form-group">
      <label>Enter Remarks</label>
      <textarea class="form-control" name="remarks" rows="2"></textarea>
    </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="saveTeacher" class="btn btn-primary">Save</button>
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
