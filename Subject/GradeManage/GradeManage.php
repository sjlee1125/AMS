<style type="text/css">
	#SearchBar {height: 70px;text-align: right;}
	#input_text {height: 25px;width: 200px;border:5px solid #0084CD;border-radius: 12px;padding-left: 10px;font-size: 100%;}
	#btn_items {padding-top: 20px;margin-right: 30px;}
	.btn_SearchBar {color: white;background-color: #0084CD; border-radius: 12px;border: none;cursor: pointer;height: 35px;width: 110px;font-size: 16px; }
	#main_table {height: 615px;}
	#wrapper {width: 850px;height: 600px;background-color:#F7F7F7;margin-left: 230px;border: 1px solid #95989A;overflow-y: scroll;overflow-x:scroll; }
	#inner_table {white-space:nowrap;color:#95989A;text-align: center;background-color:#F7F7F7;border-collapse: collapse;table-layout: fixed;}
	#inner_table thead{position: relative;top: expression(this.offsetParent.scrollTop);z-index: 20;}
	<!--thead 고정-->
	#inner_table tbody tr:first-child td{background-color:yellow ;padding-top: 32px;}
	th{padding: 6px 5px 6px 5px;border: 1px solid #95989A}
	tbody tr:hover {
  		background-color: lightblue;
	}
	.select_option {font-size: 90%;width: 139px;height: 32px;}
</style>
<div id="SearchBar">
	<div id="btn_items">
		<select name="semester" class="select_option" id="semester_select" onchange="show_default_table()">
			<?php 
				include "../../dbconnect.php";//아주 이상하다... 폴더경로가 다른데 실행이된다.
				$sql="select * from semester";
				$result=$conn->query($sql);

				if($result->num_rows>0){
					while($row=$result->fetch_assoc()){
						echo "<option value='".$row["idx"]."'>".$row["SemesterName"]."</option>";
					}
				}else{//전공없는것 예외처리
					echo '<script>
							alert("There are no Semester");
						</script>';
				}
			?>
		</select>
		<input id="input_text" type="text" name="query_text">
		<input class="btn_SearchBar" type="button" name="Search" value="Search" onclick="search()">
	</div>
</div>
<div id="main_table">
	<div id="wrapper">
		<table frame="below" id="inner_table">
			<thead>
				<tr>
					<th hidden></th>
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
			<tbody id="table_contents">
				<!-- <tr>
					<th><input type="checkbox" name="select" value="1"></th>
					<th >11</th>
					<th>22</th>
					<th>33</th>
					<th>33</th>
				</tr>
				<tr>
					<th><input type="checkbox" name="select" value="2"></th>
					<th>1</th>
					<th>2</th>
					<th>3</th>
					<th>33</th>
				</tr>
				<tr>
					<th><input type="checkbox" name="select" value="3"></th>
					<th>1</th>
					<th>2</th>
					<th>3</th>
					<th>33</th>
				</tr> -->
			</tbody>
	</table>
	</div>
</div>
<script type="text/javascript">

	$('#table_contents').on('click','tr',function(evt){
			var $cell=$(evt.target).closest('th');
			
			if($cell.index()>0&&$cell.index()<9){
				console.log($(this).find('input').val());
				
				var mapForm = document.createElement("form");
			    mapForm.target = "Map";
			    mapForm.method = "POST"; // or "post" if appropriate
			    mapForm.action = "./Subject/GradeManage/GradeManagePopup/GradeManagePopup.php";

			    var mapInput = document.createElement("input");
			    mapInput.type = "hidden";
			    mapInput.name = "Subject";
			    mapInput.value = $(this).find('input').val();
			    mapForm.appendChild(mapInput);

			    var mapInput1 = document.createElement("input");
			    mapInput1.type = "hidden";
			    mapInput1.name = "Semester";
			    mapInput1.value = $("#semester_select option:selected").val();
			    mapForm.appendChild(mapInput1);

			    document.body.appendChild(mapForm);

			    console.log($(this).find('input').val()+" "+$("#semester_select option:selected").val());

			    window.open("", "Map", "width=1000,height=800,left=200,top=0");
				mapForm.submit();
				//form과 input 동적으로 만들어 idx 값전
			}

	});
	// modify버튼 이벤트 ,테이블 row 클릭시 수정하게 하는 jquery

	function search(){

		var search_data={ Semester : $("#semester_select option:selected").val() ,search_string: $("#input_text").val()};
		
		$.ajax({
				type:"POST",
				dataType:"json",
				data : search_data,
				url:"./Subject/GradeManage/search.php",
				success: function(data){
					console.log(data);
					var text="";
					for(var i=0;i<data.length;i++){
						text+="<tr><th hidden><input type='checkbox' name='select' value='"+data[i].idx+"'></th>"+"<th>"+data[i].Code+"</th><th>"+data[i].LectureNum+"</th><th>"+data[i].Name+"</th><th>"+data[i].PName+"</th><th>"+data[i].Credit+"</th><th>"+data[i].Classroom+"</th><th>"+data[i].MajorName+"</th><th>"+data[i].Level+"</th>"+"<td></td>";
					}
					$("#table_contents").html(text);
				}
			});
	}
	
	

	function show_default_table(){
		$.ajax({
				type:"POST",
				dataType:"json",
				url:"./Subject/GradeManage/default_table.php",
				data : { Semester : $("#semester_select option:selected").val()},
				success: function(data){
					console.log(data);
					var text="";
					for(var i=0;i<data.length;i++){
						text+="<tr><th hidden><input type='checkbox' name='select' value='"+data[i].idx+"'></th>"+"<th>"+data[i].Code+"</th><th>"+data[i].LectureNum+"</th><th>"+data[i].Name+"</th><th>"+data[i].PName+"</th><th>"+data[i].Credit+"</th><th>"+data[i].Classroom+"</th><th>"+data[i].MajorName+"</th><th>"+data[i].Level+"</th>"+"<td></td>";
					}
					$("#table_contents").html(text);
				}
			});
	}

	show_default_table();


</script>