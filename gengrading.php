<?php
if ($genmarks >=80 && $genmarks <=100) {
   $gengrade="A";
}
else if ($genmarks >=75 && $genmarks <80) {
  $gengrade="A-";
}
 else if ($genmarks >=70 && $genmarks <75) {
  $gengrade="B+";
}
else if ($genmarks >=65 && $genmarks <70) {
  $gengrade="B";
}
else if ($genmarks >=60 && $genmarks <65) {
  $gengrade="B-";
}
else if ($genmarks >=55 && $genmarks <60) {
  $gengrade="C+";
}
else if ($genmarks >=50 && $genmarks <55) {
  $gengrade="C";
}
else if ($genmarks >=45 && $genmarks <50) {
  $gengrade="C-";
}
else if ($genmarks >=40 && $genmarks <45) {
  $gengrade="D+";
}
else if ($genmarks >=35 && $genmarks <40) {
  $gengrade="D";
}
else if ($genmarks >=30 && $genmarks <35) {
  $gengrade="D-";
}
else if ($genmarks >=0 && $genmarks <30) {
  $gengrade="E";
}
else{
  $gengrade="_";
}
?>