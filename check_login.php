<?php
	$id=$_POST['id'];
	$pw=$_POST['pw'];

	$origin_id="administrator";
	$origin_pw="administrator";

	if($id==$origin_id&&$pw==$origin_pw){
		header("Location: ./navigation.php");
	}
	else{
		echo "<script> alert('로그인 실패')
			history.back(1);
			</script>";
	}
?>