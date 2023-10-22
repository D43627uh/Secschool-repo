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
    if(isset($_SESSION["subjects"])){
     $_SESSION['subjects'];
    } 
    $s_class=$_SESSION['classes'];
    $s_category=$_SESSION['categories'];
    $s_exam=$_SESSION['exams'];
    $s_subject=$_SESSION['subjects'];

  $sql="SELECT * FROM (SELECT *, @curRank := IF(@prevRank =marks,@curRank, @incRank) AS rank, @incRank := @incRank + 1, @prevRank := marks FROM exammarks p, (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) r WHERE category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='$s_subject' ORDER BY marks DESC) s";

  $records=mysqli_query($db,$sql);

  

  $pdf=new FPDF('p','mm','A4');

  $pdf->AddPage();

  $pdf->setFont('Arial','B',14);
  
  $pdf->cell(180, 10, "", 0, 1, 'C');
  $pdf->cell(180, 10, "TAMBACH TEACHERS' COLLEGE", 0, 1, 'C');
  $pdf->cell(180, 10, "Student Marks", 0, 1, 'C');
  $pdf->cell(53, 10, $s_category, 1, 0, 'C');
  $pdf->cell(63, 10, $s_class, 1, 0, 'C');
  $pdf->cell(73, 10, $s_exam, 1, 1, 'C');

  $pdf->cell(73, 5, "", 0, 1, 'C');
  $pdf->cell(23, 10, "Position", 1, 0, 'C');
  $pdf->cell(43, 10, "Index", 1, 0, 'C');
  $pdf->cell(68, 10, "Name", 1, 0, 'C');
  $pdf->cell(35, 10, $s_subject, 1, 0, 'C');
  $pdf->cell(20, 10, "Grade", 1, 1, 'C');

  $pdf->setFont('Arial','',11);
  while ($row=mysqli_fetch_array($records)) {

    $pdf->cell(23, 10, $row['rank'], 1, 0, 'C');
    $pdf->cell(43, 10, $row['indexnumber'], 1, 0, 'C');
    $pdf->cell(68, 10, $row['name'], 1, 0, 'C');
    $pdf->cell(35, 10, $row['marks'], 1, 0, 'C');

     if ($row['marks'] >=80 && $row['marks'] <=100) {
        $grade="A";
        $pdf->cell(20, 10, $grade, 1, 1, 'C');
      }
      else if ($row['marks'] >=60 && $row['marks'] <=80) {
        $grade="B";
        $pdf->cell(20, 10, $grade, 1, 1, 'C');

      }
       else if ($row['marks'] >=40 && $row['marks'] <=59) {
        $grade="C";
        $pdf->cell(20, 10, $grade, 1, 1, 'C');
      }
       else if ($row['marks'] >=20 && $row['marks'] <=39) {
        $grade="D";
        $pdf->cell(20, 10, $grade, 1, 1, 'C');
      }

  }

   $pdf->setFont('Arial','B',14);

   $sql1= "SELECT sum(marks) FROM exammarks WHERE category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='$s_subject'";
              $result1=mysqli_query($db,$sql1);

              if (mysqli_num_rows($result1)!=0) {
                   
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                       
                      $marks=$row1['sum(marks)'];

                      //from here

                       $sqlc= "SELECT count(1) FROM exammarks WHERE category='$s_category' AND exam='$s_exam' AND  class='$s_class' AND subject='$s_subject'";
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
                   }
                 
                   }
                 }

  $pdf->cell(73, 5, "", 0, 1, 'C');
  $pdf->cell(53, 10, "Total", 1, 0, 'C');
  $pdf->cell(73, 10, $marks, 1, 1, 'C');
  $pdf->cell(53, 10, "Mean", 1, 0, 'C');
  $pdf->cell(73, 10, $mean, 1, 1, 'C');
  $pdf->cell(53, 10, "Grade", 1, 0, 'C');
  $pdf->cell(73, 10, $grade, 1, 1, 'C');

  $pdf->OutPut();

?>