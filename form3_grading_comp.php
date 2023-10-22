<?php
if ($marks >=80 && $marks <=100) {
   $grade="A";
}
else if ($marks >=75 && $marks <80) {
  $grade="A-";
}
 else if ($marks >=70 && $marks <75) {
  $grade="B+";
}
else if ($marks >=65 && $marks <70) {
  $grade="B";
}
else if ($marks >=60 && $marks <65) {
  $grade="B-";
}
else if ($marks >=55 && $marks <60) {
  $grade="C+";
}
else if ($marks >=45 && $marks <55) {
  $grade="C";
}
else if ($marks >=40 && $marks <45) {
  $grade="C-";
}
else if ($marks >=35 && $marks <40) {
  $grade="D+";
}
else if ($marks >=30 && $marks <35) {
  $grade="D";
}
else if ($marks >=20 && $marks <30) {
  $grade="D-";
}
else if ($marks >=0 && $marks <20) {
  $grade="E";
}
?>