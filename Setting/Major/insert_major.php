<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	header("Content-Type: application/json; charset=UTF-8"); 
	$request=file_get_contents('php://input');
	$data=json_decode(stripcslashes($request),true);
	$MajorName=$data['MajorName'];
	$MajorCode=$data['MajorCode'];
	

	$sql = "insert into major(MajorName,MajorCode)  values ('".$MajorName."','".$MajorCode."')";
  	
  	if ($conn->query($sql)==TRUE) {
  		echo "success";
  	}else{
  		echo "fail";
  	}
?>