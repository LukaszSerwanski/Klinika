<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="adminmain.css"> 
</head>
<body background= "../images/mgrchange.jpg">
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
<center><h1>USUŃ KLINIKE</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
Wpisz CID:<center><input type="number" name="cid"></center>
			<button type="submit" name="Submit1">Usuń po ID</button>
			<br>---------LUB---------<br>
Wpisz nazwę kliniki:<br><?php
				require_once('dbconfig.php');
				$clinic_result = $conn->query('select * from clinic order by City,Town,CID ASC');
				?>
				<center>
				<select name="clinicname">
				<option value="">---Wybierz nazwę---</option>
				<?php
				if ($clinic_result->num_rows > 0) {
				while($row = $clinic_result->fetch_assoc()) {
				?>
				<option value="<?php echo $row["CID"]; ?>"><?php echo $row["Name"].", ".$row["Town"].", ".$row["City"].",(".$row["Address"].")"."(CID=".$row["CID"].")"; ?></option>
				<?php
					}
					}
				?>
				</select></center>
				
				<button type="submit" name="Submit2">Usuń po nazwie</button>
</form>			
<?php
session_start();
include 'dbconfig.php';
if(isset($_POST['Submit1']))
{
	$cid=$_POST['cid'];
	$sql = "DELETE FROM clinic WHERE CID= $cid ";

	if (mysqli_query($conn, $sql))
		{
		echo "Usunięto pomyślnie!";
		header( "Refresh:2; url=deleteclinic.php");
		}
	else
		{
			echo "Błąd: " . mysqli_error($conn);
		}

}
if(isset($_POST['Submit2']))
{
	$cid=$_POST['clinicname'];
	$sql = "DELETE FROM clinic WHERE cid = $cid ";

	if (mysqli_query($conn, $sql))
		{
			echo "Usunięto pomyślnie!";
			header( "Refresh:2; url=deleteclinic.php");
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