<?php
	include "connection.php";
	include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Registration</title>
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
			height: 159px;
	    	width: 1339px;
	    	background-color: orange;
		}
		.button_container
		{
			text-align: center;
		}
	</style>

</head>
<body>

<section>
	<div class="reg_img">
		<br><br><br>
		<div class="box2">
			<h1 style="text-align: center; font-size: 35px;font-family: Lucida Console;color: black;">图书馆管理系统</h1>
			<h1 style="text-align: center; font-size: 25px;color: black;margin-top: 20px;">用户注册</h1>
		<form name="Registration" action="" method="post">
			<div class="login">
				<input class="form-control" type="text" name="first" placeholder="First Name" required=""><br>
				<input class="form-control" type="text" name="last" placeholder="Last Name" required=""><br>
				<input class="form-control" type="text" name="username" placeholder="用户名" required=""><br>
				<input class="form-control" type="password" name="password" placeholder="密码" required=""><br>
				<input class="form-control" type="text" name="email" placeholder="邮箱" required=""><br><br>
				<div class="button_container"><input class="btn btn-default" type="submit" name="submit" value="注册" style="color:black; width: 70px; height: 30px;"></div>
			</div>
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
		$sql = "SELECT username from student";
		$res = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($res))
		{
			if($row['username'] == $_POST['username'])
			{
				$count = $count+1;
			}
		}
		if($count==0)
			{
				mysqli_query($db, "INSERT INTO `STUDENT` VALUES('$_POST[first]', '$_POST[last]', '$_POST[username]', '$_POST[password]', '$_POST[email]', 'User.jpg');");
				?>
					<script type="text/javascript">
						alert("注册成功！");
					</script>
				<?php
			}
			else
			{
				?>
					<script type="text/javascript">
					alert("用户名已存在！");
					</script>
				<?php
			}	

		}

?>
</body>
</html>