<?php 
    session_start();
    include 'server.php';
    if (isset($_POST['login_btn'])) {

        $username=$_POST['username'];
        $password=$_POST['password'];
        if(empty($_POST["username"]))  
      {  
         $username_error = "<p>Please Enter Username</p>";  
      }   

        if(empty($_POST["password"]))  
      {  
           $password_error = "<p>Please Enter Password</p>";  
      } 
      else
      {

        
        $sql= "SELECT * FROM users WHERE username='$username'";
       
       $result=mysqli_query($db,$sql);

        if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {

                    if(password_verify($password, $row['password'])){
              
                      
                      $category=$row['category'];

                      if($category=="teacher")
                      {
                         $_SESSION['username']=$username;
            header("location: portalteacher.php");
                      }
                      else if($category=="administrator")
                      {
                         $_SESSION['username']=$username;
            header("location: admin.php");

                      }
                      else if($category=="student")
                      {
                         $_SESSION['username']=$username;
            header("location: portalstudent.php");

                      }
                      else if($category=="admission")
                      {
                         $_SESSION['username']=$username;
            header("location: admission.php");

                      }

                    } 
                  }
        }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account Login</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>

    <section id="main">
      <div class="container">
        <div class="form-style-10">
      <!--<header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h5 class="text-center"> Account Login</h5>
          </div>
        </div>
      </div>
    </header>-->
    <img src="profile/paulboitlogo.jpg" style="margin-left: 425px">
    <div>
      <br>
      <br>
    </div>
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form method="post">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter Username">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
                  <input type="submit" name="login_btn" value="Login" class="btn btn-info btn-block">
              </form>
          </div>
        </div>
        <br>
    <!--<header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h6 class="text-center">Copyright &copy; <?php echo date("Y"); ?></h6>
          </div>
        </div>
      </div>
    </header>-->
      </div>
      </div>
    </section>


  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
