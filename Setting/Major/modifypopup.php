<!DOCTYPE html>
<html>
<head>
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<?php include_once "../../dbconnect.php"; ?>
	<title>Modify Major</title>
	<style type="text/css">
		.title_content {margin-bottom: 5px;}
		.title {display: inline-block;background-color: #D6E6EC;color: #9B9FA0;width: 130px;height: 30px;text-align: center;line-height: 33px; border:1px solid #9B9FA0;margin-right: 0;float: left;}
		.content {display: inline-block;width: 130px;height: 28px;border:1px solid #9B9FA0;font-size: 90%;padding-left: 5px}
		#btn_complete {width: 130px;height: 30px;border:1px solid #9B9FA0;color: white;background-color: #4A8CF6;cursor: pointer;}
	</style>
	<?php 
		$idx=$_POST["idx"];
		
		$sql="select * from major where idx='".$idx."'";
		$result=$conn->query($sql);
		
		$text_MajorName="";
		$text_MajorCode="";
		

		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$text_MajorName= $row["MajorName"];
				$text_MajorCode=$row["MajorCode"];
			}
		}else{
			echo "0 result";
		}
	?>
	<script type="text/javascript">
		var idx_num='<?= $idx ?>';
	</script>
</head>
<body>
	<div>
	
		<div class="title_content">
			<span class="title">Major Name</span>
			<input class="content" type="text" id="MajorName">	
		</div>
		<div class="title_content">
			<span class="title">Major Code</span>
			<input class="content" type="text" id="MajorCode">	
		</div>
		<input id="btn_complete" type="button" name="complete" value="Complete" >
	
		
	</div>
</body>
<script type="text/javascript">
		$("#btn_complete").click(function(){
			var json = { idx: idx_num, MajorName: $("#MajorName").val(), MajorCode : $("#MajorCode").val()};
			console.log(json);
			var url="./modify.php";
			$.ajax({
				url: url,
    			type: 'POST',
    			data: JSON.stringify(json),
    			contentType: 'application/json; charset=utf-8',
    			dataType: 'text',
    			async :false,
    			success: function(data) {
    				if($.trim(data)=="success"){
    					opener.show_default_table(); //부모창 테이블 리로드
    					window.close();
    				}else{
    					alert("오류");
    				}
        			
    			},
    			error:function(request,status,error){
				    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
   				}
			});
		});
</script>
<script type="text/javascript">
		
		var text_MajorName= '<?= $text_MajorName ?>';
		var text_MajorCode= '<?= $text_MajorCode ?>';
		
		$("#MajorName").val(text_MajorName);
		$("#MajorCode").val(text_MajorCode);

</script>
<!-- 기본 텍스트 설정하기 -->
</html>