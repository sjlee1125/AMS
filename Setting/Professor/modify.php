<?php 
  include_once "../../dbconnect.php";
  require '../../JSON.php'; 
  header("Content-Type: application/json; charset=UTF-8"); 
  $request=file_get_contents('php://input');
  $data=json_decode(stripcslashes($request),true);
  $idx=$data['idx'];
  $ProfessorNumber=$data['ProfessorNumber'];
  $Name=$data['Name'];
  $Phone=$data['Phone'];
  $Email=$data['Email'];
  $Major=$data['Major'];
  $sql = "update professor set ProfessorNumber='".$ProfessorNumber."', "."Name='".$Name."', "."Phone='".$Phone."', "."Email='".$Email."', "."Major='".$Major."' where idx='".$idx."'";
  
    
    if ($conn->query($sql)==TRUE) {
      echo "success";
    }else{
      echo "fail";
    }
?>