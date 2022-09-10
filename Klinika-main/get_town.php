<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nieznany dokument</title>
</head>
<script type="text/javascript"></script>
<body>
<?php
require_once("dbconfig.php");
	$query ="SELECT * FROM clinic WHERE City = '" . $_POST["countryid"] . "'";
	$results = $conn->query($query);
?>
	<option value="">Wybierz Miasto</option>
<?php
	while($rs=$results->fetch_assoc()) {
?>
	<option value="<?php echo $rs["town"];?>"><?php echo $rs["town"]; ?></option>
<?php

}
?>
</body>
</html>