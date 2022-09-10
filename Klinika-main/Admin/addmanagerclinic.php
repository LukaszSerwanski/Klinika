<html>
<head>
<script src="jquerypart.js" type="text/javascript"></script>
<link rel="stylesheet" href="adminmain.css"> 
<script>
function getState(val) {
	$.ajax({
	type: "POST",
	url: "getclinic.php",
	data:'city='+val,
	success: function(data){
		$("#clinic-list").html(data);
	}
	});
}
function getManagerRegion(val) {
	$.ajax({
	type: "POST",
	url: "getmanagerregion.php",
	data:'city='+val,
	success: function(data){
		$("#manager-list").html(data);
	}
	});
}

</script>
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
<center><h1>PRZYPISZ RECEPCJONISTE DO KLINIKI</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<label style="font-size:20px" >Miasto:</label>
		<select name="city" id="city-list" class="demoInputBox"  onChange="getState(this.value);getManagerRegion(this.value);">
		<option value="">Wybierz miasto</option>
		<?php
		include 'dbconfig.php';
		$sql1="SELECT distinct City FROM clinic";
         $results=$conn->query($sql1); 
		while($rs=$results->fetch_assoc()) { 
		?>
		<option value="<?php echo $rs["City"]; ?>"><?php echo $rs["City"]; ?></option>
		<?php
		}
		?>
		</select>
        
	
		<label style="font-size:20px" >Klinika:</label>
		<select id="clinic-list" name="clinic" >
		<option value="">Wybierz Klinike</option>
		</select>
		
		<label style="font-size:20px" >Recepcjonista:</label>
		<select name="manager" id="manager-list">
		<option value="">Wybierz Recepcjoniste</option>
		</select>

		<button name="Submit" type="submit">Wyślij</button>
	</form>
<?php
session_start();
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=alogin.php"); 
	}
if(isset($_POST['Submit']))
{
		include 'dbconfig.php';
		$cid=$_POST['clinic'];
		$mid=$_POST['manager'];
		
				$sql = "INSERT INTO manager_clinic (CID, MID) VALUES ('$cid','$mid')";
				$sql1="update clinic set MID=$mid where CID=$cid";
				if (mysqli_query($conn, $sql)) 
				{
							echo "<h2>Stworzono pomyślnie( CID=$cid MID=$mid )!!</h2>";
							echo "Proszę czekać, Ładowanie...";
							header( "Refresh:2; url=addmanagerclinic.php");

				} 
				else
				{
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
				if (mysqli_query($conn, $sql1)) 
				{
					echo "<h2>Stworzono pomyślnie( CID=$cid MID=$mid )!!</h2>";
					echo "Proszę czekać, Ładowanie...";
					header( "Refresh:2; url=addmanagerclinic.php");

		} 
				else
				{
					echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
				}
				
}

?>

</body>
</html>