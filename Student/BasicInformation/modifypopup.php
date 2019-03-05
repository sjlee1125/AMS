<!DOCTYPE html>
<html>
<head>
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<?php include_once "../../dbconnect.php"; ?>
	<title>Modify Semester</title>
	<style type="text/css">
		.title_content {margin-bottom: 5px;}
		.title {display: inline-block;background-color: #D6E6EC;color: #9B9FA0;width: 130px;height: 30px;text-align: center;line-height: 33px; border:1px solid #9B9FA0;margin-right: 0;float: left;}
		.content {display: inline-block;width: 130px;height: 28px;border:1px solid #9B9FA0;font-size: 90%;padding-left: 5px}
		#btn_complete {width: 130px;height: 30px;border:1px solid #9B9FA0;color: white;background-color: #4A8CF6;cursor: pointer;}
		.select_option {font-size: 90%;width: 139px;height: 32px;}
	</style>
	<?php 
		$idx=$_POST["idx"];
		
		$sql="select * from student where idx='".$idx."'";
		$result=$conn->query($sql);
		
		$text_StudentNumber="";
		$text_FirstName="";
		$text_LastName="";
		$text_Birth="";
		$text_Phone="";
		$text_Email="";
		$text_Address="";
		$text_Major="";
		$text_State="";
		$text_Campus="";
		$text_Level="";

		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$text_StudentNumber=$row["StudentNumber"];
				$text_FirstName=$row["FirstName"];
				$text_LastName=$row["LastName"];
				$text_Birth=$row["Birth"];
				$text_Phone=$row["Phone"];
				$text_Email=$row["Email"];
				$text_Address=$row["Address"];
				$text_Major=$row["Major"];
				$text_State=$row["State"];
				$text_Campus=$row["Campus"];
				$text_Level=$row["Level"];
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
			<span class="title">Student Number</span>
			<input class="content" type="text" id="StudentNumber">	
		</div>
		<div class="title_content">
			<span class="title">First Name</span>
			<input class="content" type="text" id="FirstName">	
		</div>
		<div class="title_content">
			<span class="title">Last Name</span>
			<input class="content" type="text" id="LastName">	
		</div>
		<div class="title_content">
			<span class="title">Birth</span>
			<input class="content" type="text" id="Birth">	
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
			<span class="title">Address</span>
			<input class="content" type="text" id="Address">	
		</div>
		<div class="title_content">
			<span class="title">Major</span>
			<select name="major" class="select_option" id="major_select">
				<?php 
					$sql="select * from major";
					$result=$conn->query($sql);

					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
							if ($text_Major==$row["idx"]) {
								echo "<option value='".$row["idx"]."' selected='selected'>".$row["MajorName"]."</option>";
							}else
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
		<div class="title_content">
			<span class="title">State</span>
			<select name="campus" class="select_option" id="state_select">
				<option value="InSchool">In School</option>
				<option value="LeaveOfAbsence">Leave Of Absence</option>
				<option value="Graduation">Graduation</option>
			</select>
		</div>
		<div class="title_content">
			<span class="title">Campus</span>
			<select name="campus" class="select_option" id="campus_select">
				<?php 
					$sql="select * from campus";
					$result=$conn->query($sql);

					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
							if ($text_Campus==$row["idx"]) {
								echo "<option value='".$row["idx"]."' selected='selected'>".$row["CampusName"]."</option>";
							}else
								echo "<option value='".$row["idx"]."'>".$row["CampusName"]."</option>";
							
						}
					}else{//전공없는것 예외처리
						echo '<script>
								alert("There are no Campus");
								window.close();
							</script>';
					}
				 ?>
			</select>
		</div>
		<div class="title_content">
			<span class="title">Level</span>
			<select name="campus" class="select_option" id="level_select">
				<option value="Bachelor">Bachelor</option>
				<option value="Master">Master</option>
				<option value="Doctor">Doctor</option>
			</select>
		</div>
		<input id="btn_complete" type="button" name="complete" value="Complete" >
	
	</div>
</body>
<script type="text/javascript">
		$("#btn_complete").click(function(){
			var json = { idx : idx_num, StudentNumber: $("#StudentNumber").val(), FirstName : $("#FirstName").val() , LastName : $("#LastName").val(), Birth : $("#Birth").val(), Phone : $("#Phone").val(), Email : $("#Email").val(), Address : $("#Address").val(), Major : $("#major_select option:selected").val(), State : $("#state_select option:selected").val(), Campus : $("#campus_select option:selected").val(), Level : $("#level_select option:selected").val()};
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
		
		var text_StudentNumber= '<?= $text_StudentNumber ?>';
		var text_FirstName= '<?= $text_FirstName ?>';
		var text_LastName= '<?= $text_LastName ?>';
		var text_Birth= '<?= $text_Birth ?>';
		var text_Phone= '<?= $text_Phone ?>';
		var text_Email= '<?= $text_Email ?>';
		var text_Address= '<?= $text_Address ?>';
		var text_Major= '<?= $text_Major ?>';
		var text_State= '<?= $text_State ?>';
		var text_Campus= '<?= $text_Campus ?>';
		var text_Level= '<?= $text_Level ?>';
		
		
		
		$("#StudentNumber").val(text_StudentNumber);
		$("#FirstName").val(text_FirstName);
		$("#LastName").val(text_LastName);
		$("#Birth").val(text_Birth);
		$("#Phone").val(text_Phone);
		$("#Email").val(text_Email);
		$("#Address").val(text_Address);
		//$("#Major").val(text_Major); 앞에서 이미 php로 설정
		$("#state_select").val(text_State).attr("selected","selected"); //따로 설정해주어야함
		//$("#Campus").val(text_Campus); 앞에서 이미 php로 설정
		$("#level_select").val(text_Level).attr("selected","selected");

</script>
<!-- 기본 텍스트 설정하기 -->
</html>