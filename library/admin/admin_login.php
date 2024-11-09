<?php
	include "connection.php";
	include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<style type="text/css">
		section
		{
			margin-top: -20px;
		}
		footer
		{
			margin-top: 50px;
			height: 158px;
	    	width: 1339px;
	    	background-color: orange;
		}
	</style>

</head>
<body>

<section>
	<div class="log_img">
		<br><br><br>
		<div class="box1">
			<h1 style="text-align: center; font-size: 35px;font-family: Lucida Console;color: black;">图书馆管理系统</h1>
			<h1 style="text-align: center; font-size: 25px;color: black;margin-top: 20px;">用户登录界面</h1><br>
		<form name="login" action="" method="post">
			<div class="login" style="text-align: center;">
				<input class="form-control" type="text" name="username" placeholder="用户名" required=""><br>
				<input class="form-control" type="password" name="password" placeholder="密码" required=""><br><br>
				<input class="btn btn-default" type="submit" name="submit" value="登录" style="color:black; width: 70px; height: 30px;">
			</div>
		
		<p style="color: black;padding-left: 40px;">
			<br><br>
			<a style="color: brown;" href="update_password.php">忘记密码了？</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			第一次来这个网站？&nbsp<a style="color: brown;" href="registration.php">注册</a>
		</p>
		</form>	
		</div>
	</div>
</section>
<footer>
	
</footer>
	<?php

		if(isset($_POST['submit']))
		{
			$count = 0;
			$res = mysqli_query($db, "SELECT * FROM `admin` WHERE username = '$_POST[username]' && password = '$_POST[password]';");

			$row = mysqli_fetch_assoc($res);
			
			$count = mysqli_num_rows($res);

			if($count==0)
			{
				?>
							<!---
							<script type="text/javascript">
								alert("The username or password doesn't match.");
							</script>  -->
						<div class="alert alert-danger" style="width: 422px; margin-left: 458px;">
						  <strong>用户名或密码错误</strong>
						</div>
				<?php
			}
			else
			{	
				/*--------如果用户名和密码匹配------*/
				
				$_SESSION['login_user'] = $_POST['username'];
				$_SESSION['pic'] = $row['pic'];
				?>
					<script type="text/javascript">
						window.location = "index.php";
					</script>
				<?php
			}
		}


	?>
	
</body>
</html>