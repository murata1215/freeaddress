<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>フリーアドレス 離籍</title>
<style>
:root {
	--primary-color: #2563eb;
	--primary-hover: #1d4ed8;
	--secondary-color: #64748b;
	--success-color: #059669;
	--success-bg: #ecfdf5;
	--success-border: #a7f3d0;
	--warning-color: #d97706;
	--warning-bg: #fffbeb;
	--warning-border: #fde68a;
	--danger-color: #dc2626;
	--background: #f8fafc;
	--card-bg: #ffffff;
	--text-primary: #1e293b;
	--text-secondary: #64748b;
	--border-color: #e2e8f0;
	--shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
	--radius: 8px;
}

* {
	box-sizing: border-box;
}

html, body {
	height: 100%;
	margin: 0;
	padding: 0;
}

body {
	background: var(--background);
	font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
	display: flex;
	flex-direction: column;
}

form {
	flex: 1;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	padding: 3vh 3vw;
}

.page-container {
	max-width: 800px;
	width: 100%;
}

.page-card {
	background: var(--card-bg);
	border-radius: var(--radius);
	box-shadow: var(--shadow);
	padding: 4vh 4vw;
	text-align: center;
}

.page-title {
	font-size: clamp(24px, 5vw, 40px);
	font-weight: 700;
	color: var(--text-primary);
	margin: 0 0 3vh 0;
	padding-bottom: 2vh;
	border-bottom: 3px solid var(--danger-color);
}

.result-message {
	padding: 3vh 4vw;
	border-radius: var(--radius);
	margin-bottom: 3vh;
	font-size: clamp(18px, 4vw, 32px);
	font-weight: 600;
	line-height: 1.5;
}

.result-success {
	background: var(--success-bg);
	border: 1px solid var(--success-border);
	color: var(--success-color);
}

.result-warning {
	background: var(--warning-bg);
	border: 1px solid var(--warning-border);
	color: var(--warning-color);
}

.close-btn {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	padding: 2.5vh 8vw;
	font-size: clamp(18px, 3.5vw, 28px);
	font-weight: 600;
	border: none;
	border-radius: var(--radius);
	cursor: pointer;
	transition: all 0.2s;
	background: var(--secondary-color);
	color: white;
}

.close-btn:hover {
	background: #475569;
}

@media (min-width: 1200px) {
	.page-container {
		max-width: 800px;
	}
}
</style>
</head>
<body>
<form action="seat.php">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>

<script type="text/javascript">
function close_window(){
	window.open('about:blank','_self').close();
} 
</script>

<div class="page-container">
	<div class="page-card">
		<h1 class="page-title">外出（席開放）</h1>

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


if ($dao->next()){

	$delkb = $dao->get("DELKB");
	$idid = $dao->get("ID");
	$kettei_seatid = $dao->get("SEATID");

	if ( strcmp($delkb,"D") == 0 ) {

		echo "<div class='result-message result-warning'>すでに退席済みです</div>";

	} else {

		$sql = " update alloc set delkb='d' where id='".$id."' and dt='".$date."' and mid='".$mid."' ";
		$dao->exec($sql);
		echo "<div class='result-message result-success'>".$name."今日の席 <strong>".$kettei_seatid."</strong> を開放しました</div>";

	}

} else {

	echo "<div class='result-message result-warning'>".$mid." 今日は席が抽選されていません</div>";

}

$dao->close();

?>

		<input type="submit" class="close-btn" value="閉じる" onclick="close_window();"/>
	</div>
</div>

<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
