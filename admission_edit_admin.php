<?php 
   session_start();
    include 'server.php'; 
    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    }

//edit student
      if(isset($_POST['update'])){
        $id=$_POST['id'];
        $idusers=$_POST['idusers'];
        $acyear=$_POST['acyear'];
        $indexnumber=$_POST['indexnumber'];
        $name=$_POST['name'];
        $class=$_POST['class'];
        $county=$_POST['county'];
        $gender=$_POST['gender'];
        $password=$_POST['password'];
        $confirmpassword=$_POST['confirmpassword'];
        $gname=$_POST['gname'];
        $gcontact=$_POST['gcontact'];
        if ($password == $confirmpassword) {

           $sqlfee= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
            $resultfee=mysqli_query($db,$sqlfee);
             while ($rowfee=mysqli_fetch_assoc($resultfee)) {
              $fee=$rowfee['fee'];
              $balance=$rowfee['balance'];
              $fees=$fee-$balance;

        
          
          $password=md5($password);
              $sql = "UPDATE students SET indexnumber='$indexnumber',name='$name',class='$class',county='$county',gender='$gender',contact='$contact',gname='$gname',gcontact='$gcontact',password='$password',acyear='$acyear',balance='$fees' WHERE id='$id'";//
                   $sqluserss= "UPDATE users SET username='$indexnumber' WHERE id='$idusers'";
                  mysqli_query($db,$sql);
              mysqli_query($db,$sqluserss);
            header("location: students.php");
        }
        }
        else if ($password != $confirmpassword) {
       $message = "The passwords do not match";
            echo "<script type='text/javascript'>alert('$message');</script>";
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
              <a href="students.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
            </div>

          </div>
          
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Edit</h3>

              </div>
               
                   <?php

        if (isset($_GET['id'])) {

              $id=$_GET['id'];

            $sql="SELECT * FROM students WHERE id='$id'";
          $result=mysqli_query($db,$sql);


          while($row = mysqli_fetch_array($result)){
                $id=$row['id'];
                $indexnumber=$row['indexnumber'];
                $name=$row['name'];
                $class=$row['class'];
                $county=$row['county'];
                $gender=$row['gender'];
                $gname=$row['gname'];
                $gcontact=$row['gcontact'];
                 $sqlusers="SELECT * FROM users WHERE username='$indexnumber'";
          $resultusers=mysqli_query($db,$sqlusers);


          while($rowusers = mysqli_fetch_array($resultusers)){
            $idusers=$rowusers['id'];
            ?>
            <table class="table">
                <form method="POST">
                  <tr>
                    <td width="150px">Admission number</td>
                    <input type="hidden" name="idusers" value="<?php echo $idusers; ?>">
                    <td><input type="text" class="form-control" name="indexnumber" value="<?php echo $indexnumber; ?>"></td>
                  </tr>
                  <tr>
                    <td width="150px">Name</td>
                    <td><input type="text" class="form-control" name="name" value="<?php echo $name; ?>"></td>
                  </tr>
                  
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                    
                    
                <tr>
                  <td width="150px">Class</td>
                  <td>
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
                    </td>
                </tr>
                 <tr>
            <td>Academic year</td>
             <td>
              <?php 
          $sql= "SELECT * FROM academic";
              $result = mysqli_query($db, $sql);
              ?>
              <select name="acyear" class="form-control">

            <?php while($row = mysqli_fetch_array($result)):;?>

            <option><?php echo $row['acyear'];?></option>

            <?php endwhile;?>

        </select>
              <?php

        ?>
          </td>
          </tr>
                <tr>
                  <td width="150px">County</td>
                  <td><input type="text" class="form-control" name="county" value="<?php echo $county; ?>"></td>
                </tr>

                <tr>
                  <td width="150px">Gender</td>
                  <td>
                     <select name="gender" class="form-control">
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                  </td>
                </tr>
                  <!--<td width="150px">Password</td>-->
                  <input type="hidden" class="form-control" value="student123" name="password">
                
                  <!--<td width="150px">Confirm Password</td>-->
                  <input type="hidden" class="form-control" value="student123" name="confirmpassword">
                
                <tr>
                  <td><label>Guardian details:</label></td>
                </tr>
                <tr>
                  <td width="150px">Guardian name</td>
                  <td><input type="text" class="form-control" name="gname" value="<?php echo $gname; ?>"></td>
                </tr>
                <tr>
                  <td width="150px">Guardian contact</td>
                  <td><input type="text" class="form-control" name="gcontact" value="<?php echo $gcontact; ?>"></td>
                </tr>

                <tr>
                    <td>
                    
                    <input type="submit" name="update" class="btn btn-info" value="Update">
                        
                    </td>
                </tr>
                </form>
            </table>
            <?php
          }
        }
        }
?>
               
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
          </div>
        </div>
      </div>
    </section>
    <!--to here-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
