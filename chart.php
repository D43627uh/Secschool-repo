<?php
include 'server.php';
require("library/fpdf.php");

$pdf = new FPDF('P','mm','A4'); //use new class
$pdf->AddPage();

//position
$chartX=30;
$chartY=100;

//dimension
$chartWidth=150;
$chartHeight=100;

//padding
$chartTopPadding=10;
$chartLeftPadding=20;
$chartBottomPadding=20;
$chartRightPadding=5;

//chart box
$chartBoxX=$chartX+$chartLeftPadding;
$chartBoxY=$chartY+$chartTopPadding;
$chartBoxWidth=$chartWidth-$chartLeftPadding-$chartRightPadding;
$chartBoxHeight=$chartHeight-$chartBottomPadding-$chartTopPadding;

//bar width
$barWidth=10;
	
$sqlmarks= "SELECT * FROM overallpositioning WHERE indexnumber='10' AND term='Term I' AND class='Form One' AND  acyear='2018'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $totalm=$rowmarks['total'];
          $total1=@($totalm/3);
		
      }
  }
  $sqlmarks= "SELECT * FROM overallpositioning WHERE indexnumber='10w' AND term='Term I' AND class='Form One' AND  acyear='2018'";
        $resultmarks = mysqli_query($db, $sqlmarks);
        if (mysqli_num_rows($resultmarks)!=0) {
        while($rowmarks= mysqli_fetch_array($resultmarks)){
          $totalm=$rowmarks['total'];
          $total2=@($totalm/3);
      }
  }
  $data=Array(
	'form 1'=>[
		'color'=>[128,128,128],
		'value'=>round($total1)],
	
	'form 2'=>[
		'color'=>[128,128,128],
		'value'=>round($total2)]
	);
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
$pdf->SetFont('Arial','B',12);
$pdf->SetXY($chartX,$chartY);
$pdf->Cell(100,10,"Amount",0);
$pdf->SetXY(($chartWidth/2)-50+$chartX,$chartY+$chartHeight-($chartBottomPadding/2));
$pdf->Cell(100,5,"Series",0,0,'C');


$pdf->Output();
