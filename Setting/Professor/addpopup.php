<!DOCTYPE html>
<html>
<head>
	<?php include "../../dbconnect.php" ?> <!-- Major를 불러오기위해서 php통신 필요 -->
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<title>Add Semester</title>
	<style type="text/css">
		.title_content {margin-bottom: 5px;}
		.title {display: inline-block;background-color: #D6E6EC;color: #9B9FA0;width: 130px;height: 30px;text-align: center;line-height: 33px; border:1px solid #9B9FA0;margin-right: 0;float: left;}
		.content {display: inline-block;width: 130px;height: 28px;border:1px solid #9B9FA0;font-size: 90%;padding-left: 5px}
		#btn_complete {width: 130px;height: 30px;border:1px solid #9B9FA0;color: white;background-color: #4A8CF6;cursor: pointer;}
		#major_select {font-size: 90%;width: 139px;height: 32px;}
	</style>
	
</head>
<body>
	<div>
	
		<div class="title_content">
			<span class="title">ProfessorNum</span>
			<input class="content" type="text" id="ProfessorNumber">	
		</div>
		<div class="title_content">
			<span class="title">Name</span>
			<input class="content" type="text" id="Name">	
		</div>
		<div class="title_content">
			<span class="title">Phone</span>
			<input class="content" type="text" id="Phone">	
		</div>
		<div class="title_content">
			<span class="title">E-mail</span>
			<input class="content" type="text" id="Email">	
		</div>
		<div class="title_content">
			<span class="title">Major</span>
			<select name="major" id="major_select">
				<?php 
					$sql="select * from major";
					$result=$conn->query($sql);

					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
							echo "<option value='".$row["idx"]."'>".$row["MajorName"]."</option>";
							}
					}else{//전공없는것 예외처리
						echo '<script>
								alert("There are no Major");
								window.close();
							</script>';
					}
				 ?>
			</select>
		</div>
		<input id="btn_complete" type="button" name="complete" value="Complete" >
	
	</div>
</body>
<script type="text/javascript">
		$("#btn_complete").click(function(){
			var json = { ProfessorNumber: $("#ProfessorNumber").val(), Name : $("#Name").val() , Phone : $("#Phone").val(), Email : $("#Email").val(), Major : $("#major_select option:selected").val()};
			console.log(json);
			var url="./insert_professor.php";
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
</html>