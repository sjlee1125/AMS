<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 

	$Student=$_POST['Student'];
	$Subject=$_POST['Subject'];
  	$Semester=$_POST['Semester'];
  	$Grade=$_POST['Grade'];

	$sql = "update students_lecture set Grade='".$Grade."' where Student=".$Student." and Subject=".$Subject." and Semester=".$Semester;
  
    $conn->query($sql);
	  
?>