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


            $sqlpos="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =total,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := total FROM positioning p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' ORDER BY total DESC) s";
                   
              $resultpos=mysqli_query($db,$sqlpos);
$image1="profile/kenya.png";
$image="profile/logo.png";
        //$pdf=new FPDF('p','mm','A4');
       $pdf=new FPDF('p','mm',array(200,306));
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
  $pdf->cell(180, 10, "TAMBACH TEACHERS' COLLEGE", 0, 1, 'C');

  $pdf->setFont('Arial','',11);
  $pdf->cell(180, 7, "P.O PRIVATE BAG", 0, 1, 'C');
  $pdf->cell(180, 7, "ITEN-TAMBACH", 0, 1, 'C');

  $pdf->cell(180, 7, "RESULT TRANSCRIPT", 0, 1, 'C');
$pdf-> Image($image1,10,5,35,35); 
$pdf-> Image($image,150,5,35,35);
  //$pdf->cell(73, 0, "", 0, 1, 'C');

  $pdf->setFont('Arial','',10);
                
    $pdf->cell(90, 10, "NAME : ".$rowpos['name'], 1, 0, 'C');
    $pdf->cell(90, 10,"ADMISSION NUMBER : ". $indexnumber, 1, 1, 'C');


    $pdf->cell(50, 10, "CATEGORY : ".$s_category, 1, 0, 'C');
    $pdf->cell(60, 10, "CLASS : ".$s_class, 1, 0, 'C');
    $pdf->cell(70, 10,"EXAM NAME : ". $s_exam, 1, 1, 'C');

    $pdf->cell(70, 2, "", 0, 1, 'C');

    $pdf->setFont('Arial','B',10);
    $pdf->cell(20, 10, "Code", 1, 0, '');
    $pdf->cell(70, 10, "Subject", 1, 0, '');
    $pdf->cell(70, 10, "Marks", 1, 0, '');
    $pdf->cell(20, 10, "Points", 1, 1, '');

    $pdf->setFont('Arial','',10);
    $pdf->cell(20, 10, "1011", 1, 0, '');
    $pdf->cell(70, 10, "Education", 1, 0, '');
    
        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Education'";
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

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='English'";
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

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Kiswahili'";
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
     $pdf->cell(70, 10, "Physical Education", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Physical Education'";
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
    $pdf->cell(70, 10, "Mathematics", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Mathematics'";
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
    $pdf->cell(70, 10, "Science", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Science'";
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
    $pdf->cell(20, 10, "2013", 1, 0, '');
    $pdf->cell(70, 10, "Agriculture", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Agriculture'";
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
    $pdf->cell(20, 10, "2014", 1, 0, '');
    $pdf->cell(70, 10, "Home Science", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Home Science'";
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
    $pdf->cell(20, 10, "3011", 1, 0, '');
    $pdf->cell(70, 10, "CRE", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='CRE'";
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
    $pdf->cell(20, 10, "3012", 1, 0, '');
    $pdf->cell(70, 10, "IRE", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='IRE'";
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
    
    $pdf->cell(20, 10, "3013", 1, 0, '');
    $pdf->cell(70, 10, "Social Studies", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Social Studies'";
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
    $pdf->cell(20, 10, "3014", 1, 0, '');
    $pdf->cell(70, 10, "Art & Craft", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Art & Craft'";
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
    $pdf->cell(20, 10, "3015", 1, 0, '');
    $pdf->cell(70, 10, "Music", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='Music'";
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
    $pdf->cell(20, 10, "5011", 1, 0, '');
    $pdf->cell(70, 10, "ICT", 1, 0, '');

        $sqlmark= "SELECT * FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear' AND subject='ICT'";
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
          $sql1= "SELECT sum(marks) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                      
                      $marks=$row1['sum(marks)'];

                       $sqlc= "SELECT count(1) FROM exammarks WHERE indexnumber='$indexnumber' AND class='$s_class' AND category='$s_category' AND exam='$s_exam' AND  acyear='$s_acyear'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $mean=$marks/$count;
                          if ($mean >=80 && $mean <=100) {
                            $grade="1";
                          }
                          else if ($mean >=76 && $mean <80) {
                            $grade="2";
                          }
                           else if ($mean >=70 && $mean <76) {
                            $grade="3";
                          }
                          else if ($mean >=60 && $mean <70) {
                            $grade="4";
                          }
                          else if ($mean >=50 && $mean <60) {
                            $grade="5";
                          }
                          else if ($mean>=40 && $mean <50) {
                            $grade="6";
                          }
                          else if ($mean >=30 && $mean <40) {
                            $grade="7";
                          }
                          else if ($mean >=0 && $mean <30) {
                            $grade="8";
                          }
                     
                    $pdf->cell(90, 10, $marks, 1, 1, '');

                   $pdf->cell(90, 10, "Mean Marks", 1, 0, '');
                   $pdf->cell(90, 10, $mean, 1, 1, '');

                   //$pdf->cell(90, 10, "Grade", 1, 0, '');
                   //$pdf->cell(90, 10, $grade, 1, 1, '');


                    //from here
                    $sqlsum= "SELECT sum(grade) FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear'  AND  subject!='ICT'";
                        $resultsum = mysqli_query($db, $sqlsum);

                        while($rowsum= mysqli_fetch_array($resultsum)){

                          $totalgrade=$rowsum['sum(grade)'];
                         
                      }
                      //sum grade
                       $sqlsum= "SELECT sum(grade) FROM exammarks WHERE indexnumber='$indexnumber' AND category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND  acyear='$s_acyear' AND  subject!='ICT'";
                        $resultsum = mysqli_query($db, $sqlsum);

                        while($rowsum= mysqli_fetch_array($resultsum)){

                          $tgrade=$rowsum['sum(grade)'];
                         if ($tgrade >=0 && $tgrade <=22) {
                            $tgrade="Distinction";
                          }
                          else if ($tgrade >=23 && $tgrade <50) {
                            $tgrade="Credit";
                          }
                           else if ($tgrade >=50 && $tgrade <69) {
                            $tgrade="Pass";
                          }
                          else if ($tgrade >=69 && $tgrade <=100) {
                            $tgrade="Fail";
                          }
                    $pdf->cell(90, 10, "Total Points", 1, 0, '');
                   $pdf->cell(90, 10, $totalgrade, 1, 1, '');
                   $pdf->cell(90, 10, "Grade", 1, 0, '');
                   $pdf->cell(90, 10, $tgrade, 1, 1, '');
                      }
                   //to here
                     
                   }
                 
                   }
                 }

                 /*$sqlmark= "SELECT * FROM students WHERE indexnumber='$indexnumber'";
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