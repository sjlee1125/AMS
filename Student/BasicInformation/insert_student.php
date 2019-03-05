<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	header("Content-Type: application/json; charset=UTF-8"); 
	$request=file_get_contents('php://input');
	$data=json_decode(stripcslashes($request),true);
	$StudentNumber=$data['StudentNumber'];
	$FirstName=$data['FirstName'];
	$LastName=$data['LastName'];
	$Birth=$data['Birth'];
	$Phone=$data['Phone'];
	$Email=$data['Email'];
	$Address=$data['Address'];
	$Major=$data['Major'];
	$Campus=$data['Campus'];
	$Level=$data['Level'];

	$sql = "insert into student(StudentNumber,FirstName,LastName,Birth,Phone,Email,Address,Major,State,Campus,Level)  values ('".$StudentNumber."','".$FirstName."','".$LastName."','".$Birth."','".$Phone."','".$Email."','".$Address."','".$Major."','"."InSchool"."','".$Campus."','".$Level."')";
  	
  	if ($conn->query($sql)==TRUE) {
  		echo "success";
  	}else{
  		echo "fail";
  	}
?>