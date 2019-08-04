<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	
  	$sql = "select major.idx,major.MajorName,major.MajorCode,count(major.idx) as count from major left join student on major.idx=student.Major group by major.idx";
  	$result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>
