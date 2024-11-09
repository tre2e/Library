<?php
	session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Library Management System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style type="text/css">
nav
{
    float: right;
    word-spacing: 50px;
    padding: 30px;
    font-size: 20px;
}
nav li
{
    display: inline-block;
    line-height: 70px;
}	
</style>
</head>



<body>
	 <div class="wrapper">
		<header>
			<div class="logo">
			<img src="images/Library.png">
		</div>

		<?php
		if(isset($_SESSION['login_user']))
		{
			?>
			<nav>
				<ul>
					<li><a href="index.php">首页</a></li>
					<li><a href="books.php">书目</a></li>
					<li><a href="logout.php">登出</a></li>
					<li><a href="feedback.php ">反馈</a></li>
				</ul>
			</nav>
			<?php

		}
		else
		{
			?>
			<nav>
				<ul>
					<li><a href="index.php">首页</a></li>
					<li><a href="books.php">书目</a></li>
					<li><a href="student_login.php">学生登录</a></li>
					<li><a href="registration.php">注册</a></li>
					<li><a href="feedback.php ">反馈</a></li>
				</ul>
			</nav>

			<?php
		}
		?>


			
		</header>
		<section>
			<div class="sec_img">
				<br><br><br>
				<div class="box">
					<br><br>
					<h1 style="text-align: center; font-size: 35px;">欢迎来到图书馆</h1><br>
					<h1 style="text-align: center; font-size: 25px;"> 开馆: 09:00</h1><br>
					<h1 style="text-align: center; font-size: 25px;">闭馆:15:00</h1><br>
				</div>
			</div>
		</section>
	
	</div>
	<?php
		include "footer.php";
	?>
</body>
</html>