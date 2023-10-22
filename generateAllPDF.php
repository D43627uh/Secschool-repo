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

  $image="profile/paulboitlogo.jpg";
        //$pdf=new FPDF('p','mm','A4');
       $pdf=new FPDF('p','mm',array(200,270));
      //$pdf=new FPDF('p','mm',array(200,205)); 
        //$pdf->AddPage();

    $s_class=$_SESSION['classes'];
    $s_term=$_SESSION['terms'];
      $s_exam=$_SESSION['exams'];
      $s_acyear=$_SESSION['acyear'];

            $sqlpos="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM positioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  term='$s_term' AND class='$s_class' AND exam='$s_exam' AND  acyear='$s_acyear' ORDER BY total DESC) s";
                   
              $resultpos=mysqli_query($db,$sqlpos);



        
              if (mysqli_num_rows($resultpos)!=0) {
                   
                  while ($rowpos=mysqli_fetch_assoc($resultpos)) {
                      
                      
                      $id=$rowpos['id'];
                      $name=$rowpos['name'];
                      $indexnumber=$rowpos['indexnumber'];
                      $class=$rowpos['class'];
                      $stream=$rowpos['stream'];
                      $totalmarks=$rowpos['total'];
                      //$totalm=@($totalmarks/3);
                      $rank=$rowpos['rank'];
                    
if($indexnumber==$indexnumber)
{
  $pdf->AddPage();
     

  $pdf->setFont('Arial','B',12);
  
  //$pdf->cell(180, 0, "", 0, 1, 'C');
  $pdf->cell(180, 8, "PAUL BOIT BOYS HIGH SCHOOL", 0, 1, 'C');

  $pdf->setFont('Arial','',8);
  $pdf->cell(180, 6, "P.O BOX 277, ELDORET", 0, 1, 'C');
  $pdf->cell(180, 6, "info@paulboithigh.sc.ke || www.paulboithigh.sc.ke", 0, 1, 'C');
  $pdf->cell(180, 6,$s_term."  Academic Report  ".$s_acyear, 0, 1, 'C');
  $pdf->cell(180, 6,"Tel: 0798 277 277", 0, 1, 'C');
  $pdf->cell(180, 6, "In Fide Vade", 0, 1, 'C');
  
$pdf-> Image($image,10,5,35,35); 
//$pdf-> Image($image,150,5,35,35);

  $pdf->setFont('Arial','',8);
                
    $pdf->cell(36, 6, "NAME : ".$rowpos['name'], 1, 0, 'C');
    $pdf->cell(36, 6,"ADMISSION : ". $indexnumber, 1, 0, 'C');
    $pdf->cell(36, 6, "CLASS : ".$s_class, 1, 0, 'C');
    $pdf->cell(36, 6, "STREAM : ".$stream, 1, 0, 'C');

    $sqlhouse= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
    $resulthouse = mysqli_query($db, $sqlhouse);

    while($rowhouse = mysqli_fetch_array($resulthouse)){

      $house=$rowhouse['house'];
      $pdf->cell(36, 6, "HOUSE : ".$house, 1, 1, 'C');
    }
    
//Form position
 $sqlcount= "SELECT count(1) FROM positioning WHERE class='$s_class'AND exam='$s_exam' AND term='$s_term' AND  acyear='$s_acyear' ";
    $resultcount = mysqli_query($db, $sqlcount);

    while($rowcount = mysqli_fetch_array($resultcount)){

      $total=$rowcount[0];
$pdf->cell(36, 6, "FORM POS: ".$rank, 1, 0, 'C');

  $pdf->cell(36, 6,"OUT OF: ".$total, 1, 0, 'C');
      
}
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
    $sqlcountclass= "SELECT count(1) FROM positioning WHERE term='$s_term' AND  class='$s_class' AND stream='$stream' AND exam='$s_exam' AND  acyear='$s_acyear'";
    $resultcountclass = mysqli_query($db, $sqlcountclass);

    while($rowcountclass = mysqli_fetch_array($resultcountclass)){

      $classtotal=$rowcountclass[0];
$pdf->cell(36, 6, "CLASS POS: ".$classrank, 1, 0, 'C');

  $pdf->cell(36, 6,"OUT OF: ".$classtotal, 1, 1, 'C');
      }
}
 }
}
//end of class position
//from here
$pdf->setFont('Arial','',8);
           $pdf->cell(36, 6, "Total Marks: ".round($totalmarks), 1, 0, '');
          //from here
          $sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND  acyear='$s_acyear'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                      
                      $tmarks=$row1['sum(marks)'];

                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND exam='$s_exam' AND term='$s_term' AND  acyear='$s_acyear'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $genmarks=@($totalmarks/$count);
                          
                          include 'gengrading.php';

                     
                   $pdf->cell(36, 6, "Mean Marks: ".round($genmarks), 1, 0, '');
                    
                   $pdf->cell(36, 6, "Grade: ".$gengrade, 1, 1, '');
                      }
                   
                 
                   }
                 }
//to here

    $pdf->cell(70, 2, "", 0, 1, 'C');

    $pdf->setFont('Arial','B',8);
    $pdf->cell(40, 6, "Subject", 1, 0, '');
    $sqlcremaks= "SELECT * FROM exams WHERE  priority='$s_exam'";
      $resultcremaks=mysqli_query($db,$sqlcremaks);

      if (mysqli_num_rows($resultcremaks)!=0) {
           
          while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

            $name=$rowcremaks['name'];
            $pdf->cell(30, 6, $name, 1, 0, 'C');
          }
        }
    //$pdf->cell(15, 6, "Total %", 1, 0, 'C');
    $pdf->cell(25, 6, "Grade", 1, 0, 'C');
    $pdf->cell(15, 6, "Points", 1, 0, 'C');
    $pdf->cell(50, 6, "Remarks", 1, 0, 'C');
    $pdf->cell(20, 6, "Initial", 1, 1, 'C');
 
    $pdf->setFont('Arial','',8);
$pdf->cell(40, 6, "Mathematics", 1, 0, '');
$sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='Mathematics'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        


                    $pdf->cell(30, 6, $marks, 1, 0, 'C'); 
        $pdf->cell(25, 6, $grade, 1, 0, 'C');

        include 'gradingpoints.php';
        $pdf->cell(15, 6, $points, 1, 0, 'C');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Mathematics' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(50,6 ,$remarks,1,0,'C');
                    $pdf->cell(20,6,$initials,1,1,'C');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(50,6 ,"_",1,0,'C');
                    $pdf->cell(20,6,"_",1,1,'C');
                }

        

      }
    }    
        else
          {
          
          $pdf->cell(30, 6, "_", 1, 0, 'C');
          $pdf->cell(25, 6, "_", 1, 0, 'C');
          $pdf->cell(15, 6, "_", 1, 1, 'C');
          }
 
    $pdf->cell(40, 6, "English", 1, 0, '');

$sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='Mathematics'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        


                    $pdf->cell(30, 6, $marks, 1, 0, 'C'); 
        $pdf->cell(25, 6, $grade, 1, 0, 'C');

        include 'gradingpoints.php';
        $pdf->cell(15, 6, $points, 1, 0, 'C');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='English' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(50,6 ,$remarks,1,0,'C');
                    $pdf->cell(20,6,$initials,1,1,'C');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(50,6 ,"_",1,0,'C');
                    $pdf->cell(20,6,"_",1,1,'C');
                }

        

      }
    }    
        else
          {
          
          $pdf->cell(30, 6, "_", 1, 0, 'C');
          $pdf->cell(25, 6, "_", 1, 0, 'C');
          $pdf->cell(15, 6, "_", 1, 1, 'C');
          }
  
     $pdf->cell(40, 6, "Kiswahili", 1, 0, '');
$sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='English'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        


                    $pdf->cell(30, 6, $marks, 1, 0, 'C'); 
        $pdf->cell(25, 6, $grade, 1, 0, 'C');

        include 'gradingpoints.php';
        $pdf->cell(15, 6, $points, 1, 0, 'C');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Kiswahili' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(50,6 ,$remarks,1,0,'C');
                    $pdf->cell(20,6,$initials,1,1,'C');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(50,6 ,"_",1,0,'C');
                    $pdf->cell(20,6,"_",1,1,'C');
                }

        

      }
    }    
        else
          {
          
          $pdf->cell(30, 6, "_", 1, 0, 'C');
          $pdf->cell(25, 6, "_", 1, 0, 'C');
          $pdf->cell(15, 6, "_", 1, 1, 'C');
          }
     $pdf->cell(40, 6, "Biology", 1, 0, '');
$sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='Biology'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        


                    $pdf->cell(30, 6, $marks, 1, 0, 'C'); 
        $pdf->cell(25, 6, $grade, 1, 0, 'C');

        include 'gradingpoints.php';
        $pdf->cell(15, 6, $points, 1, 0, 'C');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Biology' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(50,6 ,$remarks,1,0,'C');
                    $pdf->cell(20,6,$initials,1,1,'C');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(50,6 ,"_",1,0,'C');
                    $pdf->cell(20,6,"_",1,1,'C');
                }

        

      }
    }    
        else
          {
          
          $pdf->cell(30, 6, "_", 1, 0, 'C');
          $pdf->cell(25, 6, "_", 1, 0, 'C');
          $pdf->cell(15, 6, "_", 1, 0, 'C');
          $pdf->cell(50,6 ,"_",1,0,'C');
          $pdf->cell(20,6,"_",1,1,'C');
          }
     $pdf->cell(40, 6, "Physics", 1, 0, '');
$sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='Physics'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        


                    $pdf->cell(30, 6, $marks, 1, 0, 'C'); 
        $pdf->cell(25, 6, $grade, 1, 0, 'C');

        include 'gradingpoints.php';
        $pdf->cell(15, 6, $points, 1, 0, 'C');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Physics' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(50,6 ,$remarks,1,0,'C');
                    $pdf->cell(20,6,$initials,1,1,'C');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(50,6 ,"_",1,0,'C');
                    $pdf->cell(20,6,"_",1,1,'C');
                }

        

      }
    }    
        else
          {
          
          $pdf->cell(30, 6, "_", 1, 0, 'C');
          $pdf->cell(25, 6, "_", 1, 0, 'C');
          $pdf->cell(15, 6, "_", 1, 1, 'C');
          }
    $pdf->cell(40, 6, "Chemistry", 1, 0, '');
$sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='Chemistry'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        


                    $pdf->cell(30, 6, $marks, 1, 0, 'C'); 
        $pdf->cell(25, 6, $grade, 1, 0, 'C');

        include 'gradingpoints.php';
        $pdf->cell(15, 6, $points, 1, 0, 'C');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Chemistry' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(50,6 ,$remarks,1,0,'C');
                    $pdf->cell(20,6,$initials,1,1,'C');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(50,6 ,"_",1,0,'C');
                    $pdf->cell(20,6,"_",1,1,'C');
                }

        

      }
    }    
        else
          {
          
          $pdf->cell(30, 6, "_", 1, 0, 'C');
          $pdf->cell(25, 6, "_", 1, 0, 'C');
          $pdf->cell(15, 6, "_", 1, 1, 'C');
          }

 $pdf->cell(40, 6, "Business Studies", 1, 0, '');
$sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='Business Studies'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        


                    $pdf->cell(30, 6, $marks, 1, 0, 'C'); 
        $pdf->cell(25, 6, $grade, 1, 0, 'C');

        include 'gradingpoints.php';
        $pdf->cell(15, 6, $points, 1, 0, 'C');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Business Studies' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(50,6 ,$remarks,1,0,'C');
                    $pdf->cell(20,6,$initials,1,1,'C');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(50,6 ,"_",1,0,'C');
                    $pdf->cell(20,6,"_",1,1,'C');
                }

        

      }
    }    
        else
          {
          
          $pdf->cell(30, 6, "_", 1, 0, 'C');
          $pdf->cell(25, 6, "_", 1, 0, 'C');
          $pdf->cell(15, 6, "_", 1, 1, 'C');
          }

    $pdf->cell(40, 6, "Agriculture", 1, 0, '');
$sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='Agriculture'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        


                    $pdf->cell(30, 6, $marks, 1, 0, 'C'); 
        $pdf->cell(25, 6, $grade, 1, 0, 'C');

        include 'gradingpoints.php';
        $pdf->cell(15, 6, $points, 1, 0, 'C');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Agriculture' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(50,6 ,$remarks,1,0,'C');
                    $pdf->cell(20,6,$initials,1,1,'C');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(50,6 ,"_",1,0,'C');
                    $pdf->cell(20,6,"_",1,1,'C');
                }

        

      }
    }    
        else
          {
          
          $pdf->cell(30, 6, "_", 1, 0, 'C');
          $pdf->cell(25, 6, "_", 1, 0, 'C');
          $pdf->cell(15, 6, "_", 1, 1, 'C');
          }
    $pdf->cell(40, 6, "History", 1, 0, '');
$sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='History'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        


                    $pdf->cell(30, 6, $marks, 1, 0, 'C'); 
        $pdf->cell(25, 6, $grade, 1, 0, 'C');

        include 'gradingpoints.php';
        $pdf->cell(15, 6, $points, 1, 0, 'C');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='History' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(50,6 ,$remarks,1,0,'C');
                    $pdf->cell(20,6,$initials,1,1,'C');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(50,6 ,"_",1,0,'C');
                    $pdf->cell(20,6,"_",1,1,'C');
                }

        

      }
    }    
        else
          {
          
          $pdf->cell(30, 6, "_", 1, 0, 'C');
          $pdf->cell(25, 6, "_", 1, 0, 'C');
          $pdf->cell(15, 6, "_", 1, 1, 'C');
          }
     
    $pdf->cell(40, 6, "C.R.E", 1, 0, '');
$sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='C.R.E'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        


                    $pdf->cell(30, 6, $marks, 1, 0, 'C'); 
        $pdf->cell(25, 6, $grade, 1, 0, 'C');

        include 'gradingpoints.php';
        $pdf->cell(15, 6, $points, 1, 0, 'C');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='C.R.E' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(50,6 ,$remarks,1,0,'C');
                    $pdf->cell(20,6,$initials,1,1,'C');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(50,6 ,"_",1,0,'C');
                    $pdf->cell(20,6,"_",1,1,'C');
                }

        

      }
    }    
        else
          {
          
          $pdf->cell(30, 6, "_", 1, 0, 'C');
          $pdf->cell(25, 6, "_", 1, 0, 'C');
          $pdf->cell(15, 6, "_", 1, 1, 'C');
          }
       
    $pdf->cell(40, 6, "Geography", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='$s_exam' AND  acyear='$s_acyear' AND subject='Geography'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks=$rowmark['marks'];
                    $grade=$rowmark['grade']; 
                        


                    $pdf->cell(30, 6, $marks, 1, 0, 'C'); 
        $pdf->cell(25, 6, $grade, 1, 0, 'C');

        include 'gradingpoints.php';
        $pdf->cell(15, 6, $points, 1, 0, 'C');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream' AND subject='Geography' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(50,6 ,$remarks,1,0,'C');
                    $pdf->cell(20,6,$initials,1,1,'C');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(50,6 ,"_",1,0,'C');
                    $pdf->cell(20,6,"_",1,1,'C');
                }

        

      }
    }    
        else
          {
          
          $pdf->cell(30, 6, "_", 1, 0, 'C');
          $pdf->cell(25, 6, "_", 1, 0, 'C');
          $pdf->cell(15, 6, "_", 1, 1, 'C');
          }

          $sqlmarks= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
                    $resultmarks = mysqli_query($db, $sqlmarks);

                    if (mysqli_num_rows($resultmarks)!=0) {
                    while($rowmarks= mysqli_fetch_array($resultmarks)){
                      $kcmarks=$rowmarks['kcmarks'];
                      $kcgrade=$rowmarks['kcgrade'];
                      
                      $pdf->cell(60, 3, " ", 0, 1, 'C');
                      $pdf->cell(20,6 ,"KCPE Marks",1,0,'C');
                    $pdf->cell(20,6,"KCPE M.G",1,1,'C');
                      $pdf->cell(20,6 ,$kcmarks,1,0,'C');
                    $pdf->cell(20,6,$kcgrade,1,1,'C');
                    }
                  }else{
                    echo "_";
                  }

  $pdf->cell(60, 3, " ", 0, 1, 'C');
          $pdf->cell(20, 6, "", 0, 0, 'C');
        $pdf->cell(60, 6, "Class Teacher's Remarks", 1, 0, 'C');
        $pdf->cell(100, 6, "", 0, 1, 'C');

        $pdf->cell(20, 6, "", 0, 0, 'C');

         //class teacher
        $sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND  acyear='$s_acyear'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                      
                      $tmarks=$row1['sum(marks)'];

                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND exam='$s_exam' AND term='$s_term' AND  acyear='$s_acyear'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $genmarks=@($totalmarks/$count);
                          
                          include 'gengrading.php';
        //
               
                  $sqlcremaks= "SELECT * FROM classteacherremarks WHERE class='$s_class' AND stream='$stream' AND  acyear='$s_acyear' AND grade='$gengrade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)==1) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $name=$rowcremaks['name'];
                    
                      $remarks=$rowcremaks['remarks'];
                      $pdf->cell(120, 15, $remarks, 1, 1, '');
        $pdf->cell(60, 6, "", 0, 0, 'C');
        $pdf->cell(80, 6, $name, 1, 1, 'C');
                    
                  }
                }
              }
            }
            }    

        

        $pdf->cell(60, 3, " ", 0, 1, 'C');
          $pdf->cell(20, 6, "", 0, 0, 'C');
        $pdf->cell(60, 6, "Head Teacher's Remarks", 1, 0, 'C');
        $pdf->cell(100, 6, "", 0, 1, 'C');

        $pdf->cell(20, 6, "", 0, 0, 'C');
        $sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND  acyear='$s_acyear'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                      
                      $tmarks=$row1['sum(marks)'];

                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND exam='$s_exam' AND term='$s_term' AND  acyear='$s_acyear'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $genmarks=@($totalmarks/$count);
                          
                          include 'gengrading.php';
        $sqlcremaks= "SELECT * FROM headteacherremarks WHERE acyear='$s_acyear' AND grade='$gengrade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $name=$rowcremaks['name'];
                    
                      $remarks=$rowcremaks['remarks'];
                      $pdf->cell(120, 15, $remarks, 1, 1, '');
        $pdf->cell(60, 6, "", 0, 0, 'C');
        $pdf->cell(80, 6, $name, 1, 1, 'C');
                    
                  }
                }
}
}
}
 $pdf->cell(180, 6, "", 0, 1, 'C');
      $pdf->cell(180, 6, "Fees arrears KES: ...........................    Next term fees KES ........................     Total KES ............................     Sign .......................", 0, 1, 'C');

                $pdf->cell(180, 6, "", 0, 1, 'C');
      $pdf->cell(180, 6, "Parent's Sign: ...........................................          Date:    .........................", 0, 1, 'C');

      $pdf->setFont('Arial','I',8);
      $pdf->cell(180, 6, "The Transcript is issued without alteration or erasure whatsoever", 0, 1, 'C');

                  }
              }
            }
  $pdf->OutPut();
?>