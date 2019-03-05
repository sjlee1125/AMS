<!DOCTYPE html>
<html>
<head>
	<title id="Semester">Add Subject Popup</title>
	<?php include "../../../dbconnect.php" ?> <!-- Major를 불러오기위해서 php통신 필요 -->
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<style type="text/css">
		body {margin: 0;padding: 0;}
		#main_body {margin-left: 20px;margin-top: 15px;margin-right: 20px;margin-bottom: 100px;}
		.title_content {margin-bottom: 20px;}
		.title {display: inline-block;background-color: #D6E6EC;color: #9B9FA0;width: 120px;height: 30px;text-align: center;line-height: 33px; border:1px solid #9B9FA0;margin-right: 0;float: left;}
		.content1 {display: inline-block;width: 110px;height: 30px;border:1px solid #9B9FA0;font-size: 90%;padding-left: 5px;text-align: center;line-height: 33px;float: left;}
		.content2 {display: inline-block;width: 120px;height: 28px;border:1px solid #9B9FA0;font-size: 90%;padding-left: 5px;float: left;}
		.btn_search{display: inline-block;background-color: #4A8CF6;color: white;width: 130px;height: 30px;text-align: center;line-height: 33px; border:1px solid #9B9FA0;margin-right: 0;cursor: pointer;font-weight:bold;float: left;}
		#major_select {font-size: 90%;width: 130px;height: 32px;float: left;}
		.wrapper {width:100%;height: 450px;background-color:#F7F7F7;border: 1px solid #95989A;overflow-y: scroll;overflow-x:scroll; }
		.inner_table {white-space:nowrap;color:#95989A;text-align: center;background-color:#F7F7F7;border-collapse: collapse;table-layout: fixed;}
		.inner_table thead{position: relative;top: expression(this.offsetParent.scrollTop);z-index: 20;}
		<!--thead 고정-->
		.inner_table tbody tr:first-child td{background-color:yellow ;padding-top: 32px;}
		th{padding: 6px 5px 6px 5px;border: 1px solid #95989A}
		tbody tr:hover {
	  		background-color: lightblue;
		}

		.btn_process {background-color: #4A8CF6;color: white;width: 130px;height: 30px;text-align: center;line-height: 33px; border:1px solid #9B9FA0;margin-right: 0;cursor: pointer;font-weight:bold;float: right;margin-top: 10px}
	</style>
</head>

<body>
	<div id="main_body">
		<div class="title_content" style="overflow: hidden;">
			<span class="title">Subject Name</span>
			<span class="content1">
				<?php  
					$Subject_idx=$_POST["Subject"];
		
					$sql="select subject.*, MajorName from subject join major on subject.Major =major.idx where subject.idx='".$Subject_idx."'";
					$result=$conn->query($sql);
					
					$Name="";
					$MajorName="";
					$Level="";
					$LectureNum="";

					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
							$Name=$row["Name"];
							$MajorName=$row["MajorName"];
							$Level=$row["Level"];
							$LectureNum=$row["LectureNum"];
						}
					}else{
						echo "0 result";
					}
					echo $Name;
				?>
			</span>
			<span class="title">LectureNum</span>
			<span class="content1">
				
				<?php  
					$Semester_idx=$_POST["Semester"];
		
					$sql="select * from semester where idx='".$Semester_idx."'";
					$result=$conn->query($sql);
					
					$SemesterName="";
					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
							$SemesterName= $row["SemesterName"];
						}
					}else{
						echo "0 result";
					}

				?>
				<?php echo $LectureNum ?>
			</span>
			<span class="title">Major</span>
			<span class="content1">
				<?php  
					echo $MajorName;
				?>
				<script type="text/javascript">
					var Subject_idx='<?= $Subject_idx ?>';
					var Semester_idx='<?= $Semester_idx ?>';
					var SemesterName='<?= $SemesterName ?>';
					$("#Semester").html(SemesterName);
				</script>
			</span>
			<span class="title">Level</span>
			<span class="content1">
				<?php  
					echo $Level;
				?>
			</span>
		</div>
		<div class="second_part">
			<div id="Code_part" style="float: left;">
				<span class="title">Student Name</span>
				<input class="content2" type="text" id="CodeName">
				<span class="btn_search" id="btn_search_name" onclick="show_search_name_table()">Search</span>
			</div>
		</div>
		<div style="margin-top:60px;">
			<span>Student List</span>
		</div>
		<div class="wrapper">
			<table frame="below" class="inner_table">
				<thead>
					<tr>
						<th hidden>
						<th>StudentNumber</th>
						<th>FirstName</th>
						<th>LastName</th>
						<th>Birth</th>
						<th>Major</th>
						<th>State</th>
						<th>Campus</th>
						<th>Level</th>
						<th></th>
						<td></td>
					</tr>
				</thead>
				<tbody id="upper_table_contents">
					
				</tbody>
			</table>
		</div>
		<div>
			<span class="btn_process" id="btn_apply" onclick="additem()">Apply</span>
		</div>
	</div>
	
</body>
<script type="text/javascript">
	$("th:first-child").width("5%");
	//체크박스 사이즈조절

	function additem(){
		var arr = $('#upper_table_contents input[name=select]:checked').serializeArray().map(function(item) { return item.value });
		console.log(arr);

		if(arr.length!=0){
			var datastring={ Student : Student_idx, Semester:Semester_idx,additem : arr};
			
			$.ajax({
					type:"POST",
					//dataType:"json",
					data : datastring,
					url:"./insert_lecture.php",
					success: function(data){
						console.log(data);
						show_upper_table();//위치가 복잡 -> success하는 부분말고 함수가 끝나는 부분에 놓으면 한번삭제가 되고 바로 재로딩이 안된다. ajax가 두번 도는 거기때문에 순서를 맞추어주어야한다.
					}
			});
			
		}	
	}

	

	function show_search_name_table(){

		$.ajax({
				type:"POST",
				dataType:"json",
				data : { Subject : Subject_idx, Semester : Semester_idx, search_string: $("#CodeName").val()},
				url:"./search_name.php",
				success: function(data){
					console.log(data);
					var text="";
					for(var i=0;i<data.length;i++){
						
						text_Grade="";

						if (data[i].Grade=="null") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null' selected='selected' >Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="A") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A' selected='selected' >A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="A-") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-' selected='selected'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="B+") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+' selected='selected'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="B") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B' selected='selected'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="B-") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-' selected='selected'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="C+") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+' selected='selected'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="C") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C' selected='selected'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="C-") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-' selected='selected'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="D") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D' selected='selected'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="F") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F' selected='selected'>F</option></select>";
						}
						
						text+="<tr><th hidden><input type='checkbox' name='select' value='"+data[i].idx+"'></th>"+"<th>"+data[i].StudentNumber+"</th><th>"+data[i].FirstName+"</th><th>"+data[i].LastName+"</th><th>"+data[i].Birth+"</th><th>"+data[i].MajorName+"</th><th>"+data[i].State+"</th><th>"+data[i].CampusName+"</th><th>"+data[i].Level+"</th>"+"<th>"+text_Grade+"</th>"+"<td></td>";
					}
					$("#upper_table_contents").html(text);
				}
			});
	}
	function Grade_Change(evt){

		var Student_idx=evt.target.id;
		var Grade_idx=evt.target.value;

		$.ajax({
				type:"POST",
				//dataType:"json",
				data : { Student: Student_idx,Subject : Subject_idx, Semester : Semester_idx, Grade:Grade_idx},
				url:"./update_grade.php",
				success: function(data){
					
				}
			});

	};
	

	function show_upper_table(){
		console.log("uptown");
		$.ajax({
				type:"POST",
				dataType:"json",
				data : {Subject : Subject_idx, Semester : Semester_idx},
				url:"./upper_table.php",
				success: function(data){
					console.log(data);
					var text="";
					for(var i=0;i<data.length;i++){
						
						text_Grade="";

						if (data[i].Grade=="null") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null' selected='selected' >Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="A") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A' selected='selected' >A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="A-") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-' selected='selected'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="B+") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+' selected='selected'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="B") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B' selected='selected'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="B-") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-' selected='selected'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="C+") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+' selected='selected'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="C") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C' selected='selected'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="C-") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-' selected='selected'>C-</option><option value='D'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="D") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D' selected='selected'>D</option><option value='F'>F</option></select>";
						}else if (data[i].Grade=="F") {
							text_Grade="<select id='"+data[i].idx+"' onchange='Grade_Change(event)'><option value='null'>Null</option><option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option><option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option><option value='C'>C</option><option value='C-'>C-</option><option value='D'>D</option><option value='F' selected='selected'>F</option></select>";
						}
						
						text+="<tr><th hidden><input type='checkbox' name='select' value='"+data[i].idx+"'></th>"+"<th>"+data[i].StudentNumber+"</th><th>"+data[i].FirstName+"</th><th>"+data[i].LastName+"</th><th>"+data[i].Birth+"</th><th>"+data[i].MajorName+"</th><th>"+data[i].State+"</th><th>"+data[i].CampusName+"</th><th>"+data[i].Level+"</th>"+"<th>"+text_Grade+"</th>"+"<td></td>";
					}
					$("#upper_table_contents").html(text);
				}
			});
	}

	
	show_upper_table();
</script>
</html>