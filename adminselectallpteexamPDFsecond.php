<?php 
   session_start();
    include 'server.php';
     require("library/fpdf.php");

    if(isset($_SESSION["username"])){
     $_SESSION['username'];
    }
    if(isset($_SESSION["classes"])){
     $_SESSION['classes'];
   }
    if(isset($_SESSION["categories"])){
     $_SESSION['categories'];
    }
    if(isset($_SESSION["exams"])){
     $_SESSION['exams'];
    } 
    if(isset($_SESSION["acyear"])){
     $_SESSION['acyear'];
    } 

    $s_class=$_SESSION['classes'];
      $s_category=$_SESSION['categories'];
      $s_exam=$_SESSION['exams']; 
      $s_acyear=$_SESSION['acyear'];  

    $image1="profile/kenya.png";
    $image="profile/logo.png";
    //$pdf=new FPDF('p','mm','A4');
       $pdf=new FPDF('p','mm',array(345,345)); 
        $pdf->AddPage();

        $pdf->setFont('Arial','B',14);
  
  //$pdf->cell(180, 0, "", 0, 1, 'C');
  $pdf->cell(310, 10, "TAMBACH TEACHERS' COLLEGE", 0, 1, 'C');

  $pdf->setFont('Arial','',11);
  $pdf->cell(310, 7, "P.O PRIVATE BAG", 0, 1, 'C');
  $pdf->cell(310, 7, "ITEN-TAMBACH", 0, 1, 'C');

  $pdf->cell(310, 7, "RESULT TRANSCRIPT", 0, 1, 'C');


  
  $pdf-> Image($image1,10,5,35,35); 
$pdf-> Image($image,295,5,35,35);

$pdf->cell(180, 5, "", 0, 1, 'C');

$pdf->cell(50, 10, "", 0, 0, 'C');
$pdf->cell(50, 10,$s_class, 1, 0, 'C');
  $pdf->cell(50, 10,$s_category, 1, 0, 'C');
  $pdf->cell(50, 10,$s_acyear, 1, 0, 'C');
  $pdf->cell(50, 10,$s_exam, 1, 1, 'C');

$pdf->cell(180, 5, "", 0, 1, 'C');

$pdf->setFont('Arial','',8);
$pdf->cell(15, 10,"Adm", 1, 0, 'C');
$pdf->cell(70, 10,"Name", 1, 0, 'C');
$pdf->cell(15, 10,"Education", 1, 0, 'C');
$pdf->cell(15, 10,"English", 1, 0, 'C');
$pdf->cell(15, 10,"Kiswahili", 1, 0, 'C');
$pdf->cell(15, 10,"P.E", 1, 0, 'C');
$pdf->cell(15, 10,"Maths", 1, 0, 'C');
$pdf->cell(15, 10,"I.Science", 1, 0, 'C');
$pdf->cell(15, 10,"CRE", 1, 0, 'C');
$pdf->cell(15, 10,"IRE", 1, 0, 'C');
$pdf->cell(15, 10,"S/Studies", 1, 0, 'C');
$pdf->cell(15, 10,"C/Art", 1, 0, 'C');
$pdf->cell(15, 10,"Agric", 1, 0, 'C');
$pdf->cell(15, 10,"Home/S", 1, 0, 'C');
$pdf->cell(15, 10,"Music", 1, 0, 'C');
$pdf->cell(15, 10,"ICT", 1, 0, 'C');
$pdf->cell(15, 10,"T.Points", 1, 0, 'C');
$pdf->cell(15, 10,"Grade", 1, 1, 'C');

$sqlpos="SELECT * FROM students WHERE  category='$s_category' AND  class='$s_class'";
                   
              $resultpos=mysqli_query($db,$sqlpos);

              if (mysqli_num_rows($resultpos)!=0) {
                   
                  while ($rowpos=mysqli_fetch_assoc($resultpos)) {
                      
                      
                      $id=$rowpos['id'];
                      $name=$rowpos['name'];
                      $indexnumber=$rowpos['indexnumber'];
                      $class=$rowpos['class'];
                      $pdf->cell(15, 10,$indexnumber,1,0,'C');
                      $pdf->cell(0.005);
                      $pdf->cell(70, 10,$name,1,0,'C');



      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Education'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      }
        $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='English'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 
        $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Kiswahili'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
         $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

         $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Physical Education'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

        $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Mathematics'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 
        $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Integrated Science'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

        $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='CRE'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
         $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

        $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='IRE'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
         $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

        $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Social Studies'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
         $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

        $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Creative Art'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Agriculture'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Home Science'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 
      $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Music'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

        $sqlmarks= "SELECT * FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='ICT'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $points=$rowmarks['points'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$points,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

         $sqlsum= "SELECT sum(points) FROM examptemarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class'";
                        $resultsum = mysqli_query($db, $sqlsum);

                        while($rowsum= mysqli_fetch_array($resultsum)){

                          $tgrade=$rowsum['sum(points)'];
                         if ($tgrade >=1 && $tgrade <=22) {
                            $grade="Distinction";
                          }
                          else if ($tgrade >=23 && $tgrade <50) {
                            $grade="Credit";
                          }
                           else if ($tgrade >=50 && $tgrade <69) {
                            $grade="Pass";
                          }
                          else if ($tgrade >=69 && $tgrade <=100) {
                            $grade="Fail";
                          }
                          else{
                            $grade="_";
                          }
                      }
                      $pdf->cell(0.005);
        $pdf->cell(15, 10,$tgrade,1,0,'C');
        $pdf->cell(0.005);
        $pdf->cell(15, 10,$grade,1,1,'C');
        
    }
  }



$pdf->OutPut();
?>