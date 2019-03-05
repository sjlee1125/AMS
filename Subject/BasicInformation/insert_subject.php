<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	header("Content-Type: application/json; charset=UTF-8"); 
	$request=file_get_contents('php://input');
	$data=json_decode(stripcslashes($request),true);
	$Code=$data['Code'];
	$LectureNum=$data['LectureNum'];
	$Name=$data['Name'];
	$Professor=$data['Professor'];
	$Credit=$data['Credit'];
	$Classroom=$data['Classroom'];
	$Major=$data['Major'];
	$Level=$data['Level'];

	$sql = "insert into subject(Code,LectureNum,Name,Professor,Credit,Classroom,Major,Level)  values ('".$Code."','".$LectureNum."','".$Name."','".$Professor."','".$Credit."','".$Classroom."','".$Major."','".$Level."')";
  	
  	if ($conn->query($sql)==TRUE) {
  		echo "success";
  	}else{
  		echo "fail";
  	}
?>