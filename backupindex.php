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



            $sqlpos="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM positioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  term='$s_term' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' ORDER BY total DESC) s";
                   
              $resultpos=mysqli_query($db,$sqlpos);

$image1="profile/kenya.png";
$image="profile/logo.png";
        //$pdf=new FPDF('p','mm','A4');
       $pdf=new FPDF('p','mm',array(200,256));
      //$pdf=new FPDF('p','mm',array(200,205)); 
        $pdf->AddPage();
 
  

              if (mysqli_num_rows($resultpos)!=0) {
                   
                  while ($rowpos=mysqli_fetch_assoc($resultpos)) {
                      
                      
                      $id=$rowpos['id'];
                      $name=$rowpos['name'];
                      $indexnumber=$rowpos['indexnumber'];
                      $class=$rowpos['class'];
                      $total=$rowpos['total'];
                      $rank=$rowpos['rank'];

     

  $pdf->setFont('Arial','B',14);
  
  //$pdf->cell(180, 0, "", 0, 1, 'C');
  $pdf->cell(180, 10, "GREAT RIFT SEC SCHOOL", 0, 1, 'C');

  $pdf->setFont('Arial','',11);
  $pdf->cell(180, 7, "P.O PRIVATE BAG", 0, 1, 'C');
  $pdf->cell(180, 7, "ELDORET", 0, 1, 'C');

  $pdf->cell(180, 7, "RESULT TRANSCRIPT", 0, 1, 'C');
  
  $pdf-> Image($image1,10,5,35,35); 
$pdf-> Image($image,150,5,35,35);

  $pdf->setFont('Arial','',10);
                
    $pdf->cell(90, 10, "NAME : ".$rowpos['name'], 1, 0, 'C');
    $pdf->cell(90, 10,"ADMISSION : ". $indexnumber, 1, 1, 'C');


    $pdf->cell(90, 10, "CLASS : ".$s_class, 1, 0, 'C');
    $pdf->cell(90, 10,"EXAM NAME : ". $s_exam, 1, 1, 'C');

    $pdf->cell(70, 2, "", 0, 1, 'C');

    $pdf->setFont('Arial','B',10);
    $pdf->cell(20, 10, "Code", 1, 0, '');
    $pdf->cell(70, 10, "Subject", 1, 0, '');
    $pdf->cell(70, 10, "Marks", 1, 0, '');
    $pdf->cell(20, 10, "Grade", 1, 1, '');
 
    $pdf->setFont('Arial','',10);

$pdf->cell(20, 10, "1011", 1, 0, '');
    $pdf->cell(70, 10, "Mathematics", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='Mathematics'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        
                    $pdf->cell(70, 10, $marks, 1, 0, '');
                    $pdf->cell(20, 10, $grade, 1, 1, '');    
            }
        }
        else
                    {
                    $pdf->cell(70, 10, "_", 1, 0, '');
                    $pdf->cell(20, 10, "_", 1, 1, '');
                    }
    $pdf->cell(20, 10, "1012", 1, 0, '');
    $pdf->cell(70, 10, "English", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='English'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade'];     
                    $pdf->cell(70, 10, $marks, 1, 0, '');
                    $pdf->cell(20, 10, $grade, 1, 1, '');

            }
        }
        else
    {
    $pdf->cell(70, 10, "_", 1, 0, '');
    $pdf->cell(20, 10, "_", 1, 1, '');
    }
$pdf->cell(20, 10, "1013", 1, 0, '');
     $pdf->cell(70, 10, "Kiswahili", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='Kiswahili'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                    $pdf->cell(70, 10, $marks, 1, 0, '');
                    $pdf->cell(20, 10, $grade, 1, 1, '');

            }
        }
        else
    {
    $pdf->cell(70, 10, "_", 1, 0, '');
    $pdf->cell(20, 10, "_", 1, 1, '');
    }
$pdf->cell(20, 10, "1014", 1, 0, '');
     $pdf->cell(70, 10, "Physics", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Physics'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        
                    $pdf->cell(70, 10, $marks, 1, 0, '');
                    $pdf->cell(20, 10, $grade, 1, 1, '');

            }
        }
        else
    {
    $pdf->cell(70, 10, "_", 1, 0, '');
    $pdf->cell(20, 10, "_", 1, 1, '');
    }
    $pdf->cell(20, 10, "2011", 1, 0, '');
    $pdf->cell(70, 10, "Chemistry", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term'  AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Chemistry'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        
                    $pdf->cell(70, 10, $marks, 1, 0, '');
                    $pdf->cell(20, 10, $grade, 1, 1, '');

            }
        }
        else
    {
    $pdf->cell(70, 10, "_", 1, 0, '');
    $pdf->cell(20, 10, "_", 1, 1, '');
    }
    $pdf->cell(20, 10, "2012", 1, 0, '');
    $pdf->cell(70, 10, "Agriculture", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Agriculture'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        
                    $pdf->cell(70, 10, $marks, 1, 0, '');
                    $pdf->cell(20, 10, $grade, 1, 1, '');

            }
        }
        else
    {
    $pdf->cell(70, 10, "_", 1, 0, '');
    $pdf->cell(20, 10, "_", 1, 1, '');
    }
    //end of subject
    $pdf->cell(20, 10, "3011", 1, 0, '');
    $pdf->cell(70, 10, "History", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term'  AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='History'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        
                    $pdf->cell(70, 10, $marks, 1, 0, '');
                    $pdf->cell(20, 10, $grade, 1, 1, '');

            }
        }
        else
    {
    $pdf->cell(70, 10, "_", 1, 0, '');
    $pdf->cell(20, 10, "_", 1, 1, '');
    }
    //end of subject
    $pdf->cell(20, 10, "3012", 1, 0, '');
    $pdf->cell(70, 10, "Religion", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='Religion'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        
                    $pdf->cell(70, 10, $marks, 1, 0, '');
                    $pdf->cell(20, 10, $grade, 1, 1, '');

            }
        }
        else
    {
    $pdf->cell(70, 10, "_", 1, 0, '');
    $pdf->cell(20, 10, "_", 1, 1, '');
    }
    //end of subject
    $pdf->cell(20, 10, "3013", 1, 0, '');
    $pdf->cell(70, 10, "Geography", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term'  AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Geography'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        
                    $pdf->cell(70, 10, $marks, 1, 0, '');
                    $pdf->cell(20, 10, $grade, 1, 1, '');

            }
        }
        else
    {
    $pdf->cell(70, 10, "_", 1, 0, '');
    $pdf->cell(20, 10, "_", 1, 1, '');
    }
    //end of subject
    
$pdf->setFont('Arial','B',10);
           $pdf->cell(70, 2, "", 0, 1, 'C');
           $pdf->cell(90, 10, "Total Marks", 1, 0, '');
          //from here
          $sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND  acyear='$s_acyear'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                      
                      $tmarks=$row1['sum(marks)'];

                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND  acyear='$s_acyear'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $marks=$total/$count;
                          
                          include 'grading.php';

                     
                    $pdf->cell(90, 10, $tmarks, 1, 1, '');

                   $pdf->cell(90, 10, "Mean Marks", 1, 0, '');
                   $pdf->cell(90, 10, round($marks), 1, 1, '');

                   //$pdf->cell(90, 10, "Grade", 1, 0, '');
                   //$pdf->cell(90, 10, $grade, 1, 1, '');

                   
                    //$pdf->cell(90, 10, "Total Marks", 1, 0, '');
                   //$pdf->cell(90, 10, $totalgrade, 1, 1, '');
                   $pdf->cell(90, 10, "Grade", 1, 0, '');
                   $pdf->cell(90, 10, $grade, 1, 1, '');
                      }
                   //to here


                   $sqlcount= "SELECT count(1) FROM positioning WHERE class='$s_class' AND term='$s_term'  AND exam='$s_exam' AND  acyear='$s_acyear' ";
                        $resultcount = mysqli_query($db, $sqlcount);

                        while($rowcount = mysqli_fetch_array($resultcount)){

                          $total=$rowcount[0];
                    $pdf->cell(90, 10, "Position", 1, 0, '');

                      $pdf->cell(90, 10, $rank." Out of ".$total, 1, 1, '');

  
                          
                    }
                     
                   

                 
                   }
                 }

                /* $sqlmark= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $balance=$rowmark['balance'];
                    $pdf->cell(90, 10, "Fee Balance", 1, 0, '');

                  $pdf->cell(90, 10,"Ksh ".$balance, 1, 1, '');
                  }
                }*/
                
                $pdf->cell(180, 10, "", 0, 1, 'C');
      $pdf->cell(180, 10, "DEAN OF CURRICULUM: ...........................................          DATE:    .........................", 0, 1, 'C');

      $pdf->setFont('Arial','I',11);
      $pdf->cell(180, 10, "The Transcript is issued without alteration or erasure whatsoever", 0, 1, 'C');

                  }
              }
  $pdf->OutPut();
?>