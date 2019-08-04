<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	header("Content-Type: application/json; charset=UTF-8"); 
	$request=file_get_contents('php://input');
	$data=json_decode(stripcslashes($request),true);
	$CampusName=$data['CampusName'];
	$CampusCode=$data['CampusCode'];
	

	$sql = "insert into campus(CampusName,CampusCode)  values ('".$CampusName."','".$CampusCode."')";
  	
  	if ($conn->query($sql)==TRUE) {
  		echo "success";
  	}else{
  		echo "fail";
  	}
?>