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

</style>
<div id="SearchBar">
	<div id="btn_items">
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
					<th>StudentNumber</th>
					<th>FirstName</th>
					<th>LastName</th>
					<th>Birth</th>
					<th>Phone</th>
					<th>E-mail</th>
					<th>Address</th>
					<th>Major</th>
					<th>State</th>
					<th>Campus</th>
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
			
			if($cell.index()>0&&$cell.index()<12){
				console.log($(this).find('input').val());
				
				var mapForm = document.createElement("form");
			    mapForm.target = "Map";
			    mapForm.method = "POST"; // or "post" if appropriate
			    mapForm.action = "./Certificate/Diploma/DiplomaPopup.php";

			    var mapInput = document.createElement("input");
			    mapInput.type = "hidden";
			    mapInput.name = "Student";
			    mapInput.value = $(this).find('input').val();
			    mapForm.appendChild(mapInput);

			    document.body.appendChild(mapForm);

			    window.open("", "Map", "width=1000,height=800,left=200,top=0");
				mapForm.submit();
				//form과 input 동적으로 만들어 idx 값전
			}

	});
	// modify버튼 이벤트 ,테이블 row 클릭시 수정하게 하는 jquery

	function search(){

		var search_data={ search_string: $("#input_text").val()};
		
		$.ajax({
				type:"POST",
				dataType:"json",
				data : search_data,
				url:"./Certificate/Diploma/search.php",
				success: function(data){
					console.log(data);
					var text="";
					for(var i=0;i<data.length;i++){
						text+="<tr><th hidden><input type='checkbox' name='select' value='"+data[i].idx+"'></th>"+"<th>"+data[i].StudentNumber+"</th><th>"+data[i].FirstName+"</th><th>"+data[i].LastName+"</th><th>"+data[i].Birth+"</th><th>"+data[i].Phone+"</th><th>"+data[i].Email+"</th><th>"+data[i].Address+"</th><th>"+data[i].MajorName+"</th><th>"+data[i].State+"</th><th>"+data[i].CampusName+"</th><th>"+data[i].Level+"</th>"+"<td></td>";
					}
					$("#table_contents").html(text);
				}
			});
	}
	
	

	function show_default_table(){
		$.ajax({
				type:"POST",
				dataType:"json",
				url:"./Certificate/Diploma/default_table.php",
				success: function(data){
					console.log(data);
					var text="";
					for(var i=0;i<data.length;i++){
						text+="<tr><th hidden><input type='checkbox' name='select' value='"+data[i].idx+"'></th>"+"<th>"+data[i].StudentNumber+"</th><th>"+data[i].FirstName+"</th><th>"+data[i].LastName+"</th><th>"+data[i].Birth+"</th><th>"+data[i].Phone+"</th><th>"+data[i].Email+"</th><th>"+data[i].Address+"</th><th>"+data[i].MajorName+"</th><th>"+data[i].State+"</th><th>"+data[i].CampusName+"</th><th>"+data[i].Level+"</th>"+"<td></td>";
					}
					$("#table_contents").html(text);
				}
			});
	}

	show_default_table();


</script>