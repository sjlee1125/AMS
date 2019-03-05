<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 
	 
    $Student=$_POST['Student'];
    $Semester=$_POST['Semester']; 

  	$sql = "select subject.*, MajorName, professor.Name as PName from subject join major on subject.Major =major.idx join professor on subject.professor =professor.idx join students_lecture on subject.idx=students_lecture.Subject and students_lecture.Semester=".$Semester." and students_lecture.Student=".$Student;
  	$result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>