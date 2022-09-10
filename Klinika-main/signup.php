<html>
<head>
	<link rel="stylesheet" href="main.css">
</head>
<body style="background-image:url(images/p2.jpg)">
<div class="header">
				<ul>
				<li style="float:left;border-right:none"><a href="index.php" class="logo"><img src="images/cal.png" width="30px" height="30px"><strong> Klinika </strong>Szybko i bezboleśnie</a></li>
					<li><a href="locateus.php">Lokalizacja</a></li>
					<li><a href="#home">Start</a></li>
				</ul>
</div>
<form action="signup.php" method="post">
	<div class="sucontainer">
		<label><b>Imię i Nazwisko:</b></label><br>
		<input type="text" placeholder="Wpisz Imię i nazwisko" name="fname" required><br>
	
		<label><b>Data urodzin:</b></label><br>
		<input type="date" name="dob" required><br><br>
	
		<label><b>Płeć</b></label><br>
		<input type="radio" name="gender" value="female">Kobieta
		<input type="radio" name="gender" value="male">Mężczyzna
		<input type="radio" name="gender" value="other">Inne<br><br>
		
		<label><b>Numer telefonu:</b></label><br>
		<input type="number" placeholder="Telefon" name="contact" required><br>
		
		<label><b>Nazwa użytkownika:</b></label><br>
		<input type="text" placeholder="Nazwa" name="username" required><br>
		
		<label><b>Email:</b></label><br>
		<input type="email" placeholder="Email" name="email" required><br>

		<label><b>Hasło:</b></label><br>
		<input type="password" placeholder="Hasło" name="pwd" id="p1" required><br>

		<label><b>Powtórz hasło:</b></label><br>
		<input type="password" placeholder="Powtórz hasło" name="pwdr" id="p2" required><br>
		<p style="color:white">Tworząc konto wyrażasz zgodę na nasz<a href="#" style="color:blue"> Regulamin.</a>.</p><br>

		<div class="container" style="background-color:grey">
			<button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Anuluj</button>
			<button type="submit" name="signup" style="float:right">Zarejestruj się</button>
		</div>
  </div>
<?php

function newUser()
{
		include 'dbconfig.php';
		$name=$_POST['fname'];
		$gender=$_POST['gender'];
		$dob=$_POST['dob'];
		$contact=$_POST['contact'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$password=$_POST['pwd'];
		$prepeat=$_POST['pwdr'];
		$sql = "INSERT INTO Patient (Name, Gender, DOB,Contact,Email,Username,Password) VALUES ('$name','$gender','$dob','$contact','$email','$username','$password') ";

	if (mysqli_query($conn, $sql)) 
	{
		echo "<h2>Zarejestrowano pomyślnie!! Przekierowywanie na stronę logowania....</h2>";
		header( "Refresh:3; url=index.php");

	} 
	else
	{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
function checkusername()
{
	include 'dbconfig.php';
	$usn=$_POST['username'];
	$sql= "SELECT * FROM Patient WHERE Username = '$username'";

	$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)!=0)
		{
			echo"<b><br>Użytkownik już istnieje!!";
		}
		else if($_POST['pwd']!=$_POST['pwdr'])
		{
			echo"Niezgodne hasło";
		}
		else if(isset($_POST['signup']))
		{ 
			newUser();
		}

	
}
if(isset($_POST['signup']))
{
	if(!empty($_POST['username']) && !empty($_POST['pwd']) &&!empty($_POST['fname']) &&!empty($_POST['dob'])&& !empty($_POST['gender']) &&!empty($_POST['email']) && !empty($_POST['contact']))
			checkusername();
}
?>

</form>
</body>
</html>