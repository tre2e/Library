<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Book Request</title>
	<style type="text/css">
.srch
{
	padding-left: 800px;
	margin-top: 10px;
}
.form-control
{
	width: 300px;
	height: 40px;
	background-color: black;
	color: white;
}
body 
{
	font-family: "Lato", sans-serif;
	transition: background-color .5s;
}

.sidenav {
  height: 100%;
  margin-top: 50px;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #222;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.img-circle
{
	margin-left: ;
}
.h:hover
{
	color:white;
	width: 250px;
	height:50px;
	background-color: #00544c;
}
.container
{
	height: 600px;
	background-color: black;
	color: white;
	opacity: .8;
}
.scroll
{
	width: 100%;
	height: 280px;
	overflow: auto;
}
th,td
{
	width: 10%;
}
</style>
</head>
<body>
	<!--______________________sidenav__________________________-->
	<div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

	  <div style="color:white; margin-left: 70px;font-size: 20px;">
		<?php
		if(isset($_SESSION['login_user']))
		{
			echo "<img class='img-circle profile_img' height=100 width=100 src='images/".$_SESSION['pic']."'>";
			echo "</br></br>";
			echo "欢迎！ ".$_SESSION['login_user'];
		}
			
		?>
	</div>
	  <div class="h"><a href="books.php">书目</a></div>
	  <div class="h"><a href="request.php">借阅请求</a></div>
	  <div class="h"><a href="issue_info.php">已借详情</a></div>
	  <div class="h"><a href="expired.php">还书列表</a></div>

	</div>

<div id="main">
	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>
<div class="container">
	<div class="srch">
			<form method="post" action="" name="form1">
				<input type="text" name="username" class="form-control" placeholder="用户名" required=""><br>
				<input type="text" name="bid" class="form-control" placeholder="书籍编号" required=""><br>
				<button class="btn btn-default" name="submit" type="submit">处理</button><br>
			</form>
	</div>

		<h2 style="text-align: center;">书籍借阅请求</h2>
		<?php
			if(isset($_SESSION['login_user']))
			{

				$sql="SELECT student.username,books.bid,name,authors,edition,status FROM student inner join issue_book ON student.username=issue_book.username inner join books ON issue_book.bid=books.bid WHERE issue_book.approve='';	";
				$res=mysqli_query($db, $sql);


				if(mysqli_num_rows($res)==0)
				{
					echo ("<h2><b>");
					echo"暂无借阅书籍.";
					echo ("</h2></b>");
				}
				else
				{
					echo "<table class='table table-bordered'>";
						echo "<tr style='background-color: #5fc4ce'>";
						//Table header
							echo "<th>"; echo "用户名"; echo "</th>";
							echo "<th>"; echo "书籍编号"; echo "</th>";
							echo "<th>"; echo "书名"; echo "</th>";
							echo "<th>"; echo "作者"; echo "</th>";
							echo "<th>"; echo "版本"; echo "</th>";
							echo "<th>"; echo "书籍状态"; echo "</th>";
							
						echo "</tr>";
						echo "</table>";
						echo "<div class='scroll'>";
						echo "<table class='table table-bordered'>";

					while($row = mysqli_fetch_assoc($res))
					{
						echo "<tr>";
							echo "<td>"; echo $row['username']; echo "</td>";
							echo "<td>"; echo $row['bid']; echo "</td>";
							echo "<td>"; echo $row['name']; echo "</td>";
							echo "<td>"; echo $row['authors']; echo "</td>";
							echo "<td>"; echo $row['edition']; echo "</td>";
							echo "<td>"; echo $row['status']; echo "</td>";						
						echo "</tr>";
					}
					echo "</table>";
				}
			}
			else
			{
				?>
					<h4 style="text-align: center; color:yellow">您需要登录才能查阅书籍请求！</h4>
					
				<?php
			}
			if(isset($_POST['submit']))
			{
					$_SESSION['name']=$_POST['username'];
					$_SESSION['bid']=$_POST['bid'];
					?>
							<script type="text/javascript">
								window.location="approve.php"
							</script>

					<?php
			}
		?>
		</div>
</div>
</body>
</html>