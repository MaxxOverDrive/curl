<?php

include 'arrays.php';

$db_host = '66.112.76.254';
$db_username = 'root';
$db_pass = 'adamserver5';
$db_name = 'cms';
$itemName = 'itemName';
$modelNum = 'modelNum';
$partNum = 'partNum';
$ourPrice = 'ourPrice';
$recommendedPrice = 'recommendedPrice';
$listPrice = 'listPrice';
$ourCost = 'ourCost';
$compPrice = 'compPrice';
$compMinusOurPrice = 'compMinusOurPrice';
$compDivideOurCost = 'compDivideOurCost';
$competitorName = 'competitorName';

$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

	if(!$conn) {
		die('error msg' . mysqli_connect_error());
	}
	else {
		$sql = "SELECT  manufactName FROM manufacturer ORDER BY manufactName ASC;";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0) {
			$GLOBALS["result"] = $result;
		}
		else {
			echo "No Results Found!";
		}
	}
mysqli_close($conn);
?>