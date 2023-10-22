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



            $sqlpos="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  term='$s_term' AND  class='$s_class' AND  acyear='$s_acyear' ORDER BY total DESC) s";
                   
              $resultpos=mysqli_query($db,$sqlpos);

//$image1="profile/kenya.png";
$image="profile/paulboitlogo.jpg";
        //$pdf=new FPDF('p','mm','A4');
       $pdf=new FPDF('p','mm',array(200,290));

       //graph
       //position
$chartX=40;
$chartY=160;
 
//dimension
$chartWidth=120;
$chartHeight=40;

//padding
$chartTopPadding=10;
$chartLeftPadding=20;
$chartBottomPadding=10;
$chartRightPadding=5;

//chart box
$chartBoxX=$chartX+$chartLeftPadding;
$chartBoxY=$chartY+$chartTopPadding;
$chartBoxWidth=$chartWidth-$chartLeftPadding-$chartRightPadding;
$chartBoxHeight=$chartHeight-$chartBottomPadding-$chartTopPadding;

//bar width
$barWidth=5;
       //end graph
        

              if (mysqli_num_rows($resultpos)!=0) {
                   
                  while ($rowpos=mysqli_fetch_assoc($resultpos)) {
                      
                      
                      $id=$rowpos['id'];
                      $name=$rowpos['name'];
                      $indexnumber=$rowpos['indexnumber'];
                      $class=$rowpos['class'];
                      $stream=$rowpos['stream'];
                      $totalmarks=$rowpos['total'];
                      $totalm=@($totalmarks/3);
                      $rank=$rowpos['rank'];

if($indexnumber==$indexnumber)
{
  $pdf->AddPage();

  $pdf->setFont('Arial','B',10);
  
  //$pdf->cell(180, 0, "", 0, 1, 'C');
  $pdf->cell(180, 6, "PAUL BOIT BOYS HIGH SCHOOL", 0, 1, 'C');

  $pdf->setFont('Arial','',8);
  $pdf->cell(180, 3, "P.O BOX 277, ELDORET", 0, 1, 'C');
  $pdf->cell(180, 5, "info@paulboithigh.sc.ke || www.paulboithigh.sc.ke", 0, 1, 'C');
  $pdf->cell(180, 5,$s_term."  Academic Report  ".$s_acyear, 0, 1, 'C');
  $pdf->cell(180, 5,"Tel: 0798 277 277", 0, 1, 'C');
  $pdf->cell(180, 5, "In Fide Vade", 0, 1, 'C');
  
  $pdf-> Image($image,10,5,35,35); 
//$pdf-> Image($image,150,5,35,35);

  $pdf->setFont('Arial','',8);
                
    $pdf->cell(36, 5, "NAME : ".$rowpos['name'], 1, 0, 'C');
    $pdf->cell(36, 5,"ADMISSION : ". $indexnumber, 1, 0, 'C');
    $pdf->cell(36, 5, "CLASS : ".$s_class, 1, 0, 'C');
    $pdf->cell(36, 5, "STREAM : ".$stream, 1, 0, 'C');
    $sqlhouse= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
    $resulthouse = mysqli_query($db, $sqlhouse);

    while($rowhouse = mysqli_fetch_array($resulthouse)){

      $house=$rowhouse['house'];
      $pdf->cell(36, 5, "HOUSE : ".$house, 1, 1, 'C');
    }
//Form position
 $sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='$s_class' AND term='$s_term' AND  acyear='$s_acyear' ";
    $resultcount = mysqli_query($db, $sqlcount);

    while($rowcount = mysqli_fetch_array($resultcount)){

      $total=$rowcount[0];
$pdf->cell(36, 5, "FORM POS: ".$rank, 1, 0, 'C');

  $pdf->cell(36, 5,"OUT OF: ".$total, 1, 0, 'C');
      
}

  //class position
$sqlclasspos="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  term='$s_term' AND class='$s_class' AND stream='$stream' AND  acyear='$s_acyear' ORDER BY total DESC) s";
  $resultclasspos=mysqli_query($db,$sqlclasspos);
  if (mysqli_num_rows($resultclasspos)!=0) {
                   
                  while ($rowclasspos=mysqli_fetch_assoc($resultclasspos)) {
                      $classindexnumber=$rowclasspos['indexnumber'];
                      $class=$rowclasspos['class'];
                      $stream=$rowclasspos['stream'];
                      $classrank=$rowclasspos['rank'];

    if($classindexnumber==$indexnumber)
    {
    $sqlcountclass= "SELECT count(1) FROM overallpositioning WHERE term='$s_term' AND  class='$s_class' AND stream='$stream' AND acyear='$s_acyear'";
    $resultcountclass = mysqli_query($db, $sqlcountclass);

    while($rowcountclass = mysqli_fetch_array($resultcountclass)){

      $classtotal=$rowcountclass[0];
$pdf->cell(36, 5, "CLASS POS: ".$classrank, 1, 0, 'C');

  $pdf->cell(36, 5,"OUT OF: ".$classtotal, 1, 1, 'C');
      }
}
 }
}
//end of class position
//from here
$pdf->setFont('Arial','',8);
           $pdf->cell(36, 5, "Total Marks: ".round($totalm), 1, 0, '');
          //from here
          $sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  acyear='$s_acyear'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                      
                      $tmarks=$row1['sum(marks)'];

                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  acyear='$s_acyear'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $genmarks=@($totalmarks/$count);
                          
                          include 'gengrading.php';
                     
                   $pdf->cell(36, 5, "Mean Marks: ".round($genmarks), 1, 0, '');
                    
                   $pdf->cell(36, 5, "Grade: ".$gengrade, 1, 1, '');
                      }
                   }
                 }
//to here

    $pdf->cell(70, 2, "", 0, 1, 'C');

    $pdf->setFont('Arial','B',8);
    $pdf->cell(30, 5, "Subject", 1, 0, '');
    $sqlcremaks= "SELECT * FROM exams WHERE  priority='1'";
      $resultcremaks=mysqli_query($db,$sqlcremaks);

      if (mysqli_num_rows($resultcremaks)!=0) {
           
          while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

            $name=$rowcremaks['name'];
            $pdf->cell(20, 5, $name, 1, 0, 'C');
          }
        }


    $sqlcremaks= "SELECT * FROM exams WHERE  priority='2'";
      $resultcremaks=mysqli_query($db,$sqlcremaks);

      if (mysqli_num_rows($resultcremaks)!=0) {
           
          while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

            $name=$rowcremaks['name'];
            $pdf->cell(20, 5, $name, 1, 0, 'C');
          }
        }
    $sqlcremaks= "SELECT * FROM exams WHERE  priority='3'";
      $resultcremaks=mysqli_query($db,$sqlcremaks);

      if (mysqli_num_rows($resultcremaks)!=0) {
           
          while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

            $name=$rowcremaks['name'];
            $pdf->cell(20, 5, $name, 1, 0, 'C');
          }
        }
    $pdf->cell(15, 5, "Total %", 1, 0, 'C');
    $pdf->cell(15, 5, "Grade", 1, 0, 'C');
    $pdf->cell(10, 5, "Points", 1, 0, 'C');
    $pdf->cell(40, 5, "Remarks", 1, 0, 'C');
    $pdf->cell(10, 5, "Initial", 1, 1, 'C');
 
    $pdf->setFont('Arial','',8);

    $pdf->cell(30, 5, "Mathematics", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='1' AND  acyear='$s_acyear' AND subject='Mathematics'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks1=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks1, 1, 0, 'C');
                   // $pdf->cell(20, 10, $grade, 1, 1, '');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }

        //Exam 2
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='2' AND  acyear='$s_acyear' AND subject='Mathematics'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks2=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks2, 1, 0, 'C');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }
        //to here

          //Exam 3
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='3' AND  acyear='$s_acyear' AND subject='Mathematics'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks3=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks3, 1, 0, 'C');
                     
                    $marks=@($marks1+$marks2+$marks3)/3;
                    include'grading.php';
        $pdf->cell(15, 5, round($marks), 1, 0, 'C'); 
        $pdf->cell(15, 5, $grade, 1, 0, '');

        include 'gradingpoints.php';
        $pdf->cell(10, 5, $points, 1, 0, '');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Mathematics' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(40,5 ,$remarks,1,0,'');
                    $pdf->cell(10,5,$initials,1,1,'');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(40,5 ,"_",1,0,'');
                    $pdf->cell(10,5,"_",1,1,'');
                }

        

      }
    }    
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(10, 5, "_", 1, 1, '');
          }
        //to here

$pdf->cell(30, 5, "English", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='1' AND  acyear='$s_acyear' AND subject='English'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks1=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks1, 1, 0, 'C');
                   // $pdf->cell(20, 10, $grade, 1, 1, '');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }

        //Exam 2
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='2' AND  acyear='$s_acyear' AND subject='English'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks2=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks2, 1, 0, 'C');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }
        //to here

          //Exam 3
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='3' AND  acyear='$s_acyear' AND subject='English'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks3=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks3, 1, 0, 'C');
                     
                    $marks=@($marks1+$marks2+$marks3)/3;
                    include'grading.php';
        $pdf->cell(15, 5, round($marks), 1, 0, 'C'); 
        $pdf->cell(15, 5, $grade, 1, 0, '');

        include 'gradingpoints.php';
        $pdf->cell(10, 5, $points, 1, 0, '');

         $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='English' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(40,5 ,$remarks,1,0,'');
                    $pdf->cell(10,5,$initials,1,1,'');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(40,5 ,"_",1,0,'');
                    $pdf->cell(10,5,"_",1,1,'');
                }


      }
    }    
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(10, 5, "_", 1, 1, '');
          }

    
$pdf->cell(30, 5, "Kiswahili", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='1' AND  acyear='$s_acyear' AND subject='Kiswahili'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks1=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks1, 1, 0, 'C');
                   // $pdf->cell(20, 10, $grade, 1, 1, '');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }

        //Exam 2
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='2' AND  acyear='$s_acyear' AND subject='Kiswahili'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks2=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks2, 1, 0, 'C');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }
        //to here

          //Exam 3
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='3' AND  acyear='$s_acyear' AND subject='Kiswahili'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks3=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks3, 1, 0, 'C');
                     
                    $marks=@($marks1+$marks2+$marks3)/3;
                    include'grading.php';
        $pdf->cell(15, 5, round($marks), 1, 0, 'C'); 
        $pdf->cell(15, 5, $grade, 1, 0, '');

        include 'gradingpoints.php';
        $pdf->cell(10, 5, $points, 1, 0, '');
         $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Kiswahili' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(40,5 ,$remarks,1,0,'');
                    $pdf->cell(10,5,$initials,1,1,'');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(40,5 ,"_",1,0,'');
                    $pdf->cell(10,5,"_",1,1,'');
                }


      }
    }    
        else
          {
         $pdf->cell(20, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(10, 5, "_", 1, 1, '');
          }
  $pdf->cell(30, 5, "Biology", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='1' AND  acyear='$s_acyear' AND subject='Biology'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks1=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks1, 1, 0, 'C');
                   // $pdf->cell(20, 10, $grade, 1, 1, '');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }

        //Exam 2
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='2' AND  acyear='$s_acyear' AND subject='Biology'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks2=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks2, 1, 0, 'C');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }
        //to here

          //Exam 3
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='3' AND  acyear='$s_acyear' AND subject='Biology'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks3=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks3, 1, 0, 'C');
                     
                    $marks=@($marks1+$marks2+$marks3)/3;
                    include'grading.php';
        $pdf->cell(15, 5, round($marks), 1, 0, 'C'); 
        $pdf->cell(15, 5, $grade, 1, 0, '');

        include 'gradingpoints.php';
        $pdf->cell(10, 5, $points, 1, 0, '');
         $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Biology' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(40,5 ,$remarks,1,0,'');
                    $pdf->cell(10,5,$initials,1,1,'');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(40,5 ,"_",1,0,'');
                    $pdf->cell(10,5,"_",1,1,'');
                }


      }
    }    
        else
          {
         $pdf->cell(20, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(10, 5, "_", 1, 1, '');
          }
     $pdf->cell(30, 5, "Physics", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='1' AND  acyear='$s_acyear' AND subject='Physics'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks1=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks1, 1, 0, 'C');
                   // $pdf->cell(20, 10, $grade, 1, 1, '');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }

        //Exam 2
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='2' AND  acyear='$s_acyear' AND subject='Physics'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks2=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks2, 1, 0, 'C');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }
        //to here

          //Exam 3
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='3' AND  acyear='$s_acyear' AND subject='Physics'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks3=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks3, 1, 0, 'C');
                     
                    $marks=@($marks1+$marks2+$marks3)/3;
                    include'grading.php';
        $pdf->cell(15, 5, round($marks), 1, 0, 'C'); 
        $pdf->cell(15, 5, $grade, 1, 0, '');

        include 'gradingpoints.php';
        $pdf->cell(10, 5, $points, 1, 0, '');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Physics' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(40,5 ,$remarks,1,0,'');
                    $pdf->cell(10,5,$initials,1,1,'');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(40,5 ,"_",1,0,'');
                    $pdf->cell(10,5,"_",1,1,'');
                }

      }
    }    
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(10, 5, "_", 1, 1, '');
          }
   
    
     $pdf->cell(30, 5, "Chemistry", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='1' AND  acyear='$s_acyear' AND subject='Chemistry'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks1=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks1, 1, 0, 'C');
                   // $pdf->cell(20, 10, $grade, 1, 1, '');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }

        //Exam 2
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='2' AND  acyear='$s_acyear' AND subject='Chemistry'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks2=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks2, 1, 0, 'C');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }
        //to here

          //Exam 3
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='3' AND  acyear='$s_acyear' AND subject='Chemistry'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks3=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks3, 1, 0, 'C');
                     
                    $marks=@($marks1+$marks2+$marks3)/3;
                    include'grading.php';
        $pdf->cell(15, 5, round($marks), 1, 0, 'C'); 
        $pdf->cell(15, 5, $grade, 1, 0, '');

        include 'gradingpoints.php';
        $pdf->cell(10, 5, $points, 1, 0, '');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class'  AND stream='$stream' AND subject='Chemistry' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(40,5 ,$remarks,1,0,'');
                    $pdf->cell(10,5,$initials,1,1,'');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(40,5 ,"_",1,0,'');
                    $pdf->cell(10,5,"_",1,1,'');
                }

      }
    }    
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(10, 5, "_", 1, 1, '');
          }
$pdf->cell(30, 5, "Business Studies", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='1' AND  acyear='$s_acyear' AND subject='Business Studies'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks1=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks1, 1, 0, 'C');
                   // $pdf->cell(20, 10, $grade, 1, 1, '');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }

        //Exam 2
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='2' AND  acyear='$s_acyear' AND subject='Business Studies'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks2=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks2, 1, 0, 'C');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }
        //to here

          //Exam 3
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='3' AND  acyear='$s_acyear' AND subject='Business Studies'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks3=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks3, 1, 0, 'C');
                     
                    $marks=@($marks1+$marks2+$marks3)/3;
                    include'grading.php';
        $pdf->cell(15, 5, round($marks), 1, 0, 'C'); 
        $pdf->cell(15, 5, $grade, 1, 0, '');

        include 'gradingpoints.php';
        $pdf->cell(10, 5, $points, 1, 0, '');
         $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Business Studies' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(40,5 ,$remarks,1,0,'');
                    $pdf->cell(10,5,$initials,1,1,'');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(40,5 ,"_",1,0,'');
                    $pdf->cell(10,5,"_",1,1,'');
                }


      }
    }    
        else
          {
         $pdf->cell(20, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(10, 5, "_", 1, 1, '');
          }    

$pdf->cell(30, 5, "Agriculture", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='1' AND  acyear='$s_acyear' AND subject='Agriculture'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks1=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks1, 1, 0, 'C');
                   // $pdf->cell(20, 10, $grade, 1, 1, '');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }

        //Exam 2
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='2' AND  acyear='$s_acyear' AND subject='Agriculture'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks2=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks2, 1, 0, 'C');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }
        //to here

          //Exam 3
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='3' AND  acyear='$s_acyear' AND subject='Agriculture'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks3=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks3, 1, 0, 'C');
                     
                    $marks=@($marks1+$marks2+$marks3)/3;
                    include'grading.php';
        $pdf->cell(15, 5, round($marks), 1, 0, 'C'); 
        $pdf->cell(15, 5, $grade, 1, 0, '');

        include 'gradingpoints.php';
        $pdf->cell(10, 5, $points, 1, 0, '');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='Agriculture' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(40,5 ,$remarks,1,0,'');
                    $pdf->cell(10,5,$initials,1,1,'');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(40,5 ,"_",1,0,'');
                    $pdf->cell(10,5,"_",1,1,'');
                }

      }
    }    
        else
          {
         $pdf->cell(20, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(10, 5, "_", 1, 1, '');
          }

$pdf->cell(30, 5, "History", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='1' AND  acyear='$s_acyear' AND subject='History'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks1=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks1, 1, 0, 'C');
                   // $pdf->cell(20, 10, $grade, 1, 1, '');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }

        //Exam 2
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='2' AND  acyear='$s_acyear' AND subject='History'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks2=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks2, 1, 0, 'C');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }
        //to here

          //Exam 3
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='3' AND  acyear='$s_acyear' AND subject='History'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks3=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks3, 1, 0, 'C');
                     
                    $marks=@($marks1+$marks2+$marks3)/3;
                    include'grading.php';
        $pdf->cell(15, 5, round($marks), 1, 0, 'C'); 
        $pdf->cell(15, 5, $grade, 1, 0, '');

        include 'gradingpoints.php';
        $pdf->cell(10, 5, $points, 1, 0, '');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream' AND subject='History' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(40,5 ,$remarks,1,0,'');
                    $pdf->cell(10,5,$initials,1,1,'');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(40,5 ,"_",1,0,'');
                    $pdf->cell(10,5,"_",1,1,'');
                }

      }
    }    
        else
          {
         $pdf->cell(20, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(10, 5, "_", 1, 1, '');
          }
    

$pdf->cell(30, 5, "C.R.E", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='1' AND  acyear='$s_acyear' AND subject='C.R.E'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks1=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks1, 1, 0, 'C');
                   // $pdf->cell(20, 10, $grade, 1, 1, '');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }

        //Exam 2
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='2' AND  acyear='$s_acyear' AND subject='C.R.E'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks2=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks2, 1, 0, 'C');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }
        //to here

          //Exam 3
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='3' AND  acyear='$s_acyear' AND subject='C.R.E'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks3=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks3, 1, 0, 'C');
                     
                    $marks=@($marks1+$marks2+$marks3)/3;
                    include'grading.php';
        $pdf->cell(15, 5, round($marks), 1, 0, 'C'); 
        $pdf->cell(15, 5, $grade, 1, 0, '');

        include 'gradingpoints.php';
        $pdf->cell(10, 5, $points, 1, 0, '');

        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream'  AND subject='C.R.E' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(40,5 ,$remarks,1,0,'');
                    $pdf->cell(10,5,$initials,1,1,'');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(40,5 ,"_",1,0,'');
                    $pdf->cell(10,5,"_",1,1,'');
                }

      }
    }    
        else
          {
         $pdf->cell(20, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(10, 5, "_", 1, 1, '');
          }

$pdf->cell(30, 5, "Geography", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='1' AND  acyear='$s_acyear' AND subject='Geography'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks1=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks1, 1, 0, 'C');
                   // $pdf->cell(20, 10, $grade, 1, 1, '');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }

        //Exam 2
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='2' AND  acyear='$s_acyear' AND subject='Geography'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks2=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks2, 1, 0, 'C');    
            }
        }
        else
          {
          $pdf->cell(20, 5, "_", 1, 0, '');
          }
        //to here

          //Exam 3
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  exam='3' AND  acyear='$s_acyear' AND subject='Geography'";
              $resultmark=mysqli_query($db,$sqlmark);

              if (mysqli_num_rows($resultmark)!=0) {
                   
                  while ($rowmark=mysqli_fetch_assoc($resultmark)) {

                    $subject=$rowmark['subject'];
                    $marks3=$rowmark['marks'];
                    $grade=$rowmark['grade'];  
                        


                    $pdf->cell(20, 5, $marks3, 1, 0, 'C');
                     
                    $marks=@($marks1+$marks2+$marks3)/3;
                    include'grading.php';
        $pdf->cell(15, 5, round($marks), 1, 0, 'C'); 
        $pdf->cell(15, 5, $grade, 1, 0, '');

        include 'gradingpoints.php';
        $pdf->cell(10, 5, $points, 1, 0, '');
        $sqlcremaks= "SELECT * FROM teacherremarks WHERE class='$s_class' AND stream='$stream' AND subject='Geography' AND  acyear='$s_acyear' AND grade='$grade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $initials=$rowcremaks['initials'];
                    $remarks=$rowcremaks['remarks'];

                    $pdf->cell(40,5 ,$remarks,1,0,'');
                    $pdf->cell(10,5,$initials,1,1,'');
                  }
                }else if (mysqli_num_rows($resultcremaks)<1)
                {
                  $pdf->cell(40,5 ,"_",1,0,'');
                    $pdf->cell(10,5,"_",1,1,'');
                }

      }
    }    
        else
          {
         $pdf->cell(20, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(15, 5, "_", 1, 0, '');
          $pdf->cell(10, 5, "_", 1, 1, '');
          }
          $pdf->setFont('Arial','',7);
          $sqlmarks= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
                    $resultmarks = mysqli_query($db, $sqlmarks);

                    if (mysqli_num_rows($resultmarks)!=0) {
                    while($rowmarks= mysqli_fetch_array($resultmarks)){
                      $kcmarks=$rowmarks['kcmarks'];
                      $kcgrade=$rowmarks['kcgrade'];
                      
                      $pdf->cell(60, 3, " ", 0, 1, 'C');
                      $pdf->cell(20,5 ,"KCPE Marks",1,0,'C');
                    $pdf->cell(20,5,"KCPE M.G",1,1,'C');
                      $pdf->cell(20,5 ,$kcmarks,1,0,'C');
                    $pdf->cell(20,5,$kcgrade,1,1,'C');
                    }
                  }else{
                    echo "_";
                  }

                  //student progress

              $pdf->cell(30,3,"", 0, 1, 'C');  

      $pdf->cell(55,3,"", 0, 0, 'C');
      $pdf->cell(70,5,"Student's Progress Report", 1, 1, 'C');  
      $pdf->cell(30,3,"", 0, 0, 'C');
      $pdf->cell(30,5,"Form 1", 1, 0, 'C');
      $pdf->cell(30,5,"Form 2", 1, 0, 'C');
      $pdf->cell(30,5,"Form 3", 1, 0, 'C');
      $pdf->cell(30,5,"Form 4", 1, 1, 'C');

      $pdf->cell(30,3,"", 0, 0, 'C');
      $pdf->cell(10,4,"Term", 1, 0, 'C');
      $pdf->cell(7,4,"Pos", 1, 0, 'C');
      $pdf->cell(7,4,"Out", 1, 0, 'C');
      $pdf->cell(6,4,"M.G", 1, 0, 'C');

      $pdf->cell(10,4,"Term", 1, 0, 'C');
      $pdf->cell(7,4,"Pos", 1, 0, 'C');
      $pdf->cell(7,4,"Out", 1, 0, 'C');
      $pdf->cell(6,4,"M.G", 1, 0, 'C');

      $pdf->cell(10,4,"Term", 1, 0, 'C');
      $pdf->cell(7,4,"Pos", 1, 0, 'C');
      $pdf->cell(7,4,"Out", 1, 0, 'C');
      $pdf->cell(6,4,"M.G", 1, 0, 'C');

      $pdf->cell(10,4,"Term", 1, 0, 'C');
      $pdf->cell(7,4,"Pos", 1, 0, 'C');
      $pdf->cell(7,4,"Out", 1, 0, 'C');
      $pdf->cell(6,4,"M.G", 1, 1, 'C');

      $pdf->cell(30,3,"", 0, 0, 'C');
      $pdf->cell(10,3,"1", 1, 0, 'C');
$sqlan="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  class='Form One' AND term='Term I' ORDER BY total DESC) s";
  $resultan=mysqli_query($db,$sqlan);
  if (mysqli_num_rows($resultan)!=0) {      
    while ($rowan=mysqli_fetch_assoc($resultan)) {
         $classindexnumber=$rowan['indexnumber'];
      $anrank=$rowan['rank'];

    if($classindexnumber==$indexnumber)
    {
  $pdf->cell(7,3,$anrank, 1, 0, 'C');     
}
}
}else {
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='Form One' AND term='Term I'";
    $resultcount = mysqli_query($db, $sqlcount);
    if (mysqli_num_rows($resultcount)!=0) { 
    while($rowcount = mysqli_fetch_array($resultcount)){
      $total=$rowcount[0];
      $pdf->cell(7,3,$total, 1, 0, 'C');
    }
  }else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form One' AND term='Term I'";
              $result1=mysqli_query($db,$sql1);
              if (mysqli_num_rows($result1)!=0) {    
                  while ($row1=mysqli_fetch_assoc($result1)) {   
                      $tmarks=$row1['sum(marks)'];
                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form One' AND term='Term I'";
                        $resultc = mysqli_query($db, $sqlc);
                        while($rowc= mysqli_fetch_array($resultc)){
                          $count=$rowc[0];
                          $genmarks=@($totalmarks/$count);     
                          include 'gengrading.php';
                   $pdf->cell(6,3,$gengrade, 1, 0, 'C');
        }
      }
  }else{
    $pdf->cell(6,3,"_", 1, 0, 'C');
  }
  

  $pdf->cell(10,3,"1", 1, 0, 'C');
     $sqlan="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  class='Form Two' AND term='Term I' ORDER BY total DESC) s";
  $resultan=mysqli_query($db,$sqlan);
  if (mysqli_num_rows($resultan)!=0) {      
    while ($rowan=mysqli_fetch_assoc($resultan)) {
         $classindexnumber=$rowan['indexnumber'];
      $anrank=$rowan['rank'];

    if($classindexnumber==$indexnumber)
    {

  $pdf->cell(7,3,$anrank, 1, 0, 'C');    
}
}
}else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='Form Two' AND term='Term I'";
    $resultcount = mysqli_query($db, $sqlcount);
    if (mysqli_num_rows($resultcount)!=0) {
    while($rowcount = mysqli_fetch_array($resultcount)){
      $total=$rowcount[0];
      $pdf->cell(7,3,$total, 1, 0, 'C');
    }
  }else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}

$sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Two' AND term='Term I'";
              $result1=mysqli_query($db,$sql1);
              if (mysqli_num_rows($result1)!=0) {    
                  while ($row1=mysqli_fetch_assoc($result1)) {   
                      $tmarks=$row1['sum(marks)'];
                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Two' AND term='Term I'";
                        $resultc = mysqli_query($db, $sqlc);
                        while($rowc= mysqli_fetch_array($resultc)){
                          $count=$rowc[0];
                          $genmarks=@($tmarks/$count);     
                          include 'gengrading.php';
                   $pdf->cell(6,3,$gengrade, 1, 0, 'C');
        }
      }
  }else{
    $pdf->cell(6,3,"_", 1, 0, 'C');
  }

$pdf->cell(10,3,"1", 1, 0, 'C');
$sqlan="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  class='Form Three' AND term='Term I' ORDER BY total DESC) s";
  $resultan=mysqli_query($db,$sqlan);
  if (mysqli_num_rows($resultan)!=0) {      
    while ($rowan=mysqli_fetch_assoc($resultan)) {
         $classindexnumber=$rowan['indexnumber'];
      $anrank=$rowan['rank'];

    if($classindexnumber==$indexnumber)
    {

  $pdf->cell(7,3,$anrank, 1, 0, 'C');    
}
}
}else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='Form Three' AND term='Term I'";
    $resultcount = mysqli_query($db, $sqlcount);
    if (mysqli_num_rows($resultcount)!=0) {
    while($rowcount = mysqli_fetch_array($resultcount)){
      $total=$rowcount[0];
      $pdf->cell(7,3,$total, 1, 0, 'C');
    }
  }else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}

$sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Three' AND term='Term I'";
              $result1=mysqli_query($db,$sql1);
              if (mysqli_num_rows($result1)!=0) {    
                  while ($row1=mysqli_fetch_assoc($result1)) {   
                      $tmarks=$row1['sum(marks)'];
                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Three' AND term='Term I'";
                        $resultc = mysqli_query($db, $sqlc);
                        while($rowc= mysqli_fetch_array($resultc)){
                          $count=$rowc[0];
                          $genmarks=@($tmarks/$count);     
                          include 'gengrading.php';
                   $pdf->cell(6,3,$gengrade, 1, 0, 'C');
        }
      }
  }else{
    $pdf->cell(6,3,"_", 1, 0, 'C');
  }

      $pdf->cell(10,3,"1", 1, 0, 'C');
    $sqlan="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  class='Form Four' AND term='Term I' ORDER BY total DESC) s";
  $resultan=mysqli_query($db,$sqlan);
  if (mysqli_num_rows($resultan)!=0) {      
    while ($rowan=mysqli_fetch_assoc($resultan)) {
         $classindexnumber=$rowan['indexnumber'];
      $anrank=$rowan['rank'];

    if($classindexnumber==$indexnumber)
    {

  $pdf->cell(7,3,$anrank, 1, 0, 'C');    
}
}
}else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='Form Four' AND term='Term I'";
    $resultcount = mysqli_query($db, $sqlcount);
    if (mysqli_num_rows($resultcount)!=0) {
    while($rowcount = mysqli_fetch_array($resultcount)){
      $total=$rowcount[0];
      $pdf->cell(7,3,$total, 1, 0, 'C');
    }
  }else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}

$sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Four' AND term='Term I'";
              $result1=mysqli_query($db,$sql1);
              if (mysqli_num_rows($result1)!=0) {    
                  while ($row1=mysqli_fetch_assoc($result1)) {   
                      $tmarks=$row1['sum(marks)'];
                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Four' AND term='Term I'";
                        $resultc = mysqli_query($db, $sqlc);
                        while($rowc= mysqli_fetch_array($resultc)){
                          $count=$rowc[0];
                          $genmarks=@($tmarks/$count);     
                          include 'gengrading.php';
                   $pdf->cell(6,3,$gengrade, 1, 1, 'C');
        }
      }
  }else{
    $pdf->cell(6,3,"_", 1, 1, 'C');
  }

      $pdf->cell(30,3,"", 0, 0, 'C');
      $pdf->cell(10,3,"2", 1, 0, 'C');
      $sqlan="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  class='Form One' AND term='Term II' ORDER BY total DESC) s";
  $resultan=mysqli_query($db,$sqlan);
  if (mysqli_num_rows($resultan)!=0) {      
    while ($rowan=mysqli_fetch_assoc($resultan)) {
         $classindexnumber=$rowan['indexnumber'];
      $anrank=$rowan['rank'];

    if($classindexnumber==$indexnumber)
    {

  $pdf->cell(7,3,$anrank, 1, 0, 'C');    
}
}
}else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='Form One' AND term='Term II'";
    $resultcount = mysqli_query($db, $sqlcount);
    if (mysqli_num_rows($resultcount)!=0) {
    while($rowcount = mysqli_fetch_array($resultcount)){
      $total=$rowcount[0];
      $pdf->cell(7,3,$total, 1, 0, 'C');
    }
  }else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}

$sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form One' AND term='Term II'";
              $result1=mysqli_query($db,$sql1);
              if (mysqli_num_rows($result1)!=0) {    
                  while ($row1=mysqli_fetch_assoc($result1)) {   
                      $tmarks=$row1['sum(marks)'];
                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form One' AND term='Term II'";
                        $resultc = mysqli_query($db, $sqlc);
                        while($rowc= mysqli_fetch_array($resultc)){
                          $count=$rowc[0];
                          $genmarks=@($tmarks/$count);     
                          include 'gengrading.php';
                   $pdf->cell(6,3,$gengrade, 1, 0, 'C');
        }
      }
  }else{
    $pdf->cell(6,3,"_", 1, 0, 'C');
  }
  

      $pdf->cell(10,3,"2", 1, 0, 'C');
      $sqlan="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  class='Form Two' AND term='Term II' ORDER BY total DESC) s";
  $resultan=mysqli_query($db,$sqlan);
  if (mysqli_num_rows($resultan)!=0) {      
    while ($rowan=mysqli_fetch_assoc($resultan)) {
         $classindexnumber=$rowan['indexnumber'];
      $anrank=$rowan['rank'];

    if($classindexnumber==$indexnumber)
    {

  $pdf->cell(7,3,$anrank, 1, 0, 'C');    
}
}
}else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='Form Two' AND term='Term II'";
    $resultcount = mysqli_query($db, $sqlcount);
    if (mysqli_num_rows($resultcount)!=0) {
    while($rowcount = mysqli_fetch_array($resultcount)){
      $total=$rowcount[0];
      $pdf->cell(7,3,$total, 1, 0, 'C');
    }
  }else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}

$sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Two' AND term='Term II'";
              $result1=mysqli_query($db,$sql1);
              if (mysqli_num_rows($result1)!=0) {    
                  while ($row1=mysqli_fetch_assoc($result1)) {   
                      $tmarks=$row1['sum(marks)'];
                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Two' AND term='Term II'";
                        $resultc = mysqli_query($db, $sqlc);
                        while($rowc= mysqli_fetch_array($resultc)){
                          $count=$rowc[0];
                          $genmarks=@($tmarks/$count);     
                          include 'gengrading.php';
                   $pdf->cell(6,3,$gengrade, 1, 0, 'C');
        }
      }
  }else{
    $pdf->cell(6,3,"_", 1, 0, 'C');
  }

$pdf->cell(10,3,"2", 1, 0, 'C');
$sqlan="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  class='Form Three' AND term='Term II' ORDER BY total DESC) s";
  $resultan=mysqli_query($db,$sqlan);
  if (mysqli_num_rows($resultan)!=0) {      
    while ($rowan=mysqli_fetch_assoc($resultan)) {
         $classindexnumber=$rowan['indexnumber'];
      $anrank=$rowan['rank'];

    if($classindexnumber==$indexnumber)
    {

  $pdf->cell(7,3,$anrank, 1, 0, 'C');    
}
}
}else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='Form Three' AND term='Term II'";
    $resultcount = mysqli_query($db, $sqlcount);
    if (mysqli_num_rows($resultcount)!=0) {
    while($rowcount = mysqli_fetch_array($resultcount)){
      $total=$rowcount[0];
      $pdf->cell(7,3,$total, 1, 0, 'C');
    }
  }else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}

$sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Three' AND term='Term II'";
              $result1=mysqli_query($db,$sql1);
              if (mysqli_num_rows($result1)!=0) {    
                  while ($row1=mysqli_fetch_assoc($result1)) {   
                      $tmarks=$row1['sum(marks)'];
                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Three' AND term='Term II'";
                        $resultc = mysqli_query($db, $sqlc);
                        while($rowc= mysqli_fetch_array($resultc)){
                          $count=$rowc[0];
                          $genmarks=@($tmarks/$count);     
                          include 'gengrading.php';
                   $pdf->cell(6,3,$gengrade, 1, 0, 'C');
        }
      }
  }else{
    $pdf->cell(6,3,"_", 1, 0, 'C');
  }

      $pdf->cell(10,3,"2", 1, 0, 'C');
    $sqlan="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  class='Form Four' AND term='Term II' ORDER BY total DESC) s";
  $resultan=mysqli_query($db,$sqlan);
  if (mysqli_num_rows($resultan)!=0) {      
    while ($rowan=mysqli_fetch_assoc($resultan)) {
         $classindexnumber=$rowan['indexnumber'];
      $anrank=$rowan['rank'];

    if($classindexnumber==$indexnumber)
    {

  $pdf->cell(7,3,$anrank, 1, 0, 'C');    
}
}
}else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='Form Four' AND term='Term II'";
    $resultcount = mysqli_query($db, $sqlcount);
    if (mysqli_num_rows($resultcount)!=0) {
    while($rowcount = mysqli_fetch_array($resultcount)){
      $total=$rowcount[0];
      $pdf->cell(7,3,$total, 1, 0, 'C');
    }
  }else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}

$sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Four' AND term='Term II'";
              $result1=mysqli_query($db,$sql1);
              if (mysqli_num_rows($result1)!=0) {    
                  while ($row1=mysqli_fetch_assoc($result1)) {   
                      $tmarks=$row1['sum(marks)'];
                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Four' AND term='Term II'";
                        $resultc = mysqli_query($db, $sqlc);
                        while($rowc= mysqli_fetch_array($resultc)){
                          $count=$rowc[0];
                          $genmarks=@($tmarks/$count);     
                          include 'gengrading.php';
                   $pdf->cell(6,3,$gengrade, 1, 1, 'C');
        }
      }
  }else{
    $pdf->cell(6,3,"_", 1, 1, 'C');
  }

      $pdf->cell(30,3,"", 0, 0, 'C');
      $pdf->cell(10,3,"3", 1, 0, 'C');
     $sqlan="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  class='Form One' AND term='Term III' ORDER BY total DESC) s";
  $resultan=mysqli_query($db,$sqlan);
  if (mysqli_num_rows($resultan)!=0) {      
    while ($rowan=mysqli_fetch_assoc($resultan)) {
         $classindexnumber=$rowan['indexnumber'];
      $anrank=$rowan['rank'];

    if($classindexnumber==$indexnumber)
    {

  $pdf->cell(7,3,$anrank, 1, 0, 'C');    
}
}
}else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='Form One' AND term='Term III'";
    $resultcount = mysqli_query($db, $sqlcount);
    if (mysqli_num_rows($resultcount)!=0) {
    while($rowcount = mysqli_fetch_array($resultcount)){
      $total=$rowcount[0];
      $pdf->cell(7,3,$total, 1, 0, 'C');
    }
  }else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}

$sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form One' AND term='Term III'";
              $result1=mysqli_query($db,$sql1);
              if (mysqli_num_rows($result1)!=0) {    
                  while ($row1=mysqli_fetch_assoc($result1)) {   
                      $tmarks=$row1['sum(marks)'];
                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form One' AND term='Term III'";
                        $resultc = mysqli_query($db, $sqlc);
                        while($rowc= mysqli_fetch_array($resultc)){
                          $count=$rowc[0];
                          $genmarks=@($tmarks/$count);     
                          include 'gengrading.php';
                   $pdf->cell(6,3,$gengrade, 1, 0, 'C');
        }
      }
  }else{
    $pdf->cell(6,3,"_", 1, 0, 'C');
  }
  

      $pdf->cell(10,3,"3", 1, 0, 'C');
      $sqlan="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  class='Form Two' AND term='Term III' ORDER BY total DESC) s";
  $resultan=mysqli_query($db,$sqlan);
  if (mysqli_num_rows($resultan)!=0) {      
    while ($rowan=mysqli_fetch_assoc($resultan)) {
         $classindexnumber=$rowan['indexnumber'];
      $anrank=$rowan['rank'];

    if($classindexnumber==$indexnumber)
    {

  $pdf->cell(7,3,$anrank, 1, 0, 'C');    
}
}
}else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='Form Two' AND term='Term III'";
    $resultcount = mysqli_query($db, $sqlcount);
    if (mysqli_num_rows($resultcount)!=0) {
    while($rowcount = mysqli_fetch_array($resultcount)){
      $total=$rowcount[0];
      $pdf->cell(7,3,$total, 1, 0, 'C');
    }
  }else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}

$sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Two' AND term='Term III'";
              $result1=mysqli_query($db,$sql1);
              if (mysqli_num_rows($result1)!=0) {    
                  while ($row1=mysqli_fetch_assoc($result1)) {   
                      $tmarks=$row1['sum(marks)'];
                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Two' AND term='Term III'";
                        $resultc = mysqli_query($db, $sqlc);
                        while($rowc= mysqli_fetch_array($resultc)){
                          $count=$rowc[0];
                          $genmarks=@($tmarks/$count);     
                          include 'gengrading.php';
                   $pdf->cell(6,3,$gengrade, 1, 0, 'C');
        }
      }
  }else{
    $pdf->cell(6,3,"_", 1, 0, 'C');
  }
  

$pdf->cell(10,3,"3", 1, 0, 'C');
$sqlan="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  class='Form Three' AND term='Term III' ORDER BY total DESC) s";
  $resultan=mysqli_query($db,$sqlan);
  if (mysqli_num_rows($resultan)!=0) {      
    while ($rowan=mysqli_fetch_assoc($resultan)) {
         $classindexnumber=$rowan['indexnumber'];
      $anrank=$rowan['rank'];

    if($classindexnumber==$indexnumber)
    {

  $pdf->cell(7,3,$anrank, 1, 0, 'C');    
}
}
}else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='Form Three' AND term='Term III'";
    $resultcount = mysqli_query($db, $sqlcount);
    if (mysqli_num_rows($resultcount)!=0) {
    while($rowcount = mysqli_fetch_array($resultcount)){
      $total=$rowcount[0];
      $pdf->cell(7,3,$total, 1, 0, 'C');
    }
  }else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}

$sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Three' AND term='Term III'";
              $result1=mysqli_query($db,$sql1);
              if (mysqli_num_rows($result1)!=0) {    
                  while ($row1=mysqli_fetch_assoc($result1)) {   
                      $tmarks=$row1['sum(marks)'];
                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Three' AND term='Term III'";
                        $resultc = mysqli_query($db, $sqlc);
                        while($rowc= mysqli_fetch_array($resultc)){
                          $count=$rowc[0];
                          $genmarks=@($tmarks/$count);     
                          include 'gengrading.php';
                   $pdf->cell(6,3,$gengrade, 1, 0, 'C');
        }
      }
  }else{
    $pdf->cell(6,3,"_", 1, 0, 'C');
  }

      $pdf->cell(10,3,"3", 1, 0, 'C');
    $sqlan="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM overallpositioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE  class='Form Four' AND term='Term III' ORDER BY total DESC) s";
  $resultan=mysqli_query($db,$sqlan);
  if (mysqli_num_rows($resultan)!=0) {      
    while ($rowan=mysqli_fetch_assoc($resultan)) {
         $classindexnumber=$rowan['indexnumber'];
      $anrank=$rowan['rank'];

    if($classindexnumber==$indexnumber)
    {

  $pdf->cell(7,3,$anrank, 1, 0, 'C');    
}
}
}else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}
$sqlcount= "SELECT count(1) FROM overallpositioning WHERE class='Form Four' AND term='Term III'";
    $resultcount = mysqli_query($db, $sqlcount);
    if (mysqli_num_rows($resultcount)!=0) {
    while($rowcount = mysqli_fetch_array($resultcount)){
      $total=$rowcount[0];
      $pdf->cell(7,3,$total, 1, 0, 'C');
    }
  }else{
  $pdf->cell(7,3,"_", 1, 0, 'C');
}

$sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Four' AND term='Term III'";
              $result1=mysqli_query($db,$sql1);
              if (mysqli_num_rows($result1)!=0) {    
                  while ($row1=mysqli_fetch_assoc($result1)) {   
                      $tmarks=$row1['sum(marks)'];
                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Four' AND term='Term III'";
                        $resultc = mysqli_query($db, $sqlc);
                        while($rowc= mysqli_fetch_array($resultc)){
                          $count=$rowc[0];
                          $genmarks=@($tmarks/$count);     
                          include 'gengrading.php';
                   $pdf->cell(6,3,$gengrade, 1, 1, 'C');
        }
      }
  }else{
    $pdf->cell(6,3,"_", 1, 1, 'C');
  }

      




         /*


          $pdf->cell(60, 1, " ", 0, 1, 'C');
          $pdf->cell(15, 3, "F4T3", 0, 0, '');
          */

      //from here graph

    $sqlgraph= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND term='Term I' AND class='Form One'";
        $resultgraph = mysqli_query($db, $sqlgraph);
        if (mysqli_num_rows($resultgraph)!=0) {
        while($rowgraph= mysqli_fetch_array($resultgraph)){
          $totalm=$rowgraph['total'];
          $grapht=@($totalm);
          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form One' AND term='Term I'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $f1t1=@($grapht/$count);
          
        }      
        }
      }else if (mysqli_num_rows($resultgraph)<1){
        $f1t1="0";
      }
      $sqlgraph= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND term='Term II' AND class='Form One'";
        $resultgraph = mysqli_query($db, $sqlgraph);
        if (mysqli_num_rows($resultgraph)!=0) {
        while($rowgraph= mysqli_fetch_array($resultgraph)){
          $totalm=$rowgraph['total'];
          $grapht=@($totalm);
          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form One' AND term='Term II'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $f1t2=@($grapht/$count);
        }      
        }
      }else if (mysqli_num_rows($resultgraph)<1){
        $f1t2="0";
      }
       $sqlgraph= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND term='Term III' AND class='Form One'";
        $resultgraph = mysqli_query($db, $sqlgraph);
        if (mysqli_num_rows($resultgraph)!=0) {
        while($rowgraph= mysqli_fetch_array($resultgraph)){
          $totalm=$rowgraph['total'];
          $grapht=@($totalm);
          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form One' AND term='Term III'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $f1t3=@($grapht/$count);
        }      
        }
      }else if (mysqli_num_rows($resultgraph)<1){
        $f1t3="0";
      } 
      $sqlgraph= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND term='Term I' AND class='Form Two'";
        $resultgraph = mysqli_query($db, $sqlgraph);
        if (mysqli_num_rows($resultgraph)!=0) {
        while($rowgraph= mysqli_fetch_array($resultgraph)){
          $totalm=$rowgraph['total'];
          $grapht=@($totalm);
          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND term='Term I' AND class='Form Two'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $f2t1=@($grapht/$count);
        }      
        }
      }else if (mysqli_num_rows($resultgraph)<1){
        $f2t1="0";
      }
      $sqlgraph= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND term='Term II' AND class='Form Two'";
        $resultgraph = mysqli_query($db, $sqlgraph);
        if (mysqli_num_rows($resultgraph)!=0) {
        while($rowgraph= mysqli_fetch_array($resultgraph)){
          $totalm=$rowgraph['total'];
          $grapht=@($totalm);
          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND term='Term II' AND class='Form Two'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $f2t2=@($grapht/$count);
        }      
        }
      }else if (mysqli_num_rows($resultgraph)<1){
        $f2t2="0";
      }
      $sqlgraph= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND term='Term III' AND class='Form Two'";
        $resultgraph = mysqli_query($db, $sqlgraph);
        if (mysqli_num_rows($resultgraph)!=0) {
        while($rowgraph= mysqli_fetch_array($resultgraph)){
          $totalm=$rowgraph['total'];
          $grapht=@($totalm);
          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Two' AND term='Term III'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $f2t3=@($grapht/$count);
        }      
        }
      }else if (mysqli_num_rows($resultgraph)<1){
        $f2t3="0";
      }
      $sqlgraph= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND term='Term I' AND class='Form Three'";
        $resultgraph = mysqli_query($db, $sqlgraph);
        if (mysqli_num_rows($resultgraph)!=0) {
        while($rowgraph= mysqli_fetch_array($resultgraph)){
          $totalm=$rowgraph['total'];
          $grapht=@($totalm);
          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND term='Term I' AND class='Form Three'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $f3t1=@($grapht/$count);
        }      
        }
      }else if (mysqli_num_rows($resultgraph)<1){
        $f3t1="0";
      }
       $sqlgraph= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND term='Term II' AND class='Form Three'";
        $resultgraph = mysqli_query($db, $sqlgraph);
        if (mysqli_num_rows($resultgraph)!=0) {
        while($rowgraph= mysqli_fetch_array($resultgraph)){
          $totalm=$rowgraph['total'];
          $grapht=@($totalm);
          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND term='Term II' AND class='Form Three'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $f3t2=@($grapht/$count);
        }      
        }
      }else if (mysqli_num_rows($resultgraph)<1){
        $f3t2="0";
      }
      $sqlgraph= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND term='Term III' AND class='Form Three'";
        $resultgraph = mysqli_query($db, $sqlgraph);
        if (mysqli_num_rows($resultgraph)!=0) {
        while($rowgraph= mysqli_fetch_array($resultgraph)){
          $totalm=$rowgraph['total'];
          $grapht=@($totalm);
          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Three' AND term='Term III'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $f3t3=@($grapht/$count);
        }      
        }
      }else if (mysqli_num_rows($resultgraph)<1){
        $f3t3="0";
      }
      $sqlgraph= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND term='Term I' AND class='Form Four'";
        $resultgraph = mysqli_query($db, $sqlgraph);
        if (mysqli_num_rows($resultgraph)!=0) {
        while($rowgraph= mysqli_fetch_array($resultgraph)){
          $totalm=$rowgraph['total'];
          $grapht=@($totalm);
          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND term='Term I' AND class='Form Four'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $f4t1=@($grapht/$count);
        }      
        }
      }else if (mysqli_num_rows($resultgraph)<1){
        $f4t1="0";
      }
      $sqlgraph= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND term='Term II' AND class='Form Four'";
        $resultgraph = mysqli_query($db, $sqlgraph);
        if (mysqli_num_rows($resultgraph)!=0) {
        while($rowgraph= mysqli_fetch_array($resultgraph)){
          $totalm=$rowgraph['total'];
          $grapht=@($totalm);
          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND term='Term II' AND class='Form Four'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $f4t2=@($grapht/$count);
        }      
        }
      }else if (mysqli_num_rows($resultgraph)<1){
        $f4t2="0";
      }
      $sqlgraph= "SELECT * FROM overallpositioning WHERE indexnumber='$indexnumber' AND term='Term III' AND class='Form Four'";
        $resultgraph = mysqli_query($db, $sqlgraph);
        if (mysqli_num_rows($resultgraph)!=0) {
        while($rowgraph= mysqli_fetch_array($resultgraph)){
          $totalm=$rowgraph['total'];
          $grapht=@($totalm);
          $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='Form Four' AND term='Term III'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $f4t3=@($grapht/$count);
        }      
        }
      }else if (mysqli_num_rows($resultgraph)<1){
        $f4t3="0";
      }

      $data=Array(
  'F1T1'=>[
    'color'=>[128,128,128],
    'value'=>round($f1t1)],
  
  'F1T2'=>[
    'color'=>[128,128,128],
    'value'=>round($f1t2)],

    'F1T3'=>[
    'color'=>[128,128,128],
    'value'=>round($f1t3)],

    'F2T1'=>[
    'color'=>[128,128,128],
    'value'=>round($f2t1)],

    'F2T2'=>[
    'color'=>[128,128,128],
    'value'=>round($f2t2)],

    'F2T3'=>[
    'color'=>[128,128,128],
    'value'=>round($f2t3)],

    'F3T1'=>[
    'color'=>[128,128,128],
    'value'=>round($f3t1)],

    'F3T2'=>[
    'color'=>[128,128,128],
    'value'=>round($f3t2)],

    'F3T3'=>[
    'color'=>[128,128,128],
    'value'=>round($f3t3)],

    'F4T1'=>[
    'color'=>[128,128,128],
    'value'=>round($f4t1)],

    'F4T2'=>[
    'color'=>[128,128,128],
    'value'=>round($f4t2)],

    'F4T3'=>[
    'color'=>[128,128,128],
    'value'=>round($f4t3)]
  );
      //to here graph
//graph
//$dataMax
$dataMax=0;
foreach($data as $item){
  if($item['value']>$dataMax)$dataMax=$item['value'];
}

//data step
$dataStep=50;

//set font, line width and color
$pdf->SetFont('Arial','',9);
$pdf->SetLineWidth(0.2);
$pdf->SetDrawColor(0);

//chart boundary
$pdf->Rect($chartX,$chartY,$chartWidth,$chartHeight);

//vertical axis line
$pdf->Line(
  $chartBoxX ,
  $chartBoxY , 
  $chartBoxX , 
  ($chartBoxY+$chartBoxHeight)
  );
//horizontal axis line
$pdf->Line(
  $chartBoxX-2 , 
  ($chartBoxY+$chartBoxHeight) , 
  $chartBoxX+($chartBoxWidth) , 
  ($chartBoxY+$chartBoxHeight)
  );

///vertical axis
//calculate chart's y axis scale unit
$yAxisUnits=$chartBoxHeight/$dataMax;

//draw the vertical (y) axis labels
for($i=0 ; $i<=$dataMax ; $i+=$dataStep){
  //y position
  $yAxisPos=$chartBoxY+($yAxisUnits*$i);
  //draw y axis line
  $pdf->Line(
    $chartBoxX-2 ,
    $yAxisPos ,
    $chartBoxX ,
    $yAxisPos
  );
  //set cell position for y axis labels
  $pdf->SetXY($chartBoxX-$chartLeftPadding , $yAxisPos-2);
  //$pdf->Cell($chartLeftPadding-4 , 5 , $dataMax-$i , 1);---------------
  $pdf->Cell($chartLeftPadding-4 , 5 , $dataMax-$i, 0 , 0 , 'R');
}

///horizontal axis
//set cells position
$pdf->SetXY($chartBoxX , $chartBoxY+$chartBoxHeight);

//cell's width
$xLabelWidth=$chartBoxWidth / count($data);

//$pdf->Cell($xLabelWidth , 5 , $itemName , 1 , 0 , 'C');-------------
//loop horizontal axis and draw the bar
$barXPos=0;
foreach($data as $itemName=>$item){
  //print the label
  //$pdf->Cell($xLabelWidth , 5 , $itemName , 1 , 0 , 'C');--------------
  $pdf->Cell($xLabelWidth , 5 , $itemName , 0 , 0 , 'C');
  
  ///drawing the bar
  //bar color
  $pdf->SetFillColor($item['color'][0],$item['color'][1],$item['color'][2]);
  //bar height
  $barHeight=$yAxisUnits*$item['value'];
  //bar x position
  $barX=($xLabelWidth/2)+($xLabelWidth*$barXPos);
  $barX=$barX-($barWidth/2);
  $barX=$barX+$chartBoxX;
  //bar y position
  $barY=$chartBoxHeight-$barHeight;
  $barY=$barY+$chartBoxY;
  //draw the bar
  $pdf->Rect($barX,$barY,$barWidth,$barHeight,'DF');
  //increase x position (next series)
  $barXPos++;
}

//axis labels
$pdf->SetFont('Arial','B',7);
$pdf->SetXY($chartX,$chartY);
$pdf->Cell(100,10,"Mean",0);
$pdf->SetXY(($chartWidth/2)-50+$chartX,$chartY+$chartHeight-($chartBottomPadding/2));
$pdf->Cell(100,5,"Class",0,0,'C');

  //end graph


$pdf->cell(180, 8, " ", 0, 1, 'C');



      $pdf->setFont('Arial','B',6);
          $pdf->cell(60, 2, " ", 0, 1, 'C');
          $pdf->cell(20, 5, "", 0, 0, 'C');
        $pdf->cell(60, 5, "Class Teacher's Remarks", 1, 0, 'C');
        $pdf->cell(100, 5, "", 0, 1, 'C');

        $pdf->cell(20, 5, "", 0, 0, 'C');

         //class teacher
        $sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  acyear='$s_acyear'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                      
                      $tmarks=$row1['sum(marks)'];

                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  acyear='$s_acyear'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $genmarks=@($totalmarks/$count);
                          
                          include 'gengrading.php';

                           $sqlcremaks= "SELECT * FROM classteacherremarks WHERE class='$s_class' AND stream='$stream' AND  acyear='$s_acyear' AND grade='$gengrade'";
              $resultcremaks=mysqli_query($db,$sqlcremaks);

              if (mysqli_num_rows($resultcremaks)!=0) {
                   
                  while ($rowcremaks=mysqli_fetch_assoc($resultcremaks)) {

                    $name=$rowcremaks['name'];
                    
                      $remarks=$rowcremaks['remarks'];
                      $pdf->cell(120, 7, $remarks, 1, 1, '');
        $pdf->cell(60, 5, "", 0, 0, 'C');

        $pdf->cell(80, 5, $name, 1, 1, 'C');
                    
                  }
                }  
                  
                      }
                   }
                 }
        //end class teacher
               
                 

        

        $pdf->cell(60, 3, " ", 0, 1, 'C');
          $pdf->cell(20, 5, "", 0, 0, 'C');
        $pdf->cell(60, 5, "Head Teacher's Remarks", 1, 0, 'C');
        $pdf->cell(100, 5, "", 0, 1, 'C');

        $pdf->cell(20, 5, "", 0, 0, 'C');

        //head teacher
        $sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  acyear='$s_acyear'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                      
                      $tmarks=$row1['sum(marks)'];

                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND term='$s_term' AND  acyear='$s_acyear'";
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
                      $pdf->cell(120, 7, $remarks, 1, 1, '');
        $pdf->cell(60, 5, "", 0, 0, 'C');
        $pdf->cell(80, 5, $name, 1, 1, 'C');
                    
                  }
                }
              }
            }
          }

  $pdf->cell(180, 5, "", 0, 1, 'C');         
$pdf->setFont('Arial','',8);
 
      $pdf->cell(180, 5, "Fees arrears KES: ...........................    Next term fees KES ........................     Total KES ............................     Sign .......................", 0, 1, 'C');

                $pdf->cell(180, 5, "", 0, 1, 'C');
      $pdf->cell(180, 5, "Parent's Sign: ...........................................          Date:    .........................", 0, 1, 'C');

      $pdf->setFont('Arial','I',8);
      $pdf->cell(180, 5, "The Transcript is issued without alteration or erasure whatsoever", 0, 1, 'C');

                
                  }
              }
  }
 
  $pdf->OutPut();
?>