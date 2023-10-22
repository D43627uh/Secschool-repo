<?php 
   session_start();
    include 'server.php'; 
    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    }

    if (isset($_POST['save'])) {

        $usercategory=$_POST['usercategory'];
        $indexnumber=$_POST['indexnumber'];
        $sname=$_POST['sname'];
        $class=$_POST['class'];
        $stream=$_POST['stream'];
        $house=$_POST['house'];
        $county=$_POST['county'];
        $gender=$_POST['gender'];
        //$contact=$_POST['contact'];
        $acyear=$_POST['acyear'];
        $password=$_POST['password'];
        $confirmpassword=$_POST['confirmpassword'];
        $kcmarks=$_POST['kcmarks'];
        $kcgrade=$_POST['kcgrade'];
        $gname=$_POST['gname'];
        $gcontact=$_POST['gcontact'];

      
/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            
        }else*/ if ($password == $confirmpassword) {
            # code...
            $sql1= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
        $result1=mysqli_query($db,$sql1);

        if (mysqli_num_rows($result1)>0) {

           $message = "Username already exists please provide a new one";
            echo "<script type='text/javascript'>alert('$message');</script>";
            
        }else{

            //$password=md5($password);
            $password=password_hash($password, PASSWORD_DEFAULT);
            $sql="INSERT INTO students (indexnumber,name,class,stream,house,county,gender,kcmarks,kcgrade,gname,gcontact,password) VALUES ('$indexnumber','$sname','$class','$stream','$house','$county','$gender','$kcmarks','$kcgrade','$gname','$gcontact','$password')";
            $sql2="INSERT INTO users (category,username,password) VALUES ('$usercategory','$indexnumber','$password')";
            mysqli_query($db,$sql);
            mysqli_query($db,$sql2);
            header("location: addstudent.php");
          }
       }   
          
}


          //delete student    
        if(isset($_POST['delete'])){
              $deleteid = $_POST['deleteid'];

               $sqluser= "SELECT * FROM students WHERE id='$deleteid'";
            $resultuser=mysqli_query($db,$sqluser);
             while ($rowuser=mysqli_fetch_assoc($resultuser)) {
              $indexnumber=$rowuser['indexnumber'];
            
              
              $sql = "DELETE FROM students WHERE id='$deleteid' ";
              $sqldel = "DELETE FROM users WHERE username='$indexnumber'";
              mysqli_query($db,$sql);
              mysqli_query($db,$sqldel);
            header("location: addstudent.php");
            }
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
              <a href="admission.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <br>
              <form method="post">
               <div class="form-group">
      <?php 
          $sql= "SELECT * FROM classes";
              $result = mysqli_query($db, $sql);
              ?>
              <select name="class" class="form-control">

            <?php while($row = mysqli_fetch_array($result)):;?>

            <option><?php echo $row['name'];?></option>

            <?php endwhile;?>

        </select>
              <?php

        ?>
    </div>
    <br>
    
      <input type="submit" name="selectclass" value="Select Class" class="btn btn-info">
    </form>
              <!--<a href="registersubject.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> Subject Registration</span> </a>-->
              
            </div>

          </div>
          
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Students</h3>

              </div>
              <br>
              <div class="col-md-6">
                <input type="submit" name="add" class="btn btn-info" value="Add New Student" data-toggle="modal" data-target="#add"><div><br></div>
              </div>
              <div class="col-md-6">
                <!--<input type="text" name="search" class="form-control" placeholder="Search student">-->
              </div>
                <div><br></div>
                <?php
                if (isset($_POST['selectclass'])) {
                  # code...
                  $class=$_POST['class'];
                  $_SESSION['class']=$class;
                   header("location: addstudent_perclass.php");
                }
                  ?>
                  
                <!--table from here-->
                 <table class="table table-bordered">

                  <tr>
                  <th>Admission</th>
                  <th>Name</th>
                  <th>Class</th>
                  </tr>
                  <?php 
                  // This first query is just to get the total count of rows
$sql = "SELECT COUNT(id) FROM students";
$query = mysqli_query($db, $sql);
$row = mysqli_fetch_row($query);
// Here we have the total row count
$rows = $row[0];
// This is the number of results we want displayed per page
$page_rows = 20;
// This tells us the page number of our last page
$last = ceil($rows/$page_rows);
// This makes sure $last cannot be less than 1
if($last < 1){
  $last = 1;
}
// Establish the $pagenum variable
$pagenum = 1;
// Get pagenum from URL vars if it is present, else it is = 1
if(isset($_GET['pn'])){
  $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
// This makes sure the page number isn't below 1, or more than our $last page
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}
// This sets the range of rows to query for the chosen $pagenum
$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
// This is your query again, it is for grabbing just one page worth of rows by applying $limit
$sql= "SELECT * FROM students $limit";
$result=mysqli_query($db,$sql);

// This shows the user what page they are on, and the total number of pages
$textline1 = "(<b>$rows</b>)";
$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
// Establish the $paginationCtrls variable
$paginationCtrls = '';
// If there is more than 1 page worth of results
if($last != 1){
  /* First we check if we are on page one. If we are then we don't need a link to 
     the previous page or the first page so we do nothing. If we aren't then we
     generate links to the first page, and to the previous page. */
  if ($pagenum > 1) {
        $previous = $pagenum - 1;
    $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
    // Render clickable number links that should appear on the left of the target page number
    for($i = $pagenum-4; $i < $pagenum; $i++){
      if($i > 0){
            $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
      }
      }
    }
  // Render the target page number, but without it being a link
  $paginationCtrls .= ''.$pagenum.' &nbsp; ';
  // Render clickable number links that should appear on the right of the target page number
  for($i = $pagenum+1; $i <= $last; $i++){
    $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
    if($i >= $pagenum+4){
      break;
    }
  }
  // This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a> ';
    }
}
$list = ''; 
while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                      
                    $id=$row['id'];
                $indexnumber=$row['indexnumber'];
                $name=$row['name'];
                $class=$row['class'];
                $stream=$row['stream'];
                $house=$row['house'];
                $county=$row['county'];
                $gender=$row['gender'];
                $gname=$row['gname'];
                $gcontact=$row['gcontact'];

$list .= '<p><a href="addstudent.php?id='.$id.'"> </a> </p>';
                      ?>
                  <tr>  
                    <td><?php echo $indexnumber;?></td>             
                     <td><?php echo $name;?></td>
                   
                     <td><?php echo $class;?></td>
                     
                     <td>
                      <a href="#edit<?php echo $id;?>" data-toggle="modal"><button type='button' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></button></a>
                      </td>
                      <td>
                        <form method="get" action="admission_edit.php">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="forward"  value="Edit">
                        </form>
                     </td>
                      <td>
                        <a href="#delete<?php echo $id;?>" data-toggle="modal"><button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></a>
                      </td>
                     </tr>
        <!-- View Student -->
      <div id="edit<?php echo $id; ?>" class="modal fade" role="dialog">
            <form method="post">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <center>
                              <label>STUDENT DETAILS</label>
                            </center>  
                        </div>
                        <div class="modal-body">
                          <center>
                             
                            <br>
                            <label>Name: </label> <?php echo $name; ?>
                            <br>
                            <label>Admission number: </label> <?php echo $indexnumber; ?>
                            <br>
                            <label>Class: </label> <?php echo $class; ?>
                            <br>
                            <label>Stream: </label> <?php echo $stream; ?>
                            <br>
                            
                            <label>House: </label> <?php echo $house; ?>
                            <br>
                            <label>Gender: </label> <?php echo $gender; ?>
                            
                            <br>
                            <label>County: </label> <?php echo $county; ?>
                            
                            <br>
                            <label>GUARDIAN DETAILS</label>
                            <br>
                            <label>Name: </label> <?php echo $gname; ?>
                            <br>
                            <label>Contact: </label> <?php echo $gcontact; ?>
                            <br>

                          </center>
                          
                        </div>
                        <div class="modal-footer">
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
        
              ?>
              <tr>
                <td>
                  <div class="row">

              <div class="col-12 col-md-12">
                <br>
  
              <p><?php echo $textline2; ?></p>
              <p><?php echo $list; ?></p>

          <div id="pagination_controls"><?php echo $paginationCtrls; ?></div><br>
  </div>
  </div>
        
                </td>
              </tr>
                       </table>
                <!--End of table-->
              </div>
              </div>


              </div>
        </div>

    </section>

    <!-- Add Student -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Student</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="usercategory" value="student">
        <table class="table">
          <tr>
            
          </tr>
          <tr>
            <td width="100px">Admssion</td>
            <td><input type="text" name="indexnumber" class="form-control" required></td>
            <td width="100px">&nbsp; Name</td>
            <td><input type="text" name="sname" class="form-control" required></td>
          </tr>
          <tr>
            <td width="100px">Class</td>
            <td>
              <?php 
          $sql= "SELECT * FROM classes";
              $result = mysqli_query($db, $sql);
              ?>
              <select name="class" class="form-control">

            <?php while($row = mysqli_fetch_array($result)):;?>

            <option><?php echo $row['name'];?></option>

            <?php endwhile;?>

        </select>
              <?php

        ?>
          </td>
          <td width="100px">Stream</td>
            <td>
              <?php 
          $sql= "SELECT * FROM streams";
              $result = mysqli_query($db, $sql);
              ?>
              <select name="stream" class="form-control">

            <?php while($row = mysqli_fetch_array($result)):;?>

            <option><?php echo $row['name'];?></option>

            <?php endwhile;?>

        </select>
              <?php

        ?>
          </td>
        </tr>
        <tr>
          
          <td>Gender</td>
            <td>
              <select name="gender" class="form-control">
                <option>Male</option>
                <option>Female</option>
              </select>
            </td>
            <td>House</td>
            
             <td><input type="text" name="house" class="form-control" required></td>
            
          </tr>
          
          
          <tr>
           
          <td width="100px">&nbsp; County</td>
            <td><input type="text" name="county" class="form-control" required></td>
          </tr>
          
            <!--<td>Password</td>-->
            <input type="hidden" name="password" value="student123" class="form-control">
            <input type="hidden" name="confirmpassword" value="student123" class="form-control">
          
          <tr>
            <td><label>KCPE details:</label></td>
          </tr>
          
          <tr>
            <td>Marks</td>
            <td><input type="text" name="kcmarks" class="form-control" required></td>
            <td width="100px">&nbsp; Grade</td>
            <td><input type="text" name="kcgrade" class="form-control" required></td>
          </tr>

          <tr>
            <td><label>Guardian details:</label></td>
          </tr>
          
          <tr>
            <td>Name</td>
            <td><input type="text" name="gname" class="form-control" required></td>
            <td width="100px">&nbsp; Contact</td>
            <td><input type="text" name="gcontact" class="form-control" required></td>
          </tr>
        </table>
    </div>

    <div class="modal-footer">
      <button type="submit" name="save" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
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
