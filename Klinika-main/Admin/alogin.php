<!DOCTYPE html>
<html>
<body style="background-image:url(../images/mgrchange.jpg)">
<link rel="stylesheet" href="main.css">
	<form action="alogin.php" method="post">
	<div class="header">
				<ul>
					<li style="float:left;border-right:none"><strong> Admin</strong></li>
					<li><a href="../index.php">Start</a></li>
				</ul>
	</div>
	<div class="sucontainer">
		<label><b>Nazwa użytkownika:</b></label><br>
		<input type="text" placeholder="Wpisz nazwę" name="uname" required><br>
	
		<label><b>Hasło:</b></label><br>
		<input type="password" placeholder="Hasło" name="pass" required><br><br>
		
		<div class="container" style="background-color:grey">
			<button type="submit" name="submit" style="float:right">Zaloguj</button>
		</div>
<?php 
function SignIn() 
{ 
session_start();
 {  
	if($_POST['uname']=='admin' && $_POST['pass']=='admin') 
	{ 
		$_SESSION['userName'] = 'admin'; 
		echo "Witaj!";
		header( "Refresh:2; url=mainpage.php");
	} 
	else { 
		echo "Złe dane!"; 
		} 
	}
	} 
	if(isset($_POST['submit'])) 
	{ 
		SignIn(); 
	} 
?>
</body>
</html>