<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<style type="text/css">
		.wrapper
		{
			width: 300px;
			margin: 0 auto;
			color: white;
		}
	</style>
</head>
<body style="background-color:#004528;">
	<div class="container">
		<form action="" method="post">
			<button class="btn btn-default" style="float: right; width: 70px" name="submit1" type="submit">编辑</button>
		</form>
		<div class="wrapper">
			<?php
				if(isset($_POST['submit1']))
				{
					header("Location: edit.php"); // 使用 header 函数进行重定向
					exit; // 确保脚本在此处终止
				}

				$q=mysqli_query($db, "SELECT * FROM admin where username='$_SESSION[login_user]' ;");
			?>
			<h2 style="text-align: center;">我的档案</h2>
			<?php
				$row=mysqli_fetch_assoc($q);

				echo "<div style='text-align: center'>
				<img class='img-circle profile-img' height=110 width=110 src='images/".$_SESSION['pic']."'>
				</div>";
			?>
				<div style="text-align: center;"><b>欢迎，</b>
					<h4>
						<?php echo $_SESSION['login_user']; ?>
					</h4>
				</div>
			<?php
			echo "<b>";
				echo "<table class='table table-bordered'>";
					echo "<tr>";
						echo "<td>";
							echo "<b> First Name: </b>";
						echo "</td>";
						echo "<td>";
							echo $row['first'];
						echo "</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td>";
							echo "<b> Last Name: </b>";
						echo "</td>";
						echo "<td>";
							echo $row['last'];
						echo "</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td>";
							echo "<b> User Name: </b>";
						echo "</td>";
						echo "<td>";
							echo $row['username'];
						echo "</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td>";
							echo "<b> Email: </b>";
						echo "</td>";
						echo "<td>";
							echo $row['email'];
						echo "</td>";
					echo "</tr>";

				echo "</table>";
			echo "</b>";
			?>
		</div>
	</div>
</body>
</html>