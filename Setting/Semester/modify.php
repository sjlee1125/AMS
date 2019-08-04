<?php 
  include_once "../../dbconnect.php";
  require '../../JSON.php'; 
  header("Content-Type: application/json; charset=UTF-8"); 
  $request=file_get_contents('php://input');
  $data=json_decode(stripcslashes($request),true);
  $idx=$data['idx'];
  $SemesterName=$data['SemesterName'];
  $DateOfStart=$data['DateOfStart'];
  $DateOfEnd=$data['DateOfEnd'];
  $sql = "update semester set SemesterName='".$SemesterName."', "."DateOfStart='".$DateOfStart."', "."DateOfEnd='".$DateOfEnd."' where idx='".$idx."'";
  
    
    if ($conn->query($sql)==TRUE) {
      echo "success";
    }else{
      echo "fail";
    }
?>