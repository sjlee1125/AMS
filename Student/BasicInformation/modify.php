<?php 
  include_once "../../dbconnect.php";
  require '../../JSON.php'; 
  header("Content-Type: application/json; charset=UTF-8"); 
  $request=file_get_contents('php://input');
  $data=json_decode(stripcslashes($request),true);
  $idx=$data['idx'];
  $StudentNumber=$data['StudentNumber'];
  $FirstName=$data['FirstName'];
  $LastName=$data['LastName'];
  $Birth=$data['Birth'];
  $Phone=$data['Phone'];
  $Email=$data['Email'];
  $Address=$data['Address'];
  $Major=$data['Major'];
  $State=$data['State'];
  $Campus=$data['Campus'];
  $Level=$data['Level'];
  $sql = "update student set StudentNumber='".$StudentNumber."', "."FirstName='".$FirstName."', "."LastName='".$LastName."', "."Birth='".$Birth."', "."Phone='".$Phone."', "."Email='".$Email."', "."Address='".$Address."', "."Major='".$Major."', "."State='".$State."', "."Campus='".$Campus."', "."Level='".$Level."' where idx='".$idx."'";
  
    
    if ($conn->query($sql)==TRUE) {
      echo "success";
    }else{
      echo "fail";
    }
?>