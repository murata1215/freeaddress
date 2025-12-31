<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>フリーアドレス メンバーリスト</title>
<style>
:root {
	--primary-color: #2563eb;
	--primary-hover: #1d4ed8;
	--secondary-color: #64748b;
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

body {
	background: var(--background);
	margin: 0;
	padding: 20px;
	font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
}

.page-container {
	max-width: 1200px;
	margin: 0 auto;
}

.page-header {
	background: var(--card-bg);
	border-radius: var(--radius);
	box-shadow: var(--shadow);
	padding: 20px 24px;
	margin-bottom: 20px;
	text-align: center;
}

.page-date {
	font-size: 24px;
	font-weight: 700;
	color: var(--text-primary);
	margin: 0 0 16px 0;
}

.nav-buttons {
	display: flex;
	justify-content: center;
	gap: 12px;
	flex-wrap: wrap;
}

.nav-btn {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	padding: 12px 24px;
	font-size: 16px;
	font-weight: 600;
	border: none;
	border-radius: var(--radius);
	cursor: pointer;
	transition: all 0.2s;
	text-decoration: none;
}

.nav-btn-primary {
	background: var(--primary-color);
	color: white;
}

.nav-btn-primary:hover {
	background: var(--primary-hover);
}

.nav-btn-primary:disabled {
	background: #cbd5e1;
	cursor: not-allowed;
}

.nav-btn-secondary {
	background: var(--secondary-color);
	color: white;
}

.nav-btn-secondary:hover {
	background: #475569;
}

.content-grid {
	display: grid;
	grid-template-columns: 1fr 1fr;
	gap: 20px;
}

@media (max-width: 768px) {
	.content-grid {
		grid-template-columns: 1fr;
	}
}

.list-card {
	background: var(--card-bg);
	border-radius: var(--radius);
	box-shadow: var(--shadow);
	overflow: hidden;
}

.list-header {
	background: var(--primary-color);
	color: white;
	padding: 16px 20px;
	font-size: 18px;
	font-weight: 600;
}

.list-table {
	width: 100%;
	border-collapse: collapse;
}

.list-table th,
.list-table td {
	padding: 12px 16px;
	text-align: left;
	border-bottom: 1px solid var(--border-color);
}

.list-table th {
	background: #f1f5f9;
	font-weight: 600;
	color: var(--text-secondary);
	font-size: 13px;
	text-transform: uppercase;
}

.list-table td {
	font-size: 14px;
	color: var(--text-primary);
}

.list-table tr:hover {
	background: #f8fafc;
}

.seat-id {
	font-weight: 700;
	color: var(--primary-color);
}

.member-id {
	color: var(--text-secondary);
	font-size: 13px;
}

.kana-index {
	font-weight: 700;
	color: var(--primary-color);
	font-size: 16px;
}

.phone-number {
	font-family: 'SF Mono', Monaco, monospace;
	color: var(--text-secondary);
}

.biko-001 { background-color: #fecaca !important; }
.biko-002 { background-color: #bbf7d0 !important; }
.biko-003 { background-color: #ddd6fe !important; }
.biko-004 { background-color: #bae6fd !important; }

.footer-actions {
	margin-top: 20px;
	text-align: center;
}

.close-btn {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	padding: 16px 48px;
	font-size: 18px;
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
</style>
</head>
<body>
<form id='form' name='form' action="seat.php">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>

<script type="text/javascript">
function close_window(){
	window.open('about:blank','_self').close();
} 
function goServletA(){
	var dt = document.getElementById("dt").value;
	if (dt == "") {
		dt = "0"
	}
	dt = Number(dt) - 1;
	document.getElementById("dt").value = dt;
	document.getElementById('form').action="seat_member.php";
}
function goServletB(){
	var dt = document.getElementById("dt").value;
	if (dt == "") {
		dt = "0"
	}
	dt = Number(dt) + 1;
	document.getElementById("dt").value = dt;
	document.getElementById('form').action="seat_member.php";
}
</script>

<?php
	$date = date("Ymd");
	if (strcmp($dt,"")==0) {
	} else {
		$date = date("Ymd", strtotime($dt." day"));
	}
	$youbi = date('w', strtotime($date));
	$week = [
	  '日',
	  '月',
	  '火',
	  '水',
	  '木',
	  '金',
	  '土',
	];

	$dao = new db();
	$dao->connect();

	$sql = "";
	$sql = $sql." SELECT   UPPER(A.SEATID) as SEATID ";
	$sql = $sql." 		,UPPER(CASE  ";
	$sql = $sql." 			WHEN C.MID is null THEN D.MID ";
	$sql = $sql." 			ELSE C.MID ";
	$sql = $sql." 		 END) as MID ";
	$sql = $sql." 		,CASE  ";
	$sql = $sql." 			WHEN C.KANA is null THEN D.KANA ";
	$sql = $sql." 			ELSE C.KANA ";
	$sql = $sql." 		 END as KANA ";
	$sql = $sql." 		,CASE  ";
	$sql = $sql." 			WHEN C.NAME is null THEN D.NAME ";
	$sql = $sql." 			ELSE C.NAME ";
	$sql = $sql." 		 END as NAME ";
	$sql = $sql." 		,CASE  ";
	$sql = $sql." 			WHEN C.PHONE is null THEN D.PHONE ";
	$sql = $sql." 			ELSE C.PHONE ";
	$sql = $sql." 		 END as PHONE ";
	$sql = $sql."  FROM seat A  ";
	$sql = $sql."         LEFT JOIN alloc B  ";
	$sql = $sql."            ON B.ID='".$id."' AND B.ID = A.ID AND B.SEATID = A.SEATID AND B.DT='".$date."' AND B.DELKB is NULL  ";
	$sql = $sql."         LEFT JOIN member C  ";
	$sql = $sql."            ON C.ID='".$id."' AND A.MID = C.MID  ";
	$sql = $sql."         LEFT JOIN member D  ";
	$sql = $sql."            ON D.ID='".$id."' AND B.MID = D.MID  ";
	$sql = $sql."  WHERE A.ID='".$id."' ";
	$sql = $sql." ORDER BY SEATID ";

	$dao->select($sql);
	$rows = array();

	while ($dao->next()){
		$row = array();
		$row['SEATID'] = $dao->get("SEATID");
		$row['MID'] = $dao->get("MID");
		$row['KANA'] = $dao->get("KANA");
		$row['NAME'] = $dao->get("NAME");
		$row['PHONE'] = $dao->get("PHONE");
		$rows[] = $row;
	}

	$sql = "";
	$sql = $sql." SELECT A.KANA,A.NAME,A.PHONE,UPPER(CASE WHEN B.SEATID IS NULL THEN C.SEATID ELSE B.SEATID END) AS SEATID,A.BIKO1 ";
	$sql = $sql."  FROM member A ";
	$sql = $sql."         LEFT JOIN alloc B  ";
	$sql = $sql."            ON B.ID='".$id."' AND B.MID = A.MID AND B.DT='".$date."' AND B.DELKB IS NULL  ";
	$sql = $sql."         LEFT JOIN seat C  ";
	$sql = $sql."            ON C.ID='".$id."' AND C.MID = A.MID  ";
	$sql = $sql."  WHERE A.ID='".$id."' ";
	$sql = $sql." ORDER BY KANA ";
	$dao->select($sql);
	$rows2 = array();

	$kana_mae = "";
	while ($dao->next()){
		$row2 = array();

		if (strcmp($dao->get("PHONE"),"")==0) {
			;
		} else {
			$kana = $dao->get("KANA");
			$kana = mb_substr($kana,0,1);

			if (strcmp($kana, $kana_mae) == 0) {
				$kana = "";
			} else {
				$kana_mae = $kana;
			}

			$row2['SEATID'] = $dao->get("SEATID");
			$row2['KANA'] = $kana;
			$row2['NAME'] = $dao->get("NAME");
			$row2['PHONE'] = $dao->get("PHONE");
			$row2['BIKO1'] = $dao->get("BIKO1");

			$rows2[] = $row2;
		}
	}

	$dao->close();
?>

<div class="page-container">
	<div class="page-header">
		<h1 class="page-date"><?php echo substr($date,0,4)."/".((int)substr($date,4,2))."/".((int)substr($date,6,2))." (".$week[$youbi].")" ?></h1>
		<div class="nav-buttons">
<?php 
if (strcmp($dt,"")==0 or strcmp($dt,"0")==0) { echo "
			<button type='submit' class='nav-btn nav-btn-primary' onclick='goServletA();'>&lt;&lt; 前日</button>
			<input type='submit' class='nav-btn nav-btn-secondary' value='閉じる' />
			<button type='submit' class='nav-btn nav-btn-primary' onclick='goServletB();' disabled>翌日 &gt;&gt;</button>
";}
else { echo "
			<button type='submit' class='nav-btn nav-btn-primary' onclick='goServletA();'>&lt;&lt; 前日</button>
			<input type='submit' class='nav-btn nav-btn-secondary' value='閉じる' />
			<button type='submit' class='nav-btn nav-btn-primary' onclick='goServletB();'>翌日 &gt;&gt;</button>
";} ?>
		</div>
	</div>

	<div class="content-grid">
		<div class="list-card">
			<div class="list-header">席順</div>
			<table class="list-table">
				<thead>
					<tr>
						<th>席ID</th>
						<th>社員ID</th>
						<th>名前</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($rows as $row){ ?> 
					<tr> 
						<td class="seat-id"><?php echo htmlspecialchars($row['SEATID'],ENT_QUOTES,'UTF-8'); ?></td> 
						<td class="member-id"><?php echo htmlspecialchars($row['MID'],ENT_QUOTES,'UTF-8'); ?></td> 
						<td><?php echo htmlspecialchars($row['NAME'],ENT_QUOTES,'UTF-8'); ?></td> 
					</tr> 
				<?php } ?>
				</tbody>
			</table>
		</div>

		<div class="list-card">
			<div class="list-header">名前順</div>
			<table class="list-table">
				<thead>
					<tr>
						<th>カナ</th>
						<th>名前</th>
						<th>内線</th>
						<th>席ID</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($rows2 as $row2){ 
					$bikoClass = "";
					if (strcmp($id,"111111111")==0) {
						if (strcmp($row2['BIKO1'],"001")==0) { $bikoClass = "biko-001"; }
						if (strcmp($row2['BIKO1'],"002")==0) { $bikoClass = "biko-002"; }
						if (strcmp($row2['BIKO1'],"003")==0) { $bikoClass = "biko-003"; }
						if (strcmp($row2['BIKO1'],"004")==0) { $bikoClass = "biko-004"; }
					}
				?> 
					<tr class="<?php echo $bikoClass; ?>"> 
						<td class="kana-index"><?php echo htmlspecialchars($row2['KANA'],ENT_QUOTES,'UTF-8'); ?></td> 
						<td><?php echo htmlspecialchars($row2['NAME'],ENT_QUOTES,'UTF-8'); ?></td> 
						<td class="phone-number"><?php echo htmlspecialchars($row2['PHONE'],ENT_QUOTES,'UTF-8'); ?></td> 
						<td class="seat-id"><?php echo htmlspecialchars($row2['SEATID'],ENT_QUOTES,'UTF-8'); ?></td> 
					</tr> 
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="footer-actions">
		<input type="submit" class="close-btn" value="閉じる"/>
	</div>
</div>

<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
