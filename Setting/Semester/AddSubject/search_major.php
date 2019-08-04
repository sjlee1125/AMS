<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 

    $Major=$_POST['Major'];
    $Semester=$_POST['Semester'];
    
    $sql="";
    if ($Major=="All") {
      $sql="select subject.*, MajorName, professor.Name as PName from subject join major on subject.Major =major.idx join professor on subject.professor =professor.idx where subject.idx not in (select semester_subject.Subject from semester_subject where semester_subject.Semester=".$Semester.")";
    }else{
      $sql="select subject.*, MajorName, professor.Name as PName from subject join major on subject.Major =major.idx join professor on subject.professor =professor.idx where major.idx=".$Major." and subject.idx not in (select semester_subject.Subject from semester_subject where semester_subject.Semester=".$Semester.")";
    }   
  	$result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>