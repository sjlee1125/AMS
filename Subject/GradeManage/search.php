<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	
    $search_string=$_POST['search_string'];
    $Semester=$_POST['Semester'];

  	$sql = "select subject.*, MajorName, professor.Name as PName from subject join major on subject.Major =major.idx join professor on subject.professor =professor.idx where subject.idx in (select semester_subject.Subject from semester_subject where subject.Name like '%".$search_string."%' and semester_subject.Semester = ".$Semester.")";
  	$result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>