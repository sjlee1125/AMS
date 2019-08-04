<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	
  	$sql = "select campus.idx,campus.CampusName,campus.CampusCode,count(campus.idx) as count from campus inner join student on campus.idx=student.Campus group by campus.idx";
  	$result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>
