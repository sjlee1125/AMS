<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 
	$search_string=$_POST['search_string'];

  	$sql = "select * from semester where SemesterName like '%".$search_string."%'";
  	$result=$conn->query($sql);

  	$rows=array();
  	while($r=$result->fetch_assoc()){
  		$rows[]=$r;
  	}
  	$output=json_encode($rows);
  	echo $output;
?>