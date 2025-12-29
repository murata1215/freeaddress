<?php
	$id="";
	$manage="";
	$dt="";

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	if(isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	if(isset($_GET['manage'])) {
		$manage = $_GET['manage'];
	}
	if(isset($_POST['manage'])) {
		$manage = $_POST['manage'];
	}
	if(isset($_GET['password'])) {
		$password = $_GET['password'];
	}
	if(isset($_POST['password'])) {
		$password = $_POST['password'];
	}
	// 前日変数 前日を参照する場合、－１されていく
	if(isset($_GET['dt'])) {
		$dt = $_GET['dt'];
	}
	if(isset($_POST['dt'])) {
		$dt = $_POST['dt'];
	}

	$param = new param();
	$company = $param->getParam($id, "COMPANY");

	echo "<font face='ＭＳ Ｐゴシック' size='5'><CENTER><B>".$company."</B></CENTER></font>";

	echo "<input type='text' id='id' name='id' style='display:none' value='{$id}'>";
	echo "<input type='text' id='manage' name='manage' style='display:none' value='{$manage}'>";
	echo "<input type='text' id='password' name='password' style='display:none' value='{$password}'>";
	echo "<input type='text' id='dt' name='dt' style='display:none' value='{$dt}'>";

	echo "<div id='NONE_DIV' style='display:none'>";
	echo "	<H1>フリーアドレスシステムを表示しようとしていますが、ＵＲＬが正しくないようです</H1>";
	echo "</div>";
	echo "<div id='ALL_DIV' style='display:none'>";


?>
