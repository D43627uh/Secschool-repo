<?php 
   session_start();
    include 'server.php';
    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    } 

    if (isset($_POST['save'])) {

        # code...
        $name=$_POST['name'];

        if(empty($_POST["name"]))  
      {  
           $name_error = "<p>Please Enter Name</p>";  
      }  
      else if(!preg_match("/^[a-zA-Z ]*$/", $_POST["name"]))  
       {  
            $name_error = "<p>Only Letters and whitespace allowed</p>";  
       }  
    else
        {
            $sql1= "SELECT * FROM subjects WHERE name='$name'";
        $result1=mysqli_query($db,$sql1);

        if (mysqli_num_rows($result1)>0) {

           $message = "Subject name already exists please provide a new one";
            echo "<script type='text/javascript'>alert('$message');</script>";
            
        }else{
            
            $sql="INSERT INTO subjects (name) VALUES ('$name')";
            mysqli_query($db,$sql);

            header("location: subject.php");
 
        }
    }
}

//edit class   
        if(isset($_POST['update'])){
              $editid = $_POST['editid'];
              $editname = $_POST['editname'];
              
              $sql = "UPDATE subjects SET name='$editname'
                  WHERE id='$editid' ";
              mysqli_query($db,$sql);
            header("location: subject.php");
          }

          //Delete teacher    
        if(isset($_POST['delete'])){
              $deleteid = $_POST['deleteid'];
              
              $sql = "DELETE FROM subjects WHERE id='$deleteid' ";
              mysqli_query($db,$sql);
            header("location: subject.php");
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
              <a href="viewalladmin.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Exam Result <span class="badge"></span></a>
              <a href="class.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Class <span class="badge"></span></a>
              <a href="terms.php" class="list-group-item"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Term / Session <span class="badge"></span></a>
              <a href="subject.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Subject <span class="badge"></span></a>
              <a href="exam.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Exam Name <span class="badge"></span></a>
               <a href="promote.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Promote <span class="badge"></span></a><br>
              
            </div>

          </div>
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Subjects</h3>
              </div>
              <br>
              <!--<div class="panel-body">-->
                <input type="submit" name="add" class="btn btn-info" value="Add New Subject" data-toggle="modal" data-target="#add">
                <div><br></div>

                <!--table from here-->
                 <table class="table table-bordered">

                  <tr>
                  <!--<th>ID</th>-->
                  <th>Subject Name</th>
                  </tr>
                  <?php 
                   $sql= "SELECT * FROM subjects";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $id=$row['id'];
                      $name=$row['name'];
                      ?>
                  <tr>               
                     <!--<td><?php// echo $id;?></td>-->
                   
                     <td><?php echo $name;?></td>
                     <td>
                      <a href="#edit<?php echo $id;?>" data-toggle="modal"><button type='button' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button></a>
                      </td>
                      <td>
                        <a href="#delete<?php echo $id;?>" data-toggle="modal"><button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></a>
                      </td>
                     </tr>


 <!-- Edit Class -->
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
                    <input type="text" name="editname" class="form-control" value="<?php echo $name; ?>"><br>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="update">Update  </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
              </form>
        </div>        
<!--End of Edit Class-->

<!--Delete Class -->
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
                                <button type="submit" name="delete" class="btn btn-danger">YES</button>
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

    <!-- Add Class -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Subject</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
      <label>Enter Subject Name</label><input type="text" name="name" class="form-control">
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

          </div>
        </div>
      </div>
    </section>
    <!--to here-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
