<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 
	 
    $Semester=$_POST['Semester'];   
  	$sql = "select student.*, MajorName, CampusName from student join major on student.Major =major.idx join campus on student.Campus =campus.idx where student.idx not in (select semester_student.Student from semester_student where semester_student.Semester=".$Semester.")";
  	$result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>