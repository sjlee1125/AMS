<?php 
  include_once "../../dbconnect.php";
  require '../../JSON.php'; 
  header("Content-Type: application/json; charset=UTF-8"); 
  $request=file_get_contents('php://input');
  $data=json_decode(stripcslashes($request),true);
  $idx=$data['idx'];
  $Code=$data['Code'];
  $LectureNum=$data['LectureNum'];
  $Name=$data['Name'];
  $Professor=$data['Professor'];
  $Credit=$data['Credit'];
  $Classroom=$data['Classroom'];
  $Major=$data['Major'];
  $Level=$data['Level'];
  $sql = "update subject set Code='".$Code."', "."LectureNum='".$LectureNum."', "."Name='".$Name."', "."Professor='".$Professor."', "."Credit='".$Credit."', "."Classroom='".$Classroom."', "."Major='".$Major."', "."Level='".$Level."' where idx='".$idx."'";
  
    
    if ($conn->query($sql)==TRUE) {
      echo "success";
    }else{
      echo "fail";
    }
?>