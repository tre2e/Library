<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Books</title>
	<style type="text/css">
.srch
{
	padding-left: 900px;
}
body {
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
	  <div class="h"><a href="add.php">添加书籍</a></div>
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
	<!--______________________search bar_______________________-->

		<div class="srch">
			<form class="navbar-form" method="post" name="form1">
				
					<input class="form-control" type="text" name="search" placeholder="搜索书目...">
					<button style="background-color: #5fc4ce;" type="submit" name="submit" class="btn btn-default">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				
			</form>
			<form class="navbar-form" method="post" name="form1">
				
					<input class="form-control" type="text" name="bid" placeholder="输入书籍编号">
					<button style="background-color: #5fc4ce;" type="submit" name="submit1" class="btn btn-default">删除该书籍
					</button>
				
			</form>
		</div>


		<h2>图书列表</h2>
		<?php

			if(isset($_POST['submit']))
			{
				$q=mysqli_query($db, "SELECT * FROM books where name like '%$_POST[search]%'");
				if(mysqli_num_rows($q)==0)
				{
					echo"Sorry! No book found. Try searching again.";
				}
				else
				{
				echo "<table class='table table-bordered table-hover'>";
				echo "<tr style='background-color: #5fc4ce'>";
					//Table header
					echo "<th>"; echo "书籍编号"; echo "</th>";
					echo "<th>"; echo "书名"; echo "</th>";
					echo "<th>"; echo "作者"; echo "</th>";
					echo "<th>"; echo "版本"; echo "</th>";
					echo "<th>"; echo "书籍状态"; echo "</th>";
					echo "<th>"; echo "数量"; echo "</th>";
					echo "<th>"; echo "所属科类"; echo "</th>";
				echo "</tr>";

				while($row = mysqli_fetch_assoc($q))
				{
					echo "<tr>";
					echo "<td>"; echo $row['bid']; echo "</td>";
					echo "<td>"; echo $row['name']; echo "</td>";
					echo "<td>"; echo $row['authors']; echo "</td>";
					echo "<td>"; echo $row['edition']; echo "</td>";
					echo "<td>"; echo $row['status']; echo "</td>";
					echo "<td>"; echo $row['quantity']; echo "</td>";
					echo "<td>"; echo $row['department']; echo "</td>";

					echo "</tr>";
				}
				echo "</table>";
				}
			}

			/* If button is not pressed.*/
			else
			{
				//query order
			$res = mysqli_query($db, "SELECT * FROM `books`;");

			echo "<table class='table table-bordered table-hover'>";
			echo "<tr style='background-color: #5fc4ce'>";
				//Table header
				echo "<th>"; echo "书籍编号"; echo "</th>";
				echo "<th>"; echo "书名"; echo "</th>";
				echo "<th>"; echo "作者"; echo "</th>";
				echo "<th>"; echo "版本"; echo "</th>";
				echo "<th>"; echo "书籍状态"; echo "</th>";
				echo "<th>"; echo "数量"; echo "</th>";
				echo "<th>"; echo "所属科类"; echo "</th>";
			echo "</tr>";

			while($row = mysqli_fetch_assoc($res))
			{
				echo "<tr>";
				echo "<td>"; echo $row['bid']; echo "</td>";
				echo "<td>"; echo $row['name']; echo "</td>";
				echo "<td>"; echo $row['authors']; echo "</td>";
				echo "<td>"; echo $row['edition']; echo "</td>";
				echo "<td>"; echo $row['status']; echo "</td>";
				echo "<td>"; echo $row['quantity']; echo "</td>";
				echo "<td>"; echo $row['department']; echo "</td>";

				echo "</tr>";
			}
			echo "</tr>";
			}
			if(isset($_POST['submit1']))
			{
				if(isset($_SESSION['login_user']))
				{
					mysqli_query($db, "DELETE from books where bid='$_POST[bid]';" );
					?>
						<script type="text/javascript">
							alert("书籍删除成功！");
						</script>
					<?php
				}
				else
				{
					?>
						<script type="text/javascript">
							alert("您需要先登录.");
						</script>
					<?php
				}
			}
			
		?>
</div>		
</body>
</html>
