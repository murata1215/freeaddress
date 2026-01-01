<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス 離籍</title></head>
<body>
<form action="seat.php">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>



<style type="text/css">
	input.example1 {
	font-size:  80pt;
	height:     150;
	width:      20%;
	padding-top:50px;
	color:		red;
	text-align: left;
	border-style:none;
	}
	
	input.example2 {
	font-size:  50pt;
	height:     120;
	width:      30%;
	border-style: none;
	}
	
	input.tenKey {
	font-size:  50pt;
	height:     100%;
	width:      100%;
	}
	
	td.td1{
	font-size:  50pt;
	text-align: center;
	height:     120;
	width:      80%;
	padding:       .1em 0 .5em .1em;
	border-left:   20px solid #3498db;
	border-bottom: 2px solid #ccc;
	}
	
	td.tdx{
	font-size:  40pt;
	text-align: center;
	height:     80;
	width:      10%;
	}
	
	td.td3{
	font-size:  40pt;
	text-align: center;
	height:     80;
	width:      100%;
	}
	
	
</style>
<script type="text/javascript"><!--
function close_window(){
window.open('about:blank','_self').close();
} 
// --></script>



<table height="150px"><tr><td></td></tr></table>
	<table align="center" width="100%">
	<tr>
		<td class="tdx"></td>
		<td class="td1">




<?php
$dao = new db();
$dao->connect();

$date = date("Ymd");

if(isset($_GET['mid'])) {
	$mid = $_GET['mid'];
}

$sql = "";
$sql = $sql." select delkb,id,upper(seatid) as seatid from alloc where id='".$id."' and dt='".$date."' AND mid='".$mid."' ";
$dao->select($sql);
//var_dump($sql);


if ($dao->next()){

	$delkb = $dao->get("DELKB");
	$idid = $dao->get("ID");
	$kettei_seatid = $dao->get("SEATID");

	if ( strcmp($delkb,"D") == 0 ) {

		echo "すでに退席済みです";

	} else {

		$sql = " update alloc set delkb='d' where id='".$id."' and dt='".$date."' and mid='".$mid."' ";
		$dao->exec($sql);
		echo $name."今日の席 ".$kettei_seatid." を開放しました";

	}

} else {

	echo $mid."今日は席が抽選されていません";


}



$dao->close();

?>



</td>
		<td class="tdx"></td>
	</tr>
	<tr>
		<td colspan="3" align="center" class="td3">
			<br>
			<input type="submit" class="example2" value="閉じる" onclick="close_window();"/>
		</td>
	</tr>
</table>


<?php require "framework_tail.php"; ?>
</form>
</body>
</html>

