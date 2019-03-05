<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 

	$Student=$_POST['Student'];
  	$Semester=$_POST['Semester'];
	$arr=$_POST['additem'];

	$sql = "insert into students_lecture (Student,Semester,Subject,Grade) values ";
  
  for ($i=0; $i < count($arr); $i++) { 
    $final_sql=$sql."('".$Student."','".$Semester."','".$arr[$i]."','"."null"."')";
    $conn->query($final_sql);
  }
	  
?>