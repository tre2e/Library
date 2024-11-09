<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>编辑个人档案</title>
	<style type="text/css">
		.form-control
		{
			width:250px;
			height:35px;
		}
		form
		{
			padding-left: 550px;
		}
		label
		{
			color:whitesmoke;
		}
	</style>
</head>
<body style="background-color: #004528;">

	<h2 style="text-align: center; color:whitesmoke;">编辑个人档案</h2>
	<?php
		$sql = "SELECT * FROM student WHERE username='$_SESSION[login_user]' ";
		$result = mysqli_query($db,$sql) or die (mysql_error());

		while($row = mysqli_fetch_assoc($result))
		{
			$first = $row['first'];
			$last = $row['last'];
			$username = $row['username'];
			$password = $row['password'];
			$email = $row['email'];
		}

	?>
	<div class="profile_info" style="text-align: center;">
		<span style="color: white;">欢迎，</span>
		<h4 style="color: white;"><?php echo $_SESSION['login_user'];?></h4>
	</div><br><br>
	<form action="" method="post" enctype="multipart/form-data">

		<input class="form-control" type="file" name="file">

		<label><h4><b>First Name</b></h4></label>
		<input class="form-control" type="text" name="first" value="<?php echo $first; ?>">
		<label><h4><b>Last Name</b></h4></label>
		<input class="form-control" type="text" name="last" value="<?php echo $last; ?>">
		<label><h4><b>Username</b></h4></label>
		<input class="form-control" type="text" name="username"  value="<?php echo $username; ?>">
		<label><h4><b>Password</b></h4></label>
		<input class="form-control" type="text" name="password"  value="<?php echo $password; ?>">
		<label><h4><b>Email</b></h4></label>
		<input class="form-control" type="text" name="email"  value="<?php echo $email; ?>"><br>
		<div style="padding-left:100px;">
			<button class="btn btn-default" type="submit" name="submit">保存</button>
		</div>
	</form>
<div>
	<?php
		if(isset($_POST['submit']))
		{
			move_uploaded_file($_FILES['file']['tmp_name'], "images/".$FILES['file']['name']);

			$first = $_POST['first'];
			$last = $_POST['last'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$pic = $_FILES['file']['name'];

			$sql1="UPDATE student SET pic='$pic', first='$first', last='$last', username='$username', password='$password', email='$email' WHERE username='".$_SESSION['login_user']."';";
			if(mysqli_query($db, $sql1))
			{
				?>
					<script type="text/javascript">
						alert("成功保存！")
						window.location="profile.php"
					</script>
				<?php
			}
		}
	?>
</div>
</body>
</html>