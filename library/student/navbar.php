<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
</head>
<body>

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand active">图书馆管理系统</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php">首页</a></li>
				<li><a href="books.php">藏书</a></li>				
				<li><a href="feedback.php">反馈</a></li>
			</ul>
			<?php
				if(isset($_SESSION['login_user']))
				{
					?>
						<ul class="nav navbar-nav">
							<li><a href="profile.php">个人档案</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="message.php"><span class="glyphicon glyphicon-envelope"></span>&nbsp<span class="badge bg-green">0</span></a></li>
							<li><a href="">
								<div style="color:white">
								<?php
									echo "<img class='img-circle profile_img' height=25 width=25 src='images/".$_SESSION['pic']."'>";
									echo " ".$_SESSION['login_user'];
								?>
								</div>
							</a></li>
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> 登出</span></a></li>
						</ul>
					<?php
				}
				else
				{
					?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="student_login.php"><span class="glyphicon glyphicon-log-in"> 登录</span></a></li>
					<li><a href="registration.php"><span class="glyphicon glyphicon-user"> 注册</span></a></li>
				</ul>
				<?php
				}

			?>

			
		</div>
	</nav>

</body>
</html>