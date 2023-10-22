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
    if(isset($_SESSION["terms"])){
     $_SESSION['terms'];
    }
    if(isset($_SESSION["exams"])){
     $_SESSION['exams'];
    } 
    if(isset($_SESSION["acyear"])){
     $_SESSION['acyear'];
    } 

    $s_class=$_SESSION['classes'];
      $s_term=$_SESSION['terms'];
      $s_exam=$_SESSION['exams']; 
      $s_acyear=$_SESSION['acyear'];  

    $image="profile/paulboitlogo.jpg";
    //$image="profile/logo.png";
    //$pdf=new FPDF('p','mm','A4');
       $pdf=new FPDF('p','mm',array(360,360)); 
        $pdf->AddPage();

        $pdf->setFont('Arial','B',14);
  
  //$pdf->cell(180, 0, "", 0, 1, 'C');
  $pdf->cell(330, 10, "PAUL BOIT BOYS HIGH SCHOOL", 0, 1, 'C');

  $pdf->setFont('Arial','',11);
  $pdf->cell(330, 7, "P.O BOX 277, ELDORET", 0, 1, 'C');
  $pdf->cell(330, 7, "info@paulboithigh.sc.ke || www.paulboithigh.sc.ke", 0, 1, 'C');

 // $pdf->cell(300, 7, "RESULT ", 0, 1, 'C');


  
  $pdf-> Image($image,10,5,35,35); 
//$pdf-> Image($image,280,5,35,35);

$pdf->cell(180, 5, "", 0, 1, 'C');

$pdf->cell(70, 10, "", 0, 0, 'C');
$pdf->cell(50, 10,$s_class, 1, 0, 'C');
$pdf->cell(50, 10,$s_term, 1, 0, 'C');
  $pdf->cell(50, 10,$s_acyear, 1, 0, 'C');

  $sqlmarks= "SELECT * FROM exams WHERE priority='$s_exam'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $examname=$rowmarks['name'];
  $pdf->cell(50, 10,$examname, 1, 1, 'C');
  vpopmail_del_user(PDF_add_note(pdfdoc, llx, lly, urx, ury, contents, title, icon, open), domain)
}
}

$pdf->cell(180, 5, "", 0, 1, 'C');

$pdf->setFont('Arial','',8);
$pdf->cell(15, 10,"Form/Pos", 1, 0, 'C');
$pdf->cell(15, 10,"Pos/Class", 1, 0, 'C');
$pdf->cell(15, 10,"Adm", 1, 0, 'C');
$pdf->cell(70, 10,"Name", 1, 0, 'C');
$pdf->cell(20, 10,"KCPE", 1, 0, 'C');
$pdf->cell(15, 10,"Math", 1, 0, 'C');
$pdf->cell(15, 10,"Eng", 1, 0, 'C');
$pdf->cell(15, 10,"Kisw", 1, 0, 'C');
$pdf->cell(15, 10,"Phys", 1, 0, 'C');
$pdf->cell(15, 10,"Chem", 1, 0, 'C');
$pdf->cell(15, 10,"Bio", 1, 0, 'C');
$pdf->cell(15, 10,"B/Studies", 1, 0, 'C');
$pdf->cell(15, 10,"Agric", 1, 0, 'C');
$pdf->cell(15, 10,"Hist", 1, 0, 'C');
$pdf->cell(15, 10,"C.R.E", 1, 0, 'C');
$pdf->cell(15, 10,"Geog", 1, 0, 'C');
$pdf->cell(15, 10,"Total", 1, 0, 'C');
$pdf->cell(15, 10,"Mean", 1, 0, 'C');
$pdf->cell(15, 10,"Grade", 1, 1, 'C');

$sqlpos="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM positioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' ORDER BY total DESC) s";
                   
              $resultpos=mysqli_query($db,$sqlpos);

              if (mysqli_num_rows($resultpos)!=0) {
                   
                  while ($rowpos=mysqli_fetch_assoc($resultpos)) {
                      
                      
                      $id=$rowpos['id'];
                      $name=$rowpos['name'];
                      $indexnumber=$rowpos['indexnumber'];
                      $class=$rowpos['class'];
                      $stream=$rowpos['stream'];
                      $total=$rowpos['total'];
                      $rank=$rowpos['rank'];

                      $pdf->cell(15, 10,$rank,1,0,'C');
                      $pdf->cell(0.005);


                      //class position
                      $sqlclasspos="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM positioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  term='$s_term' AND class='$s_class' AND stream='$stream' AND exam='$s_exam' AND  acyear='$s_acyear' ORDER BY total DESC) s";
  $resultclasspos=mysqli_query($db,$sqlclasspos);
  if (mysqli_num_rows($resultclasspos)!=0) {
                   
                  while ($rowclasspos=mysqli_fetch_assoc($resultclasspos)) {
                      $classindexnumber=$rowclasspos['indexnumber'];
                      $class=$rowclasspos['class'];
                      $stream=$rowclasspos['stream'];
                      $classrank=$rowclasspos['rank'];

    if($classindexnumber==$indexnumber)
    {
      $pdf->cell(15, 10,$classrank,1,0,'C');
                      $pdf->cell(0.005);

      }
}
 }

//end of class position
                      $pdf->cell(15, 10,$indexnumber,1,0,'C');
                      $pdf->cell(0.005);
                      $pdf->cell(70, 10,$name,1,0,'C');

         $sqlmarks= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
                    $resultmarks = mysqli_query($db, $sqlmarks);

                    if (mysqli_num_rows($resultmarks)!=0) {
                    while($rowmarks= mysqli_fetch_array($resultmarks)){
                      $kcmarks=$rowmarks['kcmarks'];
                      $kcgrade=$rowmarks['kcgrade']; 
                      $pdf->cell(0.005);
                      $pdf->cell(20, 10,$kcmarks." ".$kcgrade,1,0,'C');

                    }
                  }else{
                    $pdf->cell(0.005);
                      $pdf->cell(20, 10,"_",1,0,'C');
                  }

      $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Mathematics'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
           $grade=$rowmarks['grade'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$marks." ".$grade,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      }
        $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='English'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
           $grade=$rowmarks['grade'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$marks." ".$grade,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 
        $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Kiswahili'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
           $grade=$rowmarks['grade'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$marks." ".$grade,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

         $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Physics'";
        $resultmarks = mysqli_query($db, $sqlmarks);

        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
           $grade=$rowmarks['grade'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$marks." ".$grade,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

        $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Chemistry'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
           $grade=$rowmarks['grade'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$marks." ".$grade,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 
       $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Biology'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
           $grade=$rowmarks['grade'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$marks." ".$grade,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 
        $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Business Studies'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
           $grade=$rowmarks['grade'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$marks." ".$grade,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

        $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Agriculture'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
           $grade=$rowmarks['grade'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$marks." ".$grade,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

        $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='History'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
           $grade=$rowmarks['grade'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$marks." ".$grade,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

        $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='C.R.E'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
           $grade=$rowmarks['grade'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$marks." ".$grade,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 

        $sqlmarks= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND subject='Geography'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $marks=$rowmarks['marks'];
           $grade=$rowmarks['grade'];
          $pdf->cell(0.005);
          $pdf->cell(15, 10,$marks." ".$grade,1,0,'C');
        }
      }else{
        $pdf->cell(0.005);
          $pdf->cell(15, 10,"_",1,0,'C');
      } 


          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND term='$s_term' AND exam='$s_exam' AND  class='$s_class'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $marks=$total/$count;
                         include 'grading.php';

                      }

        $pdf->cell(0.005);
        $pdf->cell(15, 10,$total,1,0,'C');
        $pdf->cell(0.005);
        $pdf->cell(15, 10,round($marks),1,0,'C');
        $pdf->cell(0.005);
        $pdf->cell(15, 10,$grade,1,1,'C');
        
    }
  }



$pdf->OutPut();
?>