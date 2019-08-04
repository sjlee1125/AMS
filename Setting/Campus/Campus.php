<style type="text/css">
	#SearchBar {height: 70px;text-align: right;}
	#input_text {height: 25px;width: 200px;border:5px solid #0084CD;border-radius: 12px;padding-left: 10px;font-size: 100%;}
	#btn_items {padding-top: 20px;margin-right: 30px;}
	.btn_SearchBar {color: white;background-color: #0084CD; border-radius: 12px;border: none;cursor: pointer;height: 35px;width: 110px;font-size: 16px; }
	#main_table {height: 615px;overflow-y: scroll;}
	#wrapper {width: 850px;height: 600px;background-color:#F7F7F7;margin-left: 20px;border: 1px solid #95989A;}
	#inner_table {width: 850px;color:#95989A;text-align: center;background-color:#F7F7F7;border-collapse: collapse;table-layout: fixed;}
	#inner_table thead{position: relative;top: expression(this.offsetParent.scrollTop);z-index: 20;}
	<!--thead 고정-->
	#inner_table tbody tr:first-child td{background-color:yellow ;padding-top: 32px;}
	th{padding: 6px 0px 6px 0px;border: 1px solid #95989A}
	tbody tr:hover {
  		background-color: lightblue;
	}


</style>
<div id="SearchBar">
	<div id="btn_items">
		<input id="input_text" type="text" name="query_text">
		<input class="btn_SearchBar" type="button" name="Search" value="Search" onclick="search()">
		<input class="btn_SearchBar" type="button" name="Add" value="ADD" onclick="addpopup()">
		<input class="btn_SearchBar" type="button" name="Delete" value="DELETE" onclick="deleteitem()">	
	</div>
</div>
<div id="main_table">
	<div id="wrapper">
		<table frame="below" id="inner_table">
			<thead>
				<tr>
					<th></th>
					<th>Campus Name</th>
					<th>Campus Code</th>
					<th></th>
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

	$("th:first-child").width("5%");
	//체크박스 사이즈조절

	function addpopup(){
		window.open("./Setting/Campus/addpopup.php","추가","width=500,height=400,left=500,top=100");
	}
	// add버튼 이벤트

	$('#table_contents').on('click','tr',function(evt){
			var $cell=$(evt.target).closest('th');
			
			if($cell.index()>0&&$cell.index()<4){
				console.log($(this).find('input').val());
				
				var mapForm = document.createElement("form");
			    mapForm.target = "Map";
			    mapForm.method = "POST"; // or "post" if appropriate
			    mapForm.action = "./Setting/Campus/modifypopup.php";

			    var mapInput = document.createElement("input");
			    mapInput.type = "hidden";
			    mapInput.name = "idx";
			    mapInput.value = $(this).find('input').val();
			    mapForm.appendChild(mapInput);

			    document.body.appendChild(mapForm);

			    window.open("", "Map", "width=500,height=400,left=500,top=100");
				mapForm.submit();
				//form과 input 동적으로 만들어 idx 값전
			}

	});
	// modify버튼 이벤트 ,테이블 row 클릭시 수정하게 하는 jquery

	function deleteitem(){
		var arr = $('input[name=select]:checked').serializeArray().map(function(item) { return item.value });
		console.log(arr);

		if(arr.length!=0){
			var datastring={ deleteitem : arr};
			
			$.ajax({
					type:"POST",
					//dataType:"json",
					data : datastring,
					url:"./Setting/Campus/delete.php",
					success: function(data){
						console.log(data);
						show_default_table(); //위치가 복잡 -> success하는 부분말고 함수가 끝나는 부분에 놓으면 한번삭제가 되고 바로 재로딩이 안된다. ajax가 두번 도는 거기때문에 순서를 맞추어주어야한다.
					}
			});
			
		}	
	}
	//delete 이벤트
	function search(){

		var search_data={ search_string: $("#input_text").val()};
		
		$.ajax({
				type:"POST",
				dataType:"json",
				data : search_data,
				url:"./Setting/Campus/search.php",
				success: function(data){
					console.log(data);
					var text="";
					for(var i=0;i<data.length;i++){
						text+="<tr><th><input type='checkbox' name='select' value='"+data[i].idx+"'></th>"+"<th>"+data[i].CampusName+"</th><th>"+data[i].CampusCode+"</th>"+"<th></th>";
					}
					$("#table_contents").html(text);
				}
			});
	}
	
	

	function show_default_table(){
		$.ajax({
				type:"POST",
				dataType:"json",
				url:"./Setting/Campus/default_table.php",
				success: function(data){
					console.log(data);
					var text="";
					for(var i=0;i<data.length;i++){
						text+="<tr><th><input type='checkbox' name='select' value='"+data[i].idx+"'></th>"+"<th>"+data[i].CampusName+"</th><th>"+data[i].CampusCode+"</th>"+"<th></th>";
					}
					$("#table_contents").html(text);
				}
			});
	}

	show_default_table();


</script>
