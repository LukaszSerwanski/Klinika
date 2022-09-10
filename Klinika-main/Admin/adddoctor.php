<html>
<head>
<link rel="stylesheet" href="adminmain.css"> 
</head>
<body background= "../images/doctordesk.jpg">
<ul>
<li class="dropdown"><font color="yellow" size="10">ADMIN</font></li>
<br>
<h2>
  <li class="dropdown">    
  <a href="javascript:void(0)" class="dropbtn">Doktor</a>
    <div class="dropdown-content">
      <a href="adddoctor.php">Dodaj Doktora</a>
      <a href="deletedoctor.php">Usuń Doktora</a>
      <a href="showdoctor.php">Pokaż Doktorów</a>
	  <a href="showdoctorschedule.php">Pokaż grafik Doktorów</a>
    </div>
  </li>
  
  <li class="dropdown">
  <a href="javascript:void(0)" class="dropbtn">Klinika</a>
    <div class="dropdown-content">
      <a href="addclinic.php">Dodaj Klinikę</a>
      <a href="deleteclinic.php">Usuń Klinikę</a>
      <a href="adddoctorclinic.php">Przypisz Doktora do Kliniki</a>
	  <a href="addmanagerclinic.php">Przypisz Recepcjonistę do Kliniki</a>
	  <a href="deletedoctorclinic.php">Usuń Doktora z Kliniki</a>
	  <a href="deletemanagerclinic.php">Usuń Recepcjonistę z Kliniki</a>
	  <a href="showclinic.php">Pokaż Kliniki</a>
    </div>
  </li>
  <li class="dropdown">    
  <a href="javascript:void(0)" class="dropbtn">Recepcjonista</a>
    <div class="dropdown-content">
      <a href="addmanager.php">Dodaj Recepcjonistę</a>
      <a href="deletemanager.php">Usuń recepcjonistę</a>
	  <a href="showmanager.php">Pokaż Recepcjonistę</a>
    </div>
  </li>
  
    <li>  
	<form method="post" action="mainpage.php">	
	<button type="submit" class="cancelbtn" name="logout" style="float:right;font-size:22px"><b>Wyloguj</b></button>
	</form>
  </li>
	
</ul>
</h2>
<center><h1>DODAJ DOKTORA</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  NumerID:<input type="number" name="did" required>
  <br>
  Imię i nazwisko: <input type="text" name="name" required>
  <br>
  Płeć:
  <input type="radio" name="gender" value="female">Kobieta
  <input type="radio" name="gender" value="male">Mężczyzna
  <br>
  Data urodzenia: <input type="date" name="dob" required>
  <br>
  Doświadczenie: <input type ="number" name="experience" required>
  <br>
  Specjalizacja:<input type="text" name="specialization" required>
  <br>
  Kontakt.: <input type="number" name="contact" maxlength="10" minlength="10" required>
  <br>
  Adres: <input type="text" name="address" required>
  <br>
  Nazwa użytkownika: <input type="text" name="username" required>
  <br>
  Hasło: <input type="password" name="pwd" required>
  <br>
  Region: <input type="text" name="region" required>
  <br>
  
  <button type="submit" name="Submit">Rejestruj</button>
</form>
</font></b>
</center>
<?php
session_start();
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=alogin.php"); 
	}
function newUser()
{
	include 'dbconfig.php';
		$did=$_POST['did'];
		$name=$_POST['name'];
		$gender=$_POST['gender'];
		$dob=$_POST['dob'];
		$experience=$_POST['experience'];
		$specialization=$_POST['specialization'];
		$contact=$_POST['contact'];
		$address=$_POST['address'];
		$username=$_POST['username'];
		$password=$_POST['pwd'];
		$region=$_POST['region'];
		$sql = "INSERT INTO doctor (DID, Name, Gender, DOB, Experience, Specialization, Contact,Address,Username,Password,Region) VALUES ('$did','$name','$gender','$dob','$experience','$specialization','$contact','$address','$username','$password','$region') ";

	if (mysqli_query($conn, $sql)) 
	{
		echo "<h2>Zarejestrowano pomyślnie!!</h2>";
		header( "Refresh:2; url=adddoctor.php");

	} 
	else
	{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
function checkdid()
{
	include 'dbconfig.php';
	$did=$_POST['did'];
	$sql= "SELECT * FROM doctor WHERE DID = '$did'";

	$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)!=0)
       {
			echo"<b><br>Numer ID jest zajęty !!";
       }
	else 
		if(isset($_POST['Submit']))
	{ 
		newUser();
	}

	
}
function checkusername()
{
	include 'dbconfig.php';
	$usn=$_POST['username'];
	$sql= "SELECT * FROM doctor WHERE Username = '$usn'";

	$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)!=0)
       {
			echo"<b><br>Nazwa użytkownika zajęta!!";
       }
	else 
		if(isset($_POST['Submit']))
	{ 
		checkdid();
	}

	
}
if(isset($_POST['Submit']))
{
	if(!empty($_POST['did']) && !empty($_POST['username']) && !empty($_POST['pwd'])&& !empty($_POST['region']) &&!empty($_POST['experience']) &&!empty($_POST['specialization']) &&!empty($_POST['name']) &&!empty($_POST['dob'])&& !empty($_POST['gender']) &&!empty($_POST['address']) && !empty($_POST['contact']))
		checkusername();
	else
		echo "Pozostały puste miejsca!";
}

?>

</body>
</html>