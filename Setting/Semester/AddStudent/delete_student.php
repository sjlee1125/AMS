<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 

  $Semester=$_POST['Semester'];
	$arr=$_POST['deleteitem'];

	$sql = "delete from semester_student where Semester=".$Semester." and Student=";
  	$final_sql="";
  for ($i=0; $i < count($arr); $i++) { 
    $final_sql=$sql.$arr[$i];
    $conn->query($final_sql);  
  }
?>