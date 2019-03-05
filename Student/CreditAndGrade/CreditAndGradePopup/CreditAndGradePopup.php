<!DOCTYPE html>
<html>
<head>
	<title>Credit And Grade</title>
	<?php include "../../../dbconnect.php" ?> <!-- Major를 불러오기위해서 php통신 필요 -->
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<style type="text/css">
		body {margin: 0;padding: 0;}
		#main_body {margin-left: 20px;margin-top: 15px;margin-right: 20px;margin-bottom: 100px;}
		.title_content {margin-bottom: 20px;}
		.title {display: inline-block;background-color: #D6E6EC;color: #9B9FA0;width: 120px;height: 30px;text-align: center;line-height: 33px; border:1px solid #9B9FA0;margin-right: 0;float: left;}
		.content1 {display: inline-block;width: 120px;height: 30px;border:1px solid #9B9FA0;font-size: 90%;padding-left: 5px;text-align: center;line-height: 33px;float: left;}
		.wrapper {width:100%;height: 500px;background-color:#F7F7F7;border: 1px solid #95989A;overflow-y: scroll;overflow-x:scroll; }
		.inner_table {white-space:nowrap;color:#95989A;text-align: center;background-color:#F7F7F7;border-collapse: collapse;table-layout: fixed;}
		.inner_table thead{position: relative;top: expression(this.offsetParent.scrollTop);z-index: 20;}
		<!--thead 고정-->
		.inner_table tbody tr:first-child td{background-color:yellow ;padding-top: 32px;}
		th{padding: 6px 5px 6px 5px;border: 1px solid #95989A}
		tbody tr:hover {
	  		background-color: lightblue;
		}
	</style>
</head>

<body>
	<div id="main_body">
		<div class="title_content" style="overflow: hidden;">
			<span class="title">StudentName</span>
			<span class="content1">
				<?php  
					$Student_idx=$_POST["Student"];
		
					$sql="select student.*, MajorName from student join major on student.Major =major.idx where student.idx='".$Student_idx."'";
					$result=$conn->query($sql);
					
					$StudentNumber="";
					$FirstName="";
					$LastName="";
					$MajorName="";
					$State="";
					$Level="";

					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
							$StudentNumber=$row["StudentNumber"];
							$FirstName=$row["FirstName"];
							$LastName=$row["LastName"];
							$MajorName=$row["MajorName"];
							$State=$row["State"];
							$Level=$row["Level"];
						}
					}else{
						echo "0 result";
					}
					echo $FirstName." ".$LastName;
				?>
			</span>
			<span class="title">Major</span>
			<span class="content1">
				<?php  
					echo $MajorName;
				?>
			</span>
			<span class="title">Level</span>
			<span class="content1">
				<?php  
					echo $Level;
				?>
			</span>
			
			<script type="text/javascript">
					var Student_idx='<?= $Student_idx ?>';
			</script>
		</div>
			<span class="title">State</span>
			<span class="content1">
				<?php  
					echo $State;
				?>
			</span>

		<div>
			
		</div>
		<div style="margin-top:60px;">
			<span>Subject List</span>
		</div>
		<div class="wrapper">
			<table frame="below" class="inner_table">
				<thead>
					<tr>
						<th>Semester</th>
						<th>Subject Name</th>
						<th>Credit</th>
						<th>Grade</th>
						<td></td>
					</tr>
				</thead>
				<tbody id="upper_table_contents">
					<?php 
						$sql="select Semester from semester_student where Student='".$Student_idx."'";
						$result=$conn->query($sql);
						

						$TOTAL_GRADE=NULL;
						$TOTAL_CREDIT=NULL;
						$TOTAL_ROW_NUM=NULL;

						if($result->num_rows>0){
							while($row=$result->fetch_assoc()){
								
								$inner_sql="select semester.SemesterName,subject.Name,subject.Credit,students_lecture.Grade from students_lecture join semester on semester.idx=students_lecture.Semester join subject on subject.idx=students_lecture.Subject where students_lecture.Semester=".$row["Semester"]." and students_lecture.Student=".$Student_idx;
								
								$inner_result=$conn->query($inner_sql);
								

								$SEMESTER_GRADE=NULL;
								$SEMESTER_CREDIT=NULL;
								$SEMESTER_ROW_NUM=mysqli_num_rows($inner_result);

								$TOTAL_ROW_NUM+=$SEMESTER_ROW_NUM;

								if ($inner_result->num_rows>0) {
									
									$i=0;

									while ($inner_row=$inner_result->fetch_assoc()) {
										if($i==0){
											echo "<tr><th>".$inner_row['SemesterName']."</th><th>".$inner_row["Name"]."</th><th>".$inner_row["Credit"]."</th><th>".$inner_row["Grade"]."</th></tr>";
											$i++;
										}else{
											echo "<tr><th></th><th>".$inner_row["Name"]."</th><th>".$inner_row["Credit"]."</th><th>".$inner_row["Grade"]."</th></tr>";
										}

										$SEMESTER_CREDIT+=$inner_row["Credit"];
										$TOTAL_CREDIT+=$inner_row["Credit"];

										if ($inner_row["Grade"]=="null") {
											$SEMESTER_GRADE+=0.0;
										}else{
											$SEMESTER_GRADE+=transfer_grade($inner_row["Grade"]);	
											$TOTAL_GRADE+=transfer_grade($inner_row["Grade"]);
										}
										
									}
									echo "<tr><th></th><th>Semester Credit : ".$SEMESTER_CREDIT." &nbsp;&nbsp;Semester Grade : ".transfer_dot($SEMESTER_GRADE/$SEMESTER_ROW_NUM)."</th><th></th><th></th></tr>";
								}
							}
							echo "<tr><th></th><th></th><th></th><th></th></tr>";
							echo "<tr><th></th><th>Total Credit : ".$TOTAL_CREDIT." &nbsp;&nbsp;Total Grade : ".transfer_dot($TOTAL_GRADE/$TOTAL_ROW_NUM)."</th><th></th><th></th></tr>";

						}else{
							echo "0 result";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
<?php
	function transfer_grade($grade){
		switch ($grade){
			case "A":
				return 4.0;
			case "A-":
				return 3.75;
			case "B+":
				return 3.25;
			case "B":
				return 3.0;
			case "B-":
				return 2.75;
			case "C+":
				return 2.25;
			case "C":
				return 2.0;
			case "C-":
				return 1.75;
			case "D":
				return 1.0; 
			case "F":
				return 0.0;
		}
	}

	function transfer_dot($value){
		$value=(int)($value*100);
		$value=((double)$value)/100;
		return $value;
	}
?>
</html>