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
    if(isset($_SESSION["acyear"])){
     $_SESSION['acyear'];
    }
    if(isset($_SESSION["exams"])){
     $_SESSION['exams'];
    }
    
    if(isset($_SESSION["subjects"])){
     $_SESSION['subjects'];
    } 
    $s_username=$_SESSION['username'];
    $s_class=$_SESSION['classes'];
    $s_term=$_SESSION['terms'];
    $s_acyear=$_SESSION['acyear'];
    $s_exam=$_SESSION['exams'];

    $image1="profile/paulboitlogo.jpg";
//$image="profile/logo.png";

     $sql="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM positioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE acyear='$s_acyear' AND exam='$s_exam' AND  class='$s_class'  AND term='$s_term' ORDER BY total DESC) s";
                   
//indexnumber='$s_username' AND 
  $records=mysqli_query($db,$sql);

  

  $pdf=new FPDF('p','mm','A4');

  $pdf->AddPage();

  $pdf->setFont('Arial','B',14);
  
  $pdf->cell(180, 10, "", 0, 1, 'C');
  $pdf->cell(180, 10, "PAUL BOIT BOYS HIGH SCHOOL", 0, 1, 'C');

  $pdf->setFont('Arial','',11);
  $pdf->cell(180, 10, "P.O BOX 277, ELDORET", 0, 1, 'C');
  $pdf->cell(180, 10, "info@paulboithigh.sc.ke || www.paulboithigh.sc.ke", 0, 1, 'C');

  $pdf->cell(180, 10, "Student Report", 0, 1, 'C');
  
$pdf-> Image($image1,10,5,35,35); 
//$pdf-> Image($image,150,5,35,35);

  $pdf->cell(73, 5, "", 0, 1, 'C');

  $pdf->setFont('Arial','',12);
  while ($row=mysqli_fetch_array($records)) {

    $rank=$row['rank'];
    $indexnumber=$row['indexnumber'];

    if ($indexnumber==$s_username) {

    $pdf->cell(73, 10, "Name : ".$row['name'], 1, 0, 'C');
    $pdf->cell(63, 10,"Admission : ". $indexnumber, 1, 0, 'C');
    $pdf->cell(53, 10,"Term : ". $s_term, 1, 1, 'C');

    $pdf->cell(53, 10, $s_acyear, 1, 0, 'C');
    $pdf->cell(63, 10, $s_class, 1, 0, 'C');
    $pdf->cell(73, 10,"Exam Name : ". $s_exam, 1, 1, 'C');

    $pdf->cell(73, 2, "", 0, 1, 'C');

    $pdf->setFont('Arial','B',12);
    $pdf->cell(94, 10, "Subject", 1, 0, '');
    $pdf->cell(70, 10, "Marks", 1, 0, '');
    $pdf->cell(24, 10, "Grade", 1, 1, '');

    $pdf->setFont('Arial','',12);

     $sql1= "SELECT * FROM exammarks WHERE indexnumber='$s_username' AND class='$s_class' AND term='$s_term' AND acyear='$s_acyear' AND exam='$s_exam'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {

                    $subject=$row1['subject'];
                    $marks=$row1['marks'];
                    $grade=$row1['grade'];
                    $pdf->cell(94, 10, $subject, 1, 0, '');
                    $pdf->cell(70, 10, $marks, 1, 0, '');
                    $pdf->cell(24, 10, $grade, 1, 1, '');

            }
          }

           $pdf->setFont('Arial','B',12);
           $pdf->cell(73, 2, "", 0, 1, 'C');
           $pdf->cell(94, 10, "Total Marks", 1, 0, '');
          //from here
          $sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$s_username' AND class='$s_class' AND term='$s_term' AND acyear='$s_acyear' AND exam='$s_exam'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                      
                      $tmarks=$row1['sum(marks)'];

                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$s_username' AND class='$s_class' AND term='$s_term' AND acyear='$s_acyear' AND exam='$s_exam'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $marks=@($tmarks/$count);

                          include 'grading.php';
                     
                    $pdf->cell(94, 10, $tmarks, 1, 1, '');

                   $pdf->cell(94, 10, "Mean Marks", 1, 0, '');
                   $pdf->cell(94, 10, $marks, 1, 1, '');

                   //$pdf->cell(94, 10, "Grade", 1, 0, '');
                   //$pdf->cell(94, 10, $grade, 1, 1, '');
                   
                   $pdf->cell(94, 10, "Grade", 1, 0, '');
                   $pdf->cell(94, 10, $grade, 1, 1, '');
                      }
                   //to here

                    $sqlcount= "SELECT count(1) FROM positioning WHERE class='$s_class' AND term='$s_term' AND acyear='$s_acyear' AND exam='$s_exam' ";
                        $resultcount = mysqli_query($db, $sqlcount);

                        while($rowcount = mysqli_fetch_array($resultcount)){

                          $total=$rowcount[0];
                    $pdf->cell(94, 10, "Position", 1, 0, '');

                      $pdf->cell(94, 10, $rank." Out of ".$total, 1, 1, '');
                          
                    }
                     
                   

                 
                   }
                 }

 }

  }


  $pdf->OutPut();

?>