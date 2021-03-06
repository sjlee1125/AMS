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
		
		$sql="select * from subject where idx='".$idx."'";
		$result=$conn->query($sql);
		
		$text_Code="";
		$text_LectureNum="";
		$Name="";
		$text_Professor="";
		$text_Credit="";
		$text_Classroom="";
		$text_Major="";
		$text_Level="";

		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$text_Code=$row["Code"];
				$text_LectureNum=$row["LectureNum"];
				$text_Name=$row["Name"];
				$text_Professor=$row["Professor"];
				$text_Credit=$row["Credit"];
				$text_Classroom=$row["Classroom"];
				$text_Major=$row["Major"];
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
			<span class="title">Code</span>
			<input class="content" type="text" id="Code">	
		</div>
		<div class="title_content">
			<span class="title">Lecture Number</span>
			<input class="content" type="text" id="LectureNum">	
		</div>
		<div class="title_content">
			<span class="title">Name</span>
			<input class="content" type="text" id="Name">	
		</div>
		<div class="title_content">
			<span class="title">Professor</span>
			<select name="professor" class="select_option" id="professor_select">
				<?php 
					$sql="select * from professor";
					$result=$conn->query($sql);

					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
							if ($text_Professor==$row["idx"]) {
								echo "<option value='".$row["idx"]."' selected='selected'>".$row["Name"]."</option>";
							}else
								echo "<option value='".$row["idx"]."'>".$row["Name"]."</option>";
						}
					}else{//전공없는것 예외처리
						echo '<script>
								alert("There are no Professor");
								window.close();
							</script>';
					}
				 ?>
			</select>	
		</div>
		<div class="title_content">
			<span class="title">Credit</span>
			<input class="content" type="text" id="Credit">	
		</div>
		<div class="title_content">
			<span class="title">Classroom</span>
			<input class="content" type="text" id="Classroom">	
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
			var json = { idx : idx_num, Code: $("#Code").val(), LectureNum : $("#LectureNum").val() , Name : $("#Name").val(),Professor : $("#professor_select option:selected").val(), Credit : $("#Credit").val(), Classroom : $("#Classroom").val(), Major : $("#major_select option:selected").val(), Level : $("#level_select option:selected").val()};
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
		
		var text_Code= '<?= $text_Code ?>';
		var text_LectureNum= '<?= $text_LectureNum ?>';
		var text_Name= '<?= $text_Name ?>';
		var text_Professor= '<?= $text_Professor ?>';
		var text_Credit= '<?= $text_Credit ?>';
		var text_Classroom= '<?= $text_Classroom ?>';
		var text_Major= '<?= $text_Major ?>';
		var text_Level= '<?= $text_Level ?>';
		
		
		
		$("#Code").val(text_Code);
		$("#LectureNum").val(text_LectureNum);
		$("#Name").val(text_Name);
		$("#Professor").val(text_Professor);
		$("#Credit").val(text_Credit);
		$("#Classroom").val(text_Classroom);
		//$("#Major").val(text_Major); 앞에서 이미 php로 설정
		$("#level_select").val(text_Level).attr("selected","selected");//따로 설정해주어야함

</script>
<!-- 기본 텍스트 설정하기 -->
</html>