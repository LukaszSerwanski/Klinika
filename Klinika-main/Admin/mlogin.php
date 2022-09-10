<!DOCTYPE html>
<html>
<body style="background-image:url(../images/doctordesk.jpg)">
<link rel="stylesheet" href="main.css">
	<form action="mlogin.php" method="post">
	<div class="header">
				<ul>
					<li style="float:left;border-right:none"><strong> Recepcja</strong></li>
					<li><a href="../index.php">Start</a></li>
				</ul>
	</div>
	<div class="sucontainer">
		<label><b>Nazwa użytkownika:</b></label><br>
		<input type="text" placeholder="Nazwa użytkownika" name="uname" required><br>
	
		<label><b>Hasło:</b></label><br>
		<input type="password" placeholder="Hasło" name="pass" required><br><br>
		
		<div class="container" style="background-color:grey">
			<button type="submit" name="submit" style="float:right">Zaloguj</button>
		</div>
<?php 
function SignIn() 
{ 
include 'dbconfig.php';

session_start();
if(!empty($_POST['uname']))  
{ 
	$query = mysqli_query($conn,"SELECT * FROM manager where username = '$_POST[uname]' AND password = '$_POST[pass]'");
	$row = mysqli_fetch_array($query);
	if(!empty($row['username']) AND !empty($row['password'])) 
	{ 
		$_SESSION['username'] = $row['username'];
		$_SESSION['mgrname']=$row['name'];
		$_SESSION['mgrid']=$row['mid'];
		echo "Witaj!";
		header( "Refresh:2; url=mgrmenu.php");
	} 
	else 
	{ 
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