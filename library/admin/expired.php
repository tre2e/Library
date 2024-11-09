<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Expired Books</title>
	<style type="text/css">
.srch
{
	padding-left: 75%;
	margin-top: 10px;
}
.form-control
{
	width: 200px;
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
  padding-left: 10px;
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
	height: 650px;
	width: 80%;
	background-color: black;
	color: white;
	opacity: .8;
	margin-top: -63px;
}
.scroll
{
	width: 100%;
	height: 300px;
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
		
		<?php
			if(isset($_SESSION['login_user']))
			{
				?>
				<div style="float: left; padding: 25px;">
					<form method="post" action="">
					<button name="submit2" class="btn btn-default">已还</button>&nbsp&nbsp
					<button name="submit3" class="btn btn-default">逾期</button>
					</form>
				</div>

					<div class="srch">
						<form method="post" action="" name="form1">
							<input type="text" name="username" class="form-control" placeholder="用户名" required=""><br>
							<input type="text" name="bid" class="form-control" placeholder="书籍编号" required=""><br>
							<button class="btn btn-default" name="submit" type="submit">还书</button><br>
						</form>
					</div>
				<?php

				if(isset($_POST['submit']))
				{
					$var1='<p style="color: green; background-color:yellow;">已还</p>';
					mysqli_query($db, "UPDATE issue_book SET approve='$var1' WHERE username='$_POST[username]' and bid='$_POST[bid]'; ");

					mysqli_query($db, "UPDATE	books SET quantity=quantity + 1 WHERE bid='$_POST[bid]' ");
				}
			}

		?>
		<h3 style="text-align: center;">还书详情列表</h3><br><br>

		<?php

			$c=0;
			if(isset($_SESSION['login_user']))
			{		
					$ret='<p style="color: green; background-color:yellow;">已还</p>';	
					$exp='<p style="color: red; background-color:yellow;">逾期</p>';

				  if(isset($_POST['submit2']))
				  {
				  	$sql="SELECT student.username,books.bid,name,authors,edition,approve,issue,issue_book.return FROM student inner join issue_book ON student.username=issue_book.username inner join books ON issue_book.bid=books.bid WHERE issue_book.approve ='$ret' and issue_book.approve!='同意' ORDER BY `issue_book`.`return` DESC;";
				  	$res=mysqli_query($db, $sql);

				  }
				  else if(isset($_POST['submit3']))
				  {
				  	$sql="SELECT student.username,books.bid,name,authors,edition,approve,issue,issue_book.return FROM student inner join issue_book ON student.username=issue_book.username inner join books ON issue_book.bid=books.bid WHERE issue_book.approve ='$exp' ORDER BY `issue_book`.`return` DESC;";
				  	$res=mysqli_query($db, $sql);

				  }
				  else
				  {
				  	$var='<p style="color: red; background-color:yellow;">逾期</p>';
				  $sql="SELECT student.username,books.bid,name,authors,edition,approve,issue,issue_book.return FROM student inner join issue_book ON student.username=issue_book.username inner join books ON issue_book.bid=books.bid WHERE issue_book.approve!='' and issue_book.approve!='同意' ORDER BY `issue_book`.`return` DESC;";
				  $res=mysqli_query($db, $sql);

				  }

				  	echo "<table class='table table-bordered'>";
						echo "<tr style='background-color: #5fc4ce'>";
						//Table header
							
							echo "<th>"; echo "用户名"; echo "</th>";
							echo "<th>"; echo "书籍编号"; echo "</th>";
							echo "<th>"; echo "书名"; echo "</th>";
							echo "<th>"; echo "作者"; echo "</th>";
							echo "<th>"; echo "版本"; echo "</th>";
							echo "<th>"; echo "借阅状态"; echo "</th>";
							echo "<th>"; echo "借出日期"; echo "</th>";
							echo "<th>"; echo "归还日期"; echo "</th>";
							
						echo "</tr>";
						echo "</table>";

						echo "<div class='scroll'>";
				  	echo "<table class='table table-bordered'>";

					while($row = mysqli_fetch_assoc($res))
					{
						$d=date("Y-m-d");
						if($d > $row['return'])
						{
							$c=$c+1;
							$var='<p style="color: red; background-color:yellow;">逾期</p>';

							mysqli_query($db, "UPDATE issue_book SET approve='$var' WHERE `return`='$row[return]' and approve='同意' limit $c;");

						}						

						echo "<tr>";
							echo "<td>"; echo $row['username']; echo "</td>";
							echo "<td>"; echo $row['bid']; echo "</td>";
							echo "<td>"; echo $row['name']; echo "</td>";
							echo "<td>"; echo $row['authors']; echo "</td>";
							echo "<td>"; echo $row['edition']; echo "</td>";
							echo "<td>"; echo $row['approve']; echo "</td>";
							echo "<td>"; echo $row['issue']; echo "</td>";
							echo "<td>"; echo $row['return']; echo "</td>";							
						echo "</tr>";
					}					
					
					echo "</table>";
					echo "</div>";

			}
			else
			{
				 ?>
					<h3 style="text-align: center; color:yellow">您需要登录才能查阅详情！</h3>
					
				<?php
			}

		?>

	</div>


</div>
</body>
</html>