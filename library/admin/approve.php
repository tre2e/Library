<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Approve Request</title>
	<style type="text/css">
.srch
{
	padding-left: 1000px;
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
	color: whitesmoke;
	opacity: .8;
	
}
.Approve
{
	margin-left: 420px;
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
	  <div class="h"><a href="expired.php">逾期列表</a></div>

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
			<h3 style="text-align: center;">借阅请求</h3><br><br>

			<form class="Approve" action="" method="post">
				  <input class="form-control" type="text" name="approve" placeholder="同意或不同意" required=""><br><br>

				  <input class="form-control" type="text" name="issue" placeholder="出借日期 20xx-xx-xx" required=""><br><br>

					<input class="form-control" type="text" name="return" placeholder="归还日期20xx-xx-xx" required=""><br><br>

					<div style="margin-left: 120px;"><button class="btn btn-default" type="submit" name="submit" >批奏</button></div>
			</form>
	</div>
</div>

	<?php

		if(isset($_POST['submit']))
		{
			mysqli_query($db, "UPDATE `issue_book` SET `approve`='$_POST[approve]', `issue`='$_POST[issue]', `return`='$_POST[return]' WHERE username='$_SESSION[name]' AND bid='$_SESSION[bid]' ;");

			mysqli_query($db, "UPDATE books SET quantity=quantity-1 WHERE bid='$_SESSION[bid]' ;");

			$res=mysqli_query($db,"SELECT quantity FROM books WHERE bid='$_SESSION[bid]' ;");

			while($row=mysqli_fetch_assoc($res))
			{
				if($row['quantity']==0)
				{
					mysqli_query($db, "UPDATE books SET status='已借出' where bid='$_SESSION[bid]' ;");
				}
			}
			?>
				<script type="text/javascript">
					alert("更新成功！");
					window.location="request.php"
				</script>

			<?php
		}

	?>

</body>
</html>