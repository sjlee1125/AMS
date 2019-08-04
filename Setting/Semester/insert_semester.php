<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	header("Content-Type: application/json; charset=UTF-8"); 
	$request=file_get_contents('php://input');
	$data=json_decode(stripcslashes($request),true);
	$SemesterName=$data['SemesterName'];
	$DateOfStart=$data['DateOfStart'];
	$DateOfEnd=$data['DateOfEnd'];

	$sql = "insert into semester(SemesterName,DateOfStart,DateOfEnd)  values ('".$SemesterName."','".$DateOfStart."','".$DateOfEnd."')";
  	
  	if ($conn->query($sql)==TRUE) {
  		echo "success";
  	}else{
  		echo "fail";
  	}
?>