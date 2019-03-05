<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	
  	$sql = "select subject.*, MajorName, professor.Name as PName from subject join major on subject.Major =major.idx join professor on subject.professor =professor.idx";
  	$result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>