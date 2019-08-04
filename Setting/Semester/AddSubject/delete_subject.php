<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 

  $Semester=$_POST['Semester'];
	$arr=$_POST['deleteitem'];

	$sql = "delete from semester_subject where Semester=".$Semester." and Subject=";
  	$final_sql="";
  for ($i=0; $i < count($arr); $i++) { 
    $final_sql=$sql.$arr[$i];
    $conn->query($final_sql);  
  }
?>