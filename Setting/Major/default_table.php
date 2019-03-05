<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	
  	$sql = "select * from major";
  	$result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>