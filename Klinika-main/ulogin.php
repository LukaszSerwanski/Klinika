<html>
<head>
	<link rel="stylesheet" href="main.css">
</head>
<body style="background-image:url(images/cancelback.jpg)">
<div class="header">
				<ul>
					<li style="float:left;border-right:none"><strong><?php session_start(); echo $_SESSION['user']; ?></strong></li>
					<li><a href="ulocateus.php">Lokalizacja</a></li>
				</ul>
</div>
<div class="container" style="width:100%">
	<div class="container">
	<form method="post">
      <button type="button" onclick="window.location.href='book.php'" style="background-color:#2B4F76">Rejestracja na wizytę</button>
	  <button type="button" onclick="window.location.href='viewpatientappointments.php'" style="background-color:#2B4F76">Pokaż wizyty</button>
	  <button type="submit" name="cancel" style="float:center;background-color:#2B4F76">Anuluj Wizytę</button>
	  <button type="submit" name="logout" style="float:right;background-color:#2B4F76">Wyloguj</button>
	</form>
    </div>
</div>
<?php
if(isset($_POST['check']))
{
		include 'dbconfig.php';
		$name=$_SESSION['user'];
		$sql = "Select * from book where name='$name'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($rows = mysqli_fetch_assoc($result)) 
			{
				echo "Username:".$rows["username"]."Name:".$rows["name"]."Date of Visit:".$rows["dov"]."Town:".$rows["town"]."<br>";
			}
		} 
		else 
		{
			echo "0 results";
		}
}
if(isset($_POST['cancel']))
{
	header( "Refresh:1; url=cancelbookingpatient.php"); 
}
if(isset($_POST['logout']))
{
	session_unset();
	session_destroy();
	header( "Refresh:1; url=index.php"); 
}
?>
</body>
</html>