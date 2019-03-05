<!DOCTYPE html>
<html>
<head>

<style type="text/css">
	
	#main {width: 620px; height: 380px; background-color: #F7F7F7; border-color: #95989A ; border-style: solid; border-width: 1px; margin-left: auto; margin-right: auto; margin-top: 130px;}
	img {height: 100px;width: 311px;margin-top: 40px;margin-left: auto; margin-right: auto; display: block;}
	input[type=text],input[type=password]{
    	width: 40%;
    	height: 30px;
    	margin: 8px 0;
    	display: inline-block;
    	border: 1px solid #ccc;
    	border-radius: 4px;
    	box-sizing: border-box;
	}

	input[type=submit]{
    	width: 40%;
    	background-color: #0084CD;
    	color: white;
    	padding: 14px 20px;
    	margin: 8px 0;
    	border: none;
    	border-radius: 4px;
    	cursor: pointer;
	}

</style>
	<title></title>
</head>
<body>

<div id="main">

	<img src="MainLogo_Text_tr.png">

		<div style="margin-left: 220px;margin-top: 20px;">
			<form action="check_login.php" method="post">	
				<label for="id">ID &nbsp;&nbsp;</label><input type="text" name="id"><br>
				<label for="pw">PW </label><input type="password" name="pw"><br>
				<input type="submit" value="Login" style="margin-left: 27px">
			</form>	
		</div>

</div>
</body>
</html>