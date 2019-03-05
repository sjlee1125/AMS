<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	header("Content-Type: application/json; charset=UTF-8"); 
	$request=file_get_contents('php://input');
	$data=json_decode(stripcslashes($request),true);
	$ProfessorNumber=$data['ProfessorNumber'];
	$Name=$data['Name'];
	$Phone=$data['Phone'];
	$Email=$data['Email'];
	$Major=$data['Major'];

	$sql = "insert into professor(ProfessorNumber,Name,Phone,Email,Major)  values ('".$ProfessorNumber."','".$Name."','".$Phone."','".$Email."','".$Major."')";
  	
  	if ($conn->query($sql)==TRUE) {
  		echo "success";
  	}else{
  		echo "fail";
  	}
?>