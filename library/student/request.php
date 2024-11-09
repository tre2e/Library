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
			padding-left: 1000px;
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
.container
{
	margin-left: 100px;
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
	  <div class="h"><a href="request.php">需要的书</a></div>
	  <div class="h"><a href="issue_info.php">借阅详情</a></div>
	  <div class="h"><a href="expired.php">已借详情</a></div>
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
<?php
	if(isset($_SESSION['login_user']))
		{
			$q=mysqli_query($db, "SELECT * FROM issue_book where username='$_SESSION[login_user]';");
			if(mysqli_num_rows($q)==0)
			{
				echo("</br>");
				echo ("<h2><b>");
				echo"暂无借阅书籍.";
				echo ("</h2></b>");
			}
			else
			{
				echo "<table class='table table-bordered table-hover'>";
				echo "<tr style='background-color: #5fc4ce'>";
				//Table header
					echo "<th>"; echo "书籍编号"; echo "</th>";
					echo "<th>"; echo "批准状态"; echo "</th>";
					echo "<th>"; echo "借阅日期"; echo "</th>";
					echo "<th>"; echo "归还日期"; echo "</th>";
				echo "</tr>";

			while($row = mysqli_fetch_assoc($q))
			{
				echo "<tr>";
					echo "<td>"; echo $row['bid']; echo "</td>";
					echo "<td>"; echo $row['approve']; echo "</td>";
					echo "<td>"; echo $row['issue']; echo "</td>";
					echo "<td>"; echo $row['return']; echo "</td>";
					

				echo "</tr>";
			}
			echo "</table>";
			}
		}
		else
		{
			echo "</br></br></br>";
			echo "<h2><b>";
			echo "请您先登录,再查看借阅书单";
			echo "</b></h2>";
		}

	?>
</div>
</body>
</html>