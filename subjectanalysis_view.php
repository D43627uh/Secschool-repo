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
       $pdf=new FPDF('p','mm',array(310,310));
      //$pdf=new FPDF('p','mm',array(200,205)); 
        $pdf->AddPage();

    $s_class=$_SESSION['classes'];
    $s_term=$_SESSION['terms'];
      $s_exam=$_SESSION['exams'];
      $s_acyear=$_SESSION['acyear'];



     

  $pdf->setFont('Arial','B',12);
  
  //$pdf->cell(180, 0, "", 0, 1, 'C');
  $pdf->cell(300, 8, "PAUL BOIT BOYS HIGH SCHOOL", 0, 1, 'C');

  $pdf->setFont('Arial','',8);
  $pdf->cell(300, 6, "P.O BOX 277, ELDORET", 0, 1, 'C');
  $pdf->cell(300, 6, "info@paulboithigh.sc.ke || www.paulboithigh.sc.ke", 0, 1, 'C');
  $pdf->cell(300, 6,$s_term."  Academic Report  ".$s_acyear, 0, 1, 'C');
  $pdf->cell(300, 6,"Tel: 0798 277 277", 0, 1, 'C');
  $pdf->cell(300, 6, "In Fide Vade", 0, 1, 'C');
  
$pdf-> Image($image,10,5,35,35); 
//$pdf-> Image($image,150,5,35,35);

  $pdf->setFont('Arial','',8);
                
    $pdf->cell(70, 6, "", 0, 0, 'C');
    $pdf->cell(36, 6, "CLASS : ".$s_class, 1, 0, 'C');
    $pdf->cell(36, 6, "EXAM : ".$s_exam, 1, 0, 'C');
    $pdf->cell(36, 6, "TERM : ".$s_term, 1, 0, 'C');
    $pdf->cell(36, 6, "YEAR : ".$s_acyear, 1, 1, 'C');

    $pdf->cell(20, 2, "", 0, 1, 'C');
    //$pdf->cell(36, 6, "ENGLISH", 1, 1, 'C');

    $pdf->cell(20, 2, "", 0, 1, 'C');
    $pdf->cell(36, 5, "", 0, 0, 'C');
    $pdf->cell(12, 5, "A", 1, 0, 'C');
    $pdf->cell(12, 5, "A-", 1, 0, 'C');
    $pdf->cell(12, 5, "B+", 1, 0, 'C');
    $pdf->cell(12, 5, "B", 1, 0, 'C');
    $pdf->cell(12, 5, "B-", 1, 0, 'C');
    $pdf->cell(12, 5, "C+", 1, 0, 'C');
    $pdf->cell(12, 5, "C", 1, 0, 'C');
    $pdf->cell(12, 5, "C-", 1, 0, 'C');
    $pdf->cell(12, 5, "D+", 1, 0, 'C');
    $pdf->cell(12, 5, "D", 1, 0, 'C');
    $pdf->cell(12, 5, "D-", 1, 0, 'C');
    $pdf->cell(12, 5, "E", 1, 0, 'C');
    $pdf->cell(20, 5, "Entry", 1, 0, 'C');
     $pdf->cell(20, 5, "M.Points", 1, 0, 'C');
    $pdf->cell(20, 5, "M.G", 1, 0, 'C');
     $pdf->cell(50, 5, "Subject Teacher", 1, 1, 'C');

$sqlsubject= "SELECT * FROM subjects";
$resultsubject= mysqli_query($db, $sqlsubject);

while($rowsubject = mysqli_fetch_array($resultsubject)){

    $subjectname=$rowsubject['name'];
    $pdf->setFont('Arial','B',10);
    $pdf->cell(36, 6, $subjectname, 1, 1, 'C');
    //$pdf->cell(36, 5, "", 0, 1, 'C');
    $pdf->setFont('Arial','',8);
  $sqlcount= "SELECT * FROM streams";
          $resultcount= mysqli_query($db, $sqlcount);

      while($rowcount = mysqli_fetch_array($resultcount)){

                $name=$rowcount['name'];
                $pdf->cell(36, 6, $name, 1, 0, 'C');

                $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name' AND grade='A'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                $tpoints1=12*$total;
                $pdf->cell(12, 6,$total, 1, 0, 'C');
                
                

            }
            $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name' AND grade='A-'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                 $tpoints2=11*$total;
                $pdf->cell(12, 6, $total, 1, 0, 'C');
            }
            $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name' AND grade='B+'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                 $tpoints3=10*$total;
                $pdf->cell(12, 6, $total, 1, 0, 'C');
            }
            $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name' AND grade='B'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                 $tpoints4=9*$total;
                $pdf->cell(12, 6, $total, 1, 0, 'C');
            }
             $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name' AND grade='B-'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                $tpoints5=8*$total;
                $pdf->cell(12, 6, $total, 1, 0, 'C');
            }
            $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name' AND grade='C+'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                $tpoints5=7*$total;
                $pdf->cell(12, 6, $total, 1, 0, 'C');
            }
            $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name' AND grade='C'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                $tpoints6=6*$total;
                $pdf->cell(12, 6, $total, 1, 0, 'C');
            }
            $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name' AND grade='C-'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                $tpoints7=5*$total;
                $pdf->cell(12, 6, $total, 1, 0, 'C');
            }
            $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name' AND grade='D+'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                $tpoints8=4*$total;
                $pdf->cell(12, 6, $total, 1, 0, 'C');
            }
            $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name' AND grade='D'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                $tpoints9=3*$total;
                $pdf->cell(12, 6, $total, 1, 0, 'C');
            }
            $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name' AND grade='D-'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                $tpoints10=2*$total;
                $pdf->cell(12, 6, $total, 1, 0, 'C');
            }
            $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name' AND grade='E'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                $tpoints11=1*$total;
                $pdf->cell(12, 6, $total, 1, 0, 'C');
            }
            $sqlcount1= "SELECT count(1) FROM exammarks WHERE subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name'";
                        $resultcount1= mysqli_query($db, $sqlcount1);

              while($rowcount1 = mysqli_fetch_array($resultcount1)){

                $total=$rowcount1[0];
                $pdf->cell(20, 6, $total, 1, 0, 'C');
            }
            $sql1= "SELECT sum(marks) FROM exammarks WHERE  subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name'";
                        $result1=mysqli_query($db,$sql1);

                        if (mysqli_num_rows($result1)!=0) {
                             
                            while ($row1=mysqli_fetch_assoc($result1)) {
                      
                       
                      $marks=$row1['sum(marks)'];

                      //from here

                    $sqlc= "SELECT count(1) FROM exammarks WHERE  subject='$subjectname' AND class='$s_class' AND term='$s_term' AND exam='$s_exam' AND acyear='$s_acyear' AND stream='$name'";
                        $resultc = mysqli_query($db, $sqlc);

                        while($rowc= mysqli_fetch_array($resultc)){

                          $count=$rowc[0];
                          $marks=@($marks/$count);
    $totalpoints=$tpoints1+$tpoints2+$tpoints3+$tpoints4+$tpoints5+$tpoints6+$tpoints7+$tpoints8+$tpoints9+$tpoints10+$tpoints11;
                          $av=@($totalpoints/$count);
                          $pdf->cell(20, 6, round($av), 1, 0, 'C');

                          include 'grading.php';
                          $pdf->cell(20, 6, $grade, 1, 0, 'C');
                          //$pdf->cell(20, 6, "", 1, 1, 'C');

        
                         
                       }
                     }
                   }

       $sqlc= "SELECT * FROM subjectsassigned WHERE subject='$subjectname' AND class='$s_class' AND acyear='$s_acyear' AND stream='$name'";
                        $resultc = mysqli_query($db, $sqlc);
                        if (mysqli_num_rows($resultc)!=0) {
                        while($rowc= mysqli_fetch_array($resultc)){

                          $teacher=$rowc['name'];
                          $pdf->cell(50, 6, $teacher, 1, 0, 'C');

                        $pdf->cell(20, 6, "", 0, 1, 'C');
                        } 

                      }else if (mysqli_num_rows($resultc)==0) {
                        $pdf->cell(20, 6, "", 0, 1, 'C');
                      }
                        

      }

}



  $pdf->OutPut();
?>