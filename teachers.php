<?php 
   session_start();
    include 'server.php'; 
    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    }

    if (isset($_POST['saveTeacher'])) {

        # code...
        $category=$_POST['category'];
        $name=$_POST['name'];
        $initials=$_POST['nameinitials'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $confirmpassword=$_POST['confirmpassword'];

        if(empty($_POST["name"]))  
      {  
           $name_error = "<p>Please Enter Name</p>";  
      }  
      else  
      {  
           if(!preg_match("/^[a-zA-Z ]*$/", $_POST["name"]))  
           {  
                $name_error = "<p>Only Letters and whitespace allowed</p>";  
           }  
      } 

        if(empty($_POST["username"]))  
      {  
           $username_error = "<p>Please Enter Username</p>";  
      }   

        if(empty($_POST["password"]))  
      {  
           $password_error = "<p>Please Enter Password</p>";  
      }   

        if(empty($_POST["confirmpassword"]))  
      {   
           $password2_error = "<p>Please Enter Confirm password</p>";  

      } else{

        if ($password == $confirmpassword) {
            # code...
            $sql1= "SELECT * FROM teachers WHERE username='$username'";
        $result1=mysqli_query($db,$sql1);

        if (mysqli_num_rows($result1)>0) {

           $message = "Username already exists please provide a new one";
            echo "<script type='text/javascript'>alert('$message');</script>";
            
        }else{
            $password=md5($password);
            $sql="INSERT INTO teachers (name,initials,username,password) VALUES ('$name','$initials','$username','$password')";
            $sql2="INSERT INTO users (category,username,password) VALUES ('$category','$username','$password')";
            mysqli_query($db,$sql);
            mysqli_query($db,$sql2);

            header("location: teachers.php");
 
        }
    }
    else if ($password != $confirmpassword) {
       $message = "The passwords do not match";
            echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
}

//edit teacher    
        if(isset($_POST['updateTeacher'])){
              $editid = $_POST['editid'];
              $editname = $_POST['editname'];
              $editinitials = $_POST['editnameinitials'];
              $editusername= $_POST['editusername'];
              $editpassword = $_POST['editpassword'];
              $password=md5($password);
              $sql = "UPDATE teachers SET name='$editname',initials='$editinitials',username='$editusername',password='$editpassword'
                  WHERE id='$editid' ";
              mysqli_query($db,$sql);
            header("location: teachers.php");
          }

          //Delete teacher    
        if(isset($_POST['deleteTeacher'])){
              $deleteid = $_POST['deleteid'];
              
              $sql = "DELETE FROM teachers WHERE id='$deleteid' ";
              mysqli_query($db,$sql);
            header("location: teachers.php");
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
              include'admin_sidebar.php';
              ?>
              
            </div>

          </div>
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Teachers</h3>
              </div>
              <br>
              <!--<div class="panel-body">-->
                <input type="submit" name="addteacher" class="btn btn-info" value="Add New Teacher" data-toggle="modal" data-target="#addTeacher">
                <div><br></div>

                <!--table from here-->
                 <table class="table table-bordered">

                  <tr>
                  <th>Name</th>
                  <th>Initials</th>
                  <th>Username</th>
                  </tr>
                  <?php 
                   $sql= "SELECT * FROM teachers";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $id=$row['id'];
                      $name=$row['name'];
                      $initials=$row['initials'];
                      $username=$row['username'];
                      //$password=$row['password'];
                      //$password=md5($row['password']);
                      ?>
                  <tr>               
                     <td><?php echo $name;?></td>
                   <td><?php echo $initials;?></td>
                     <td><?php echo $username;?></td>
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
                    <input type="hidden" name="editid" class="form-control" value="<?php echo $id; ?>"><br>
                    <label>Name</label>
                    <input type="text" name="editname" class="form-control" value="<?php echo $name; ?>"><br>
                    <label>Name Initials</label>
                    <input type="text" name="editnameinitials" class="form-control" value="<?php echo $initials; ?>"><br>
                    <label>Username</label>
                    <input type="text" name="editusername" class="form-control" value="<?php echo $username; ?>"><br>
                    <input type="hidden" name="editpassword" value="teacher123">
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
        <h4 class="modal-title" id="myModalLabel">Add New Teacher</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="category" value="teacher">
        <div class="form-group">
      <label>Enter the Name</label><input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
      <label>Enter Name Initials</label><input type="text" name="nameinitials" class="form-control">
    </div>
    <div class="form-group">
      <label>Enter the Username</label>
      <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
     
      <input type="hidden" name="password" value="teacher123" class="form-control">
    </div>
    <div class="form-group">
      <input type="hidden" name="confirmpassword" value="teacher123" class="form-control">
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
