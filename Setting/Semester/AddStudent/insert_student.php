<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 

  	$Semester=$_POST['Semester'];
	$arr=$_POST['additem'];

	$sql = "insert into semester_student(Semester,Student) values ";
  
  for ($i=0; $i < count($arr); $i++) { 
    $final_sql=$sql."('".$Semester."','".$arr[$i]."')";
    $conn->query($final_sql);
  }
	  
?>