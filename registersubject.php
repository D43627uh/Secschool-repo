<?php 
session_start();
    include 'server.php';

    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    }
    if(isset($_POST['register'])){

        //$subject=$_POST['subject'];
      $indexnumber=$_POST['indexnumber'];
      $name=$_POST['name'];
      $class=$_POST['class'];
        
        if (!empty($_POST['subject'])) {
          # code...

          foreach ($_POST['subject'] as $s) {
            # code...
            mysqli_query($db,"INSERT INTO allregister (indexnumber,name,class,subject) VALUES ('$indexnumber','$name','$class','".mysqli_real_escape_string($db,$s)."')");
          }
        }
        else
        {  
        $message = "Please select subject";
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
            <li class="active"><a href="portalstudent.php">Dashboard</a></li>
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <small> Subject registration</small></h1>
          </div>
        </div>
      </div>
    </header>
    

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="portalstudent.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              
            </div>

          </div>
          <form method="post">
          <div class="col-md-9">
            <?php 
                   $sql= "SELECT * FROM students WHERE indexnumber='".$_SESSION['username'] ."'";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $indexnumber=$row['indexnumber'];
                      $name=$row['name'];
                      $class=$row['class'];
                      ?>
                      <input type="hidden" name="indexnumber" value="<?php echo $indexnumber?>">
                      <input type="hidden" name="name" value="<?php echo $name?>">
                      <input type="hidden" name="class" value="<?php echo $class?>">
                   <?php
            }
          }
              ?>
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">General Overview</h3>
              </div>
              <!--From here-->
              <!--table from here-->
                 <table class="table table-bordered">

                  <tr>
                  <th>Select Subjects</th>
                  
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
                   <td>
                      <input type="checkbox" name="subject[]" value="<?php echo $name;?>">  <?php echo $name;?> 
                   </td>
                        
                     
                     </tr>
                   <?php
            }
          }
              ?>

                 </table>
                <!--End of table-->

                <!--to here-->
              </div>
               <input type="submit" name="register" value="Register" class="btn btn-info">
              </div>

              </form>
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
