<?php 
	include_once "../../../dbconnect.php";
	require '../../../JSON.php'; 
	 
    $Student=$_POST['Student'];
    $Semester=$_POST['Semester'];   

    $sql="select subject.*, MajorName, professor.Name as PName from subject 
    join major on subject.Major =major.idx 
    join professor on subject.Professor =professor.idx 
    WHERE subject.idx in (select semester_subject.Subject from semester_subject where semester_subject.Semester=".$Semester.") 
    and subject.idx not in (select students_lecture.Subject from students_lecture where students_lecture.Student=".$Student." and students_lecture.Semester=".$Semester.")";

    // $sql="select subject.*, MajorName, professor.Name as PName from (select * from subject,semester_subject where subject.idx=semester_subject.Subject) as subject join major on subject.Major =major.idx join professor on subject.Professor =professor.idx where subject.idx not in (select students_lecture.Subject from students_lecture where students_lecture.Student=".$Student." and students_lecture.Semester=".$Semester.")" 

    //$sql="select subject.* from subject join major on subject.Major=major.idx join semester_subject on subject.idx =semester_subject.subject";

     //$sql = "select subject.*, MajorName, professor.Name as PName from subject,semester_subject,students_lecture join major on subject.Major =major.idx join professor on subject.Professor =professor.idx where subject.idx=semester_subject.Subject and subject.idx not in (select students_lecture.Subject from students_lecture where students_lecture.Student=".$Student." and students_lecture.Semester=".$Semester.")";

  	// $sql = "select subject.*, MajorName, professor.Name as PName from subject join major on subject.Major =major.idx join professor on subject.professor =professor.idx where subject.idx not in (select students_lecture.Subject from students_lecture where students_lecture.Student=".$Student." and students_lecture.Semester=".$Semester.")";
  	
    $result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>