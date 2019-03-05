<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 

    $Student=$_POST['Student'];
    $search_string=$_POST['search_string'];
    $Semester=$_POST['Semester'];   

  	$sql="select subject.*, MajorName, professor.Name as PName from subject 
    join major on subject.Major =major.idx 
    join professor on subject.Professor =professor.idx 
    WHERE subject.Name like '%".$search_string."%' and subject.idx in (select semester_subject.Subject from semester_subject where semester_subject.Semester=".$Semester.") 
    and subject.idx not in (select students_lecture.Subject from students_lecture where students_lecture.Student=".$Student." and students_lecture.Semester=".$Semester.")";

  	$result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>