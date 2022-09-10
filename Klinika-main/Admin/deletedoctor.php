<!DOCTYPE html>
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
<h1>
<center><h1>USUŃ DOKTORA</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
Wpisz ID doktora:<center><input type="number" name="did"></center>
			<button type="submit" name="Submit1">Usuń przez ID</button>
			<br>---------LUB---------<br>
Wpisz Imię i nazwisko:<br><?php
				require_once('dbconfig.php');
				$doctor_result = $conn->query('select * from doctor order by DID ASC');
				?>
				<center>
				<select name="doctorname">
				<option value="">---Wybierz Doktora---</option>
				<?php
				if ($doctor_result->num_rows > 0) {
				while($row = $doctor_result->fetch_assoc()) {
				?>
				<option value="<?php echo $row["DID"]; ?>"><?php echo "(DID= $row[DID]) Dr. ".$row["Name"]; ?></option>
				<?php
					}
					}
				?>
				</select></center>
				
				<button type="submit" name="Submit2">Usuń przez Nazwę</button>
</form>			
<?php
session_start();
include 'dbconfig.php';
if(isset($_POST['Submit1']))
{
	$did=$_POST['did'];
	$sql = "DELETE FROM doctor WHERE DID= $did ";
	$sqlda = "DELETE FROM doctor_availability WHERE DID= $did ";
	if (mysqli_query($conn, $sql))
		{
		echo "Usunięto pomyślnie. Odświeżanie....";
		header( "Refresh:2; url=deletedoctor.php");
		}
	else
		{
			echo "Błąd: " . mysqli_error($conn);
		}
		
	if (mysqli_query($conn, $sqlda))
	{
		echo "Usunięto pomyślnie. Odświeżanie....";
		header( "Refresh:2; url=deletedoctor.php");
		}
	else
		{
			echo "Błąd: " . mysqli_error($conn);
		}
}
if(isset($_POST['Submit2']))
{
	$did=$_POST['doctorname'];
	$sql = "DELETE FROM doctor WHERE did = $did ";
	$sqlda = "DELETE FROM doctor_availability WHERE DID= $did ";
	if (mysqli_query($conn, $sql))
	{
		echo "Usunięto pomyślnie. Odświeżanie....";
		header( "Refresh:2; url=deletedoctor.php");
		}
	else
		{
			echo "Błąd: " . mysqli_error($conn);
		}
	if (mysqli_query($conn, $sqlda))
	{
		echo "Usunięto pomyślnie. Odświeżanie....";
		header( "Refresh:2; url=deletedoctor.php");
		}
	else
		{
			echo "Błąd: " . mysqli_error($conn);
		}
}	
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=alogin.php"); 
	}
?>			
</body>
</html>