<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 
	 
    $Subject=$_POST['Subject'];
    $Semester=$_POST['Semester'];   

    $sql="select student.*, MajorName,CampusName, Grade from student join students_lecture on student.idx=students_lecture.Student and students_lecture.Subject=".$Subject." and students_lecture.Semester=".$Semester." join major on major.idx= student.Major join campus on campus.idx=student.Campus where student.idx in (select students_lecture.Student from students_lecture where students_lecture.Subject=".$Subject." and students_lecture.Semester=".$Semester.")";

    
  	
    $result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>