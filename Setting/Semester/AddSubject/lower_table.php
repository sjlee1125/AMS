<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 
	 
    $Semester=$_POST['Semester'];   
  	$sql = "select subject.*, MajorName, professor.Name as PName from subject join major on subject.Major =major.idx join professor on subject.professor =professor.idx join semester_subject on subject.idx=semester_subject.Subject and semester_subject.Semester=".$Semester ;
  	$result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>