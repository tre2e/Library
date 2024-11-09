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
	background-color: #d7cd01;
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
.book
{
	width: 400px;
	margin: 0 auto;
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
	</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
  <div class="container" style="text-align: center;">
  	<h2 style="color: black;font-family: Lucida Console; text-align: center;">添加书籍</h2>

  	<form class="book" action="" method="post">
  		<input type="" name="bid" class="form-control" placeholder="书籍编号" required=""><br>
  		<input type="text" name="name" class="form-control" placeholder="书名" required=""><br>
  		<input type="" name="authors" class="form-control" placeholder="作者名" required=""><br>
  		<input type="" name="edition" class="form-control" placeholder="版本" required=""><br>
  		<input type="" name="status" class="form-control" placeholder="书籍状态" required=""><br>
  		<input type="" name="quantity" class="form-control" placeholder="数目" required=""><br>
  		<input type="" name="apartment" class="form-control" placeholder="所属科类" required=""><br>
  		
  		<button style="text-align: center;" class="btn btn-default" type="submit" name="submit">添加</button>
  	</form>
  </div>
 <?php
 		if(isset($_POST['submit']))
 		{
 			if(isset($_SESSION['login_user']))
 			{
 				mysqli_query($db,"INSERT INTO books VALUES ('$_POST[bid]', '$_POST[name]', '$_POST[authors]', '$_POST[edition]', '$_POST[status]', '$_POST[quantity]', '$_POST[apartment]');");
 				?>

 					<script type="text/javascript">
 						alert("书籍添加成功！");
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
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "#d7cd01";
}
</script>

</body>
</html>