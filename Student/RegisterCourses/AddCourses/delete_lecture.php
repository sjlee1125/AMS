<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 

  $Student=$_POST['Student'];
  $Semester=$_POST['Semester'];
	$arr=$_POST['deleteitem'];

	$sql = "delete from students_lecture where Student=".$Student." and Semester=".$Semester." and Subject=";
  	$final_sql="";
  for ($i=0; $i < count($arr); $i++) { 
    $final_sql=$sql.$arr[$i];
    $conn->query($final_sql);  
  }
?>