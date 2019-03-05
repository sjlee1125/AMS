<?php 
  include_once "../../dbconnect.php";
  require '../../JSON.php'; 
  header("Content-Type: application/json; charset=UTF-8"); 
  $request=file_get_contents('php://input');
  $data=json_decode(stripcslashes($request),true);
  $idx=$data['idx'];
  $MajorName=$data['MajorName'];
  $MajorCode=$data['MajorCode'];

  $sql = "update major set MajorName='".$MajorName."', "."MajorCode='".$MajorCode."' where idx='".$idx."'";
  
    
    if ($conn->query($sql)==TRUE) {
      echo "success";
    }else{
      echo "fail";
    }
?>