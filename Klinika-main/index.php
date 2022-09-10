<!DOCTYPE html>
<html>
<body style="background-image:url(images/p2.jpg)">
<link rel="stylesheet" href="main.css">
			<div class="header">
				<ul>
					<li style="float:left;border-right:none"><a href="index.php" class="logo"><img src="images/cal.png" width="30px" height="30px"><strong> Klinika </strong>Szybko i bezboleśnie</a></li>
					<li><a href="locateus.php">Lokalizacja</a></li>
					<li><a href="#home">Start</a></li>
				</ul>
			</div>
			<div class="center">
				<h1>Klinika ONLINE</h1><br>
				<p style="text-align:center;color:white;font-size:30px;top:35%">Webowa klinika internetowa</p><br>
				<button onclick="document.getElementById('id01').style.display='block'" style="position:absolute;top:50%;left:50%">Zaloguj</button>
				
			</div>	
			<div class="footer">
				<ul style="position:absolute;top:93%;background-color:black">
					<li><a href="admin/alogin.php">Admin Login</a></li>
					<li><a href="admin/mlogin.php">Recepcja Login</a></li>
				</ul>
			</div>
<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post" action="index.php">
    <div class="imgcontainer">
		<span style="float:left"><h2>&nbsp&nbsp&nbsp&nbspZaloguj</h2></span>
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
	
    <div class="container">
      <label><b>Nazwa</b></label>
      <input type="text" placeholder="Wpisz Nazwę użytkownika" name="uname" required>

      <label><b>Hasło</b></label>
      <input type="password" placeholder="Wpisz hasło" name="psw" required>
		<button type="submit" name="login">Zaloguj</button>
		
      <input type="checkbox" checked="checked"> Zapamiętaj mnie
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Anuluj</button>
      <button onclick="document.getElementById('id02').style.display='block';document.getElementById('id01').style.display='none'" style="float:right">Zarejestruj się!</button>
    </div>
  </form>
</div>

<div id="id02" class="modal">
  
  <form class="modal-content animate" action="signup.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span><br>
    </div>

	<div class="imgcontainer">
      <img src="images/steps.png" alt="Avatar" class="avatar">
    </div>
	
   <div class="container">
		<p style="text-align:center;font-size:18px;"><b>Zarejestruj się szybko i wygodnie!</b></p>
      <p style="text-align:center"><b>Po rejestracji wybierz termin wizyty i czekaj na telefon</b></p>
	  
    </div>
	
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Anuluj</button>
	  <button type="submit" name="signup" style="float:right">Rejestracja</button>
    </div>
	
  </form>
</div>


<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}

</script>
<?php
session_start();
$error=''; 
if (isset($_POST['login'])) {
if (empty($_POST['uname']) || empty($_POST['psw'])) {
$error = "Login albo hasło niepoprawne";
}
else
{
	include 'dbconfig.php';
	$username=$_POST['uname'];
	$password=$_POST['psw'];

	$query = mysqli_query($conn,"select * from patient where password='$password' AND username='$username'");
	$rows = mysqli_fetch_assoc($query);
	$num=mysqli_num_rows($query);
	if ($num == 1) {
		$_SESSION['username']=$rows['username'];
		$_SESSION['user']=$rows['name'];
		header( "Refresh:1; url=ulogin.php"); 
	} 
	else 
	{
		$error = "Login albo hasło niepoprawne";
	}
	mysqli_close($conn); 
}
}
?>
</body>
</html>
