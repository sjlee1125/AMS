<?php 
	include_once "../../dbconnect.php";
	require '../../JSON.php'; 

	$arr=$_POST['deleteitem'];

	$sql = "delete from student where idx=";
  
  for ($i=0; $i < count($arr); $i++) { 
    $sql.="'".$arr[$i]."'";
    if ($i<count($arr)-1) {
      $sql.=" or idx=";
    }
  }

  $conn->query($sql);

	  
?>