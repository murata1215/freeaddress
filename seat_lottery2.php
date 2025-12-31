<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>フリーアドレス 抽選</title>
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
	--danger-bg: #fef2f2;
	--danger-border: #fecaca;
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
	border-bottom: 3px solid var(--warning-color);
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

.result-error {
	background: var(--danger-bg);
	border: 1px solid var(--danger-border);
	color: var(--danger-color);
}

.seat-number {
	display: block;
	font-size: clamp(48px, 12vw, 96px);
	font-weight: 800;
	color: var(--danger-color);
	margin: 2vh 0;
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
		<h1 class="page-title">抽選結果</h1>

<?php
$dao = new db();
$dao->connect();

$date = date("Ymd");
$date100 = date("Ymd",strtotime("-100 day"));

if(isset($_GET['mid'])) {
	$mid = $_GET['mid'];
}

if(isset($_POST['mid'])) {
	$mid = $_POST['mid'];
}

$sql = "";
$sql = $sql." delete from alloc where id='".$id."' and dt<'".$date100."' ";
$dao->exec($sql);


$sql = "";
$sql = $sql." select mid from alloc where id='".$id."' and dt='".$date."' and mid='".$mid."' and delkb='D' ";
$dao->select($sql);

if ($dao->next()){

	echo "<div class='result-message result-warning'>今日は離籍済みです</div>";

} else {


	$sql = "";
	$sql = $sql." select mid,seat_range from member where id='".$id."' and mid='".$mid."' ";
	$dao->select($sql);
	if ($dao->next()) {

		$range_like = "";
		$range = $dao->get("seat_range");
		$range_list = explode(',', $range);
		while( $val = current( $range_list ) ) {
			$like = "A.seatid like ('".$val."%')";
			if ($range_like === "") {
				$range_like = $like;
			} else {
				$range_like = $range_like." OR ".$like;
			}
			next( $range_list );
		}
		if ($range_like != "") {
			$range_like = " AND (".$range_like.")";
			$sql = "";
			$sql = $sql." select upper(a.seatid) as seatid,ifnull(a.mid,'') as amid, ifnull(b.mid,'') as bmid ";
			$sql = $sql."  from seat a ";
			$sql = $sql."         left join alloc b ";
			$sql = $sql."            on b.id = a.id and b.seatid = a.seatid and b.dt='".$date."' and b.delkb is null ";
			$sql = $sql."  where a.id='".$id."' and (ifnull(a.mid,'') = '' and ifnull(b.mid,'') = '')  ".$range_like." ";
			$dao->select($sql);
			if ($dao->next()){
				;
			} else {
				$range_like = "";
			}
		}

		$sql = "";
		$sql = $sql." select upper(a.seatid) as seatid,a.mid as seatmid, b.mid ";
		$sql = $sql."  from seat a ";
		$sql = $sql."         left join alloc b ";
		$sql = $sql."            on b.id = a.id and b.seatid = a.seatid and b.dt='".$date."' and b.delkb is null ";
		$sql = $sql."  where a.id='".$id."' ".$range_like." ";

		$dao->select($sql);

		$seat_list = array();

		$cnt = 0;
		$kettei_seatid = "";

		while ($dao->next()){
			$seatid = $dao->get("seatid");
			$seatmid = $dao->get("seatmid");
			$allocmid = $dao->get("mid");

			if ($allocmid == "" && $seatmid == "") {
				$seat_list[] = $seatid;
				$cnt = $cnt + 1;
			}

			if ($seatmid == $mid) {
				$kettei_seatid = $seatid;
			}

			if ($allocmid == $mid) {
				$kettei_seatid = $seatid;
			}

		}

		$name = "";
		$dao->select("SELECT name from member where id='".$id."' and mid='".$mid."' ");
		if ($dao->next()){
			$name = $dao->get("name");
		}

		if ($cnt == 0) {
			echo "<div class='result-message result-warning'>".$name."さん<br>本日は満席です<br>打ち合わせコーナーをご利用ください</div>";
			
		} else {
			if ($kettei_seatid == "") {
				$lottry = rand(0,($cnt-1));
				$kettei_seatid = $seat_list[$lottry];
				$dao->exec("insert into alloc (id, dt, mid, seatid, updtime) values ('".$id."', '".$date."','".$mid."','".$kettei_seatid."','".date("Y-m-d H:i:s")."')");
			}

			echo "<div class='result-message result-success'>".$name."さん<br>今日の席は<span class='seat-number'>".$kettei_seatid."</span>です</div>";
		}


	} else {

		echo "<div class='result-message result-error'>コードが存在しません [".$mid."]</div>";

	}



}

$dao->close();

?>

		<input type='submit' class='close-btn' value='閉じる' />
	</div>
</div>

<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
