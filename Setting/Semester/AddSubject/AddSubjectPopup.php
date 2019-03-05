<!DOCTYPE html>
<html>
<head>
	<title>Add Subject Popup</title>
	<?php include "../../../dbconnect.php" ?> <!-- Major를 불러오기위해서 php통신 필요 -->
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<style type="text/css">
		body {margin: 0;padding: 0;}
		#main_body {margin-left: 20px;margin-top: 15px;margin-right: 20px;margin-bottom: 100px;}
		.title_content {margin-bottom: 20px;}
		.title {display: inline-block;background-color: #D6E6EC;color: #9B9FA0;width: 130px;height: 30px;text-align: center;line-height: 33px; border:1px solid #9B9FA0;margin-right: 0;float: left;}
		.content1 {display: inline-block;width: 130px;height: 30px;border:1px solid #9B9FA0;font-size: 90%;padding-left: 5px;text-align: center;line-height: 33px;}
		.content2 {display: inline-block;width: 130px;height: 28px;border:1px solid #9B9FA0;font-size: 90%;padding-left: 5px;float: left;}
		.btn_search{display: inline-block;background-color: #4A8CF6;color: white;width: 130px;height: 30px;text-align: center;line-height: 33px; border:1px solid #9B9FA0;margin-right: 0;cursor: pointer;font-weight:bold;float: left;}
		#major_select {font-size: 90%;width: 130px;height: 32px;float: left;}
		.wrapper {width:100%;height: 300px;background-color:#F7F7F7;border: 1px solid #95989A;overflow-y: scroll;overflow-x:scroll; }
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
		<div class="title_content">
			<span class="title">Semester</span>
			<span class="content1" id="Semester">
				<?php  
					$idx=$_POST["idx"];
		
					$sql="select * from semester where idx='".$idx."'";
					$result=$conn->query($sql);
					

					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
							echo $row["SemesterName"];
						}
					}else{
						echo "0 result";
					}
				?>
				<script type="text/javascript">
					var idx_num='<?= $idx ?>';
				</script>
			</span>
		</div>
		<div class="second_part">
			<div id="Code_part">
				<span class="title">Subject Name</span>
				<input class="content2" type="text" id="CodeName">
				<span class="btn_search" id="btn_search_name" onclick="show_search_name_table()">Search</span>
			</div>
			<div id="Major_part" style="float: right;">
				<span class="title" style="float: left;">Major</span>
				<select name="major" id="major_select">
					<option value="All">All</option>
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
				<span class="btn_search" id="btn_search_major" onclick="show_search_major_table()">Search</span>
			</div>
		</div>
		<div style="margin-top:60px;">
			<span>Subject List</span>
		</div>
		<div class="wrapper">
			<table frame="below" class="inner_table">
				<thead>
					<tr>
						<th></th>
						<th>Code</th>
						<th>Lecture Number</th>
						<th>Name</th>
						<th>Professor</th>
						<th>Credit</th>
						<th>Classroom</th>
						<th>Major</th>
						<th>Level</th>
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
		<div style="margin-top:60px;">
			<span>Registered Subject List</span>
		</div>
		<div class="wrapper">
			<table frame="below" class="inner_table">
				<thead>
					<tr>
						<th></th>
						<th>Code</th>
						<th>Lecture Number</th>
						<th>Name</th>
						<th>Professor</th>
						<th>Credit</th>
						<th>Classroom</th>
						<th>Major</th>
						<th>Level</th>
						<td></td>
					</tr>
				</thead>
				<tbody id="lower_table_contents">
					
				</tbody>
			</table>
		</div>
		<div>
			<span class="btn_process" id="btn_delete" onclick="deleteitem()">Delete</span>
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
			var datastring={ Semester:idx_num,additem : arr};
			
			$.ajax({
					type:"POST",
					//dataType:"json",
					data : datastring,
					url:"./insert_subject.php",
					success: function(data){
						console.log(data);
						show_upper_table();
						show_lower_table(); //위치가 복잡 -> success하는 부분말고 함수가 끝나는 부분에 놓으면 한번삭제가 되고 바로 재로딩이 안된다. ajax가 두번 도는 거기때문에 순서를 맞추어주어야한다.
					}
			});
			
		}	
	}

	function deleteitem(){
		var arr = $('#lower_table_contents input[name=select]:checked').serializeArray().map(function(item) { return item.value });
		console.log(arr);

		if(arr.length!=0){
			var datastring={ Semester:idx_num, deleteitem : arr};
			
			$.ajax({
					type:"POST",
					//dataType:"json",
					data : datastring,
					url:"./delete_subject.php",
					success: function(data){
						console.log(data);
						show_upper_table();
						show_lower_table(); //위치가 복잡 -> success하는 부분말고 함수가 끝나는 부분에 놓으면 한번삭제가 되고 바로 재로딩이 안된다. ajax가 두번 도는 거기때문에 순서를 맞추어주어야한다.
					}
			});
			
		}	
	}

	function show_search_name_table(){

		$.ajax({
				type:"POST",
				dataType:"json",
				data : {Semester : idx_num, search_string: $("#CodeName").val()},
				url:"./search_name.php",
				success: function(data){
					console.log(data);
					var text="";
					for(var i=0;i<data.length;i++){
						text+="<tr><th><input type='checkbox' name='select' value='"+data[i].idx+"'></th>"+"<th>"+data[i].Code+"</th><th>"+data[i].LectureNum+"</th><th>"+data[i].Name+"</th><th>"+data[i].PName+"</th><th>"+data[i].Credit+"</th><th>"+data[i].Classroom+"</th><th>"+data[i].MajorName+"</th><th>"+data[i].Level+"</th>"+"<td></td>";
					}
					$("#upper_table_contents").html(text);
				}
			});
	}

	function show_search_major_table(){

		$.ajax({
				type:"POST",
				dataType:"json",
				data : {Semester : idx_num, Major: $("#major_select option:selected").val()},
				url:"./search_major.php",
				success: function(data){
					console.log(data);
					var text="";
					for(var i=0;i<data.length;i++){
						text+="<tr><th><input type='checkbox' name='select' value='"+data[i].idx+"'></th>"+"<th>"+data[i].Code+"</th><th>"+data[i].LectureNum+"</th><th>"+data[i].Name+"</th><th>"+data[i].PName+"</th><th>"+data[i].Credit+"</th><th>"+data[i].Classroom+"</th><th>"+data[i].MajorName+"</th><th>"+data[i].Level+"</th>"+"<td></td>";
					}
					$("#upper_table_contents").html(text);
				}
			});
	}

	function show_upper_table(){
		$.ajax({
				type:"POST",
				dataType:"json",
				data : {Semester : idx_num},
				url:"./upper_table.php",
				success: function(data){
					console.log(data);
					var text="";
					for(var i=0;i<data.length;i++){
						text+="<tr><th><input type='checkbox' name='select' value='"+data[i].idx+"'></th>"+"<th>"+data[i].Code+"</th><th>"+data[i].LectureNum+"</th><th>"+data[i].Name+"</th><th>"+data[i].PName+"</th><th>"+data[i].Credit+"</th><th>"+data[i].Classroom+"</th><th>"+data[i].MajorName+"</th><th>"+data[i].Level+"</th>"+"<td></td>";
					}
					$("#upper_table_contents").html(text);
				}
			});
	}

	function show_lower_table(){
		$.ajax({
				type:"POST",
				dataType:"json",
				data : {Semester : idx_num},
				url:"./lower_table.php",
				success: function(data){
					console.log(data);
					var text="";
					for(var i=0;i<data.length;i++){
						text+="<tr><th><input type='checkbox' name='select' value='"+data[i].idx+"'></th>"+"<th>"+data[i].Code+"</th><th>"+data[i].LectureNum+"</th><th>"+data[i].Name+"</th><th>"+data[i].PName+"</th><th>"+data[i].Credit+"</th><th>"+data[i].Classroom+"</th><th>"+data[i].MajorName+"</th><th>"+data[i].Level+"</th>"+"<td></td>";
					}
					$("#lower_table_contents").html(text);
				}
			});
	}

	show_upper_table();
	show_lower_table();
</script>
</html>