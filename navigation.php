<!DOCTYPE html>
<html>
<head>
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<style type="text/css">
		body {margin: 0;padding: 0;position: absolute;width: 1100px;height: 800px}
		ul { margin: 0;  padding: 0; }
		#topbar {overflow: hidden; position: relative;}
		#main_logo {padding:10px;float: left;}
		#main_navigation {float: right;position: absolute;bottom: 0;right: 0;margin-right: 50px; margin-bottom: 20px;}
		#main_navigation ul{cursor:pointer;margin-left:30px;display: inline;font-size: 160%;color: #0084CD;}
		#sub_navigation {width: 210px;background-color: #0084CD;float: left;}
		#white_space {height: 70px;background-color: white;}
		#actual_sub_navigation {height: 600px;background-color: #0084CD;padding-top: 15px}
		#actual_sub_navigation ul{cursor:pointer;font-size: 140%;margin-left: 30px;margin-top: 10px;color: white;}
		
		#sub_Student{display: block;}
		#sub_Subject{display: none;}
		#sub_Certificate{display: none;}
		#sub_Billing{display: none;}
		#sub_Setting{display: none;}

		#contents {width: 100%;height: 100%;}
	</style>
	<title></title>
</head>
<body>
	<div id="topbar" >
		<div id="main_logo">
			<img style="height: 100px;width: 311px;" src="./MainLogo_Text_tr.png"/>	
		</div>
		<div id="main_navigation">
			<ul id="Student" >Student</ul>
			<ul id="Subject">Subject</ul>
			<ul id="Certificate">Certificate</ul>
			<ul id="Billing">Billing</ul>
			<ul id="Setting">Setting</ul>
		</div>
	</div>
	<hr color="#0084CD" style="border:none; height: 10px;margin: 0px">
	<div id="sub_navigation">
		<div id="white_space"></div>
		<div id="actual_sub_navigation">
			<div id="sub_Student">
				<ul id="Student_Infomation">Basic Information</ul>
				<ul id="Register_Courses">Register Courses</ul>
				<ul id="Credit_Grade">Credit and Grade</ul>
			</div>
			<div id="sub_Subject">
				<ul id="Subject_Infomation">Basic Information</ul>
				<ul id="Grade_Manage">Grade Manage</ul>
			</div>
			<div id="sub_Certificate">
				<ul id="Transcript">Transcript</ul>
				<ul id="Diploma">Diploma</ul>
				<ul id="Enrollment">Enrollment</ul>
			</div>
			<div id="sub_Billing">
				<ul id="Billing_Infomation">Basic Information</ul>
			</div>
			<div id="sub_Setting">
				<ul id="Semester">Semester</ul>
				<ul id="Major">Major</ul>
				<ul id="Professor">Professor</ul>
				<ul id="Campus">Campus</ul>
			</div>
		</div>
	</div>
	<div id="contents">
		<script type="text/javascript">
			$('#Student').css("color","#0F2C44");
			$('#Subject').css("color","#0084CD");
			$('#Certificate').css("color","#0084CD");
			$('#Billing').css("color","#0084CD");
			$('#Setting').css("color","#0084CD");

			$('#sub_Student').css("display","block");
			$('#sub_Subject').css("display","none");
			$('#sub_Certificate').css("display","none");
			$('#sub_Billing').css("display","none");
			$('#sub_Setting').css("display","none");

			$('#Student_Infomation').css('color','#0F2C44');
			$('#Register_Courses').css('color','white');
			$('#Credit_Grade').css('color','white');
			$('#contents').load("./Student/BasicInformation/BasicInformation.php");
		</script>
	</div>
</body>
<script type="text/javascript">
	function main_navigation_listener(event){
		switch(event.target.id){
			case 'Student':
				$('#Student').css("color","#0F2C44");
				$('#Subject').css("color","#0084CD");
				$('#Certificate').css("color","#0084CD");
				$('#Billing').css("color","#0084CD");
				$('#Setting').css("color","#0084CD");

				$('#sub_Student').css("display","block");
				$('#sub_Subject').css("display","none");
				$('#sub_Certificate').css("display","none");
				$('#sub_Billing').css("display","none");
				$('#sub_Setting').css("display","none");

				$('#Student_Infomation').css('color','#0F2C44');
				$('#Register_Courses').css('color','white');
				$('#Credit_Grade').css('color','white');

				$('#contents').load("./Student/BasicInformation/BasicInformation.php");

				break;
			case 'Subject':
				$('#Student').css("color","#0084CD");
				$('#Subject').css("color","#0F2C44");
				$('#Certificate').css("color","#0084CD");
				$('#Billing').css("color","#0084CD");
				$('#Setting').css("color","#0084CD");

				$('#sub_Student').css("display","none");
				$('#sub_Subject').css("display","block");
				$('#sub_Certificate').css("display","none");
				$('#sub_Billing').css("display","none");
				$('#sub_Setting').css("display","none");

				$('#Subject_Infomation').css('color','#0F2C44');
				$('#Grade_Manage').css('color','white');

				$('#contents').load("./Subject/BasicInformation/BasicInformation.php");

				break;
			case 'Certificate':
				$('#Student').css("color","#0084CD");
				$('#Subject').css("color","#0084CD");
				$('#Certificate').css("color","#0F2C44");
				$('#Billing').css("color","#0084CD");
				$('#Setting').css("color","#0084CD");

				$('#sub_Student').css("display","none");
				$('#sub_Subject').css("display","none");
				$('#sub_Certificate').css("display","block");
				$('#sub_Billing').css("display","none");
				$('#sub_Setting').css("display","none");

				$('#Transcript').css('color','#0F2C44');
				$('#Diploma').css('color','white');
				$('#Enrollment').css('color','white');

				$('#contents').load("./Certificate/Transcript/Transcript.php");

				break;
			case 'Billing':
				$('#Student').css("color","#0084CD");
				$('#Subject').css("color","#0084CD");
				$('#Certificate').css("color","#0084CD");
				$('#Billing').css("color","#0F2C44");
				$('#Setting').css("color","#0084CD");

				$('#sub_Student').css("display","none");
				$('#sub_Subject').css("display","none");
				$('#sub_Certificate').css("display","none");
				$('#sub_Billing').css("display","block");
				$('#sub_Setting').css("display","none");

				$('#Billing_Infomation').css("color","#0F2C44");

				$('#contents').load("./Billing/Billing.php");

				break;
			case 'Setting':
				$('#Student').css("color","#0084CD");
				$('#Subject').css("color","#0084CD");
				$('#Certificate').css("color","#0084CD");
				$('#Billing').css("color","#0084CD");
				$('#Setting').css("color","#0F2C44");

				$('#sub_Student').css("display","none");
				$('#sub_Subject').css("display","none");
				$('#sub_Certificate').css("display","none");
				$('#sub_Billing').css("display","none");
				$('#sub_Setting').css("display","block");

				$('#Semester').css('color','#0F2C44');
				$('#Major').css('color','white');
				$('#Professor').css('color','white');
				$('#Campus').css('color','white');

				$('#contents').load("./Setting/Semester/Semester.php");

				break;
			
		}
	}
	$('#Student').bind('click',main_navigation_listener);
	$('#Subject').bind('click',main_navigation_listener);
	$('#Certificate').bind('click',main_navigation_listener);
	$('#Billing').bind('click',main_navigation_listener);
	$('#Setting').bind('click',main_navigation_listener);

	function sub_navigation_listener(event){
		switch(event.target.id){
			case 'Student_Infomation':
				$('#Student_Infomation').css('color','#0F2C44');
				$('#Register_Courses').css('color','white');
				$('#Credit_Grade').css('color','white');

				$('#contents').load("./Student/BasicInformation/BasicInformation.php");	

				break;
			case 'Register_Courses':
				$('#Student_Infomation').css('color','white');
				$('#Register_Courses').css('color','#0F2C44');
				$('#Credit_Grade').css('color','white');

				$('#contents').load("./Student/RegisterCourses/RegisterCourses.php");	

				break;
			case 'Credit_Grade':
				$('#Student_Infomation').css('color','white');
				$('#Register_Courses').css('color','white');
				$('#Credit_Grade').css('color','#0F2C44');

				$('#contents').load("./Student/CreditAndGrade/CreditAndGrade.php");	

				break;
			case 'Subject_Infomation':
				$('#Subject_Infomation').css('color','#0F2C44');
				$('#Grade_Manage').css('color','white');

				$('#contents').load("./Subject/BasicInformation/BasicInformation.php");
				
				break;
			case 'Grade_Manage':
				$('#Subject_Infomation').css('color','white');
				$('#Grade_Manage').css('color','#0F2C44');

				$('#contents').load("./Subject/GradeManage/GradeManage.php");

				break;
			case 'Transcript':
				$('#Transcript').css('color','#0F2C44');
				$('#Diploma').css('color','white');
				$('#Enrollment').css('color','white');

				$('#contents').load("./Certificate/Transcript/Transcript.php");

				break;
			case 'Diploma':
				$('#Transcript').css('color','white');
				$('#Diploma').css('color','#0F2C44');
				$('#Enrollment').css('color','white');

				$('#contents').load("./Certificate/Diploma/Diploma.php");

				break;
			case 'Enrollment':
				$('#Transcript').css('color','white');
				$('#Diploma').css('color','white');
				$('#Enrollment').css('color','#0F2C44');

				$('#contents').load("./Certificate/Enrollment/Enrollment.php");

				break;
			case 'Billing_Infomation':
				break;
			case 'Semester':
				$('#Semester').css('color','#0F2C44');
				$('#Major').css('color','white');
				$('#Professor').css('color','white');
				$('#Campus').css('color','white');

				$('#contents').load("./Setting/Semester/Semester.php");

				break;
			case 'Major':
				$('#Semester').css('color','white');
				$('#Major').css('color','#0F2C44');
				$('#Professor').css('color','white');
				$('#Campus').css('color','white');

				$('#contents').load("./Setting/Major/Major.php");

				break;
			case 'Professor':
				$('#Semester').css('color','white');
				$('#Major').css('color','white');
				$('#Professor').css('color','#0F2C44');
				$('#Campus').css('color','white');

				$('#contents').load("./Setting/Professor/Professor.php");

				break;
			case 'Campus':
				$('#Semester').css('color','white');
				$('#Major').css('color','white');
				$('#Professor').css('color','white');
				$('#Campus').css('color','#0F2C44');

				$('#contents').load("./Setting/Campus/Campus.php");

				break;
		}
	}
	$('#Student_Infomation').bind('click',sub_navigation_listener);
	$('#Register_Courses').bind('click',sub_navigation_listener);
	$('#Credit_Grade').bind('click',sub_navigation_listener);
	$('#Subject_Infomation').bind('click',sub_navigation_listener);
	$('#Grade_Manage').bind('click',sub_navigation_listener);
	$('#Transcript').bind('click',sub_navigation_listener);
	$('#Diploma').bind('click',sub_navigation_listener);
	$('#Enrollment').bind('click',sub_navigation_listener);
	$('#Semester').bind('click',sub_navigation_listener);
	$('#Major').bind('click',sub_navigation_listener);
	$('#Professor').bind('click',sub_navigation_listener);
	$('#Campus').bind('click',sub_navigation_listener);
</script>
</html>