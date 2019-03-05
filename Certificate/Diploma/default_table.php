<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	
  	$sql = "select student.*, MajorName, CampusName from student join major on student.Major =major.idx join campus on student.Campus =campus.idx where student.State = 'Graduation'";
  	$result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>