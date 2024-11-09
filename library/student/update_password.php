<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reset Password</title>
	<style type="text/css">
		body
		{
			height: 650px;
			background-color: whitesmoke;
		}
		.wrapper
		{
			width: 400px;
			height: 400px;
			background-color: grey;
			margin: 100px auto;
			opacity: .8;
			padding: 25px 15px;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<div style="text-align: center;">
			<h1 style="text-align: center; font-size: 35px;font-family: Lucida Console;color: black;">图书馆管理系统</h1>
			<h1 style="text-align: center; font-size: 20px;font-family: Lucida Console;color: black;">重新设置你的密码</h1>
		</div>

		<div style="text-align: center;">
		<form action="" method="post">
			<input type="text" name="username" class="form-control" placeholder="用户名" required=""><br>
			<input type="text" name="email" class="form-control" placeholder="邮箱" required=""> <br>
			<input type="text" name="password" class="form-control" placeholder="新密码" required=""><br>
			<button class="btn btn-default" type="submit" name="submit">重置</button>
		</form>
		</div>
	</div>
	<?php

		if(isset($_POST['submit']))
		{
			if(mysqli_query($db, "UPDATE student SET password='$_POST[password]' WHERE username='$_POST[username]' AND email='$_POST[email]' ;"))
			{
				?>
				<script type="text/javascript">
					alert("密码成功重置！");
				</script>

				<?php
			}
		}
	?>
</body>
</html>