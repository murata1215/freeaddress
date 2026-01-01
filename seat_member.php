<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス メンバーリスト</title></head>
<body>
<form id='form' name='form' action="seat.php">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>


<style type="text/css">
	input.example {
	font-size:  50pt;
	height:     100%;
	width:      20%;
	border-style:none;
	}
	
	input.tenKey {
	font-size:  50pt;
	height:     100%;
	width:      100%;
	}
	
	td.tds{
	font-size:  30pt;
	align:      center;
	height:     50;
	width:      40%;
	padding: .40em 0 .5em .20em;
	border-left: 20px solid #3498db;
	border-bottom: 1px solid #ccc;
	text-align:    left;
	}
	
	td.tdx{
	width:  20px;
	}
	
	td.td1{
	font-size:  50pt;
	align:      center;
	height:     100;
	width:      40%;
	}
	td.td2{
	font-size:  50pt;
	align:      center;
	height:     100;
	width:      40%;
	}
	td.td3{
	font-size:  50pt;
	text-align: center;
	height:     100;
	width:      100%;
	}
	td.td4{
	font-size:  20pt;
	text-align: center;
	height:     100;
	width:      100%;
	}
	td.td5{
	font-size:  20pt;
	text-align: center;
	height:     100;
	width:      100%;
	}
	button.BTN31 {
		font-size:  50pt;
		border-style:none;
		background-color:#3498db;
		text-align:centert;
		color:white;
	}

</style>

<style type="text/css">
	.D1  {
		width:80px;
		text-align:center;
		background-color: #ADD8E6;
		font-size:15pt;
	}
	.D2  {
		width:100px;
		text-align:center;
		background-color: #f5f5f5;
		font-size:13pt;
	}
	.D3  {
		width:200px;
		text-align:left;
		background-color: #f5f5f5;
		font-size:15pt;
	}
	.D4  {
		width:70px;
		text-align:center;
		background-color: #ADD8E6;
		font-size:15pt;
	}
	.D5  {
		width:150px;
		text-align:left;
		background-color: #f5f5f5;
		font-size:13pt;
	}
	.D6  {
		width:180px;
		text-align:center;
		background-color: #ADD8E6;
		font-size:15pt;
	}
	.D7  {
		width:80px;
		text-align:center;
		background-color: #f5f5f5;
		font-size:15pt;
	}

	.foo1 {
		 vertical-align:top;
		 width:100%
		 text-align:center;
	}
	.foo2 {
		 width:100%
		 text-align:center;
	}

</style>

<script type="text/javascript"><!--
function close_window(){
	window.open('about:blank','_self').close();
} 
function goServletA(){
	// 前日ボタンの動作
	var dt = document.getElementById("dt").value;
	if (dt == "") {
		dt = "0"
	}
	dt = Number(dt) - 1;
	document.getElementById("dt").value = dt;
    document.getElementById('form').action="seat_member.php";
}
function goServletB(){
	// 翌日ボタンの動作
	var dt = document.getElementById("dt").value;
	if (dt == "") {
		dt = "0"
	}
	dt = Number(dt) + 1;
	document.getElementById("dt").value = dt;
    document.getElementById('form').action="seat_member.php";
}

// --></script>


<?php
	$date = date("Ymd");
	if (strcmp($dt,"")==0) {
	} else {
		$date = date("Ymd", strtotime($dt." day"));
	}
	$youbi = date('w', strtotime($date));
	$week = [
	  '日', //0
	  '月', //1
	  '火', //2
	  '水', //3
	  '木', //4
	  '金', //5
	  '土', //6
	];

	$dao = new db();
	$dao->connect();

	//席順リストA1～
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

	//ｶﾅ順リスト～
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
			//電話番号未設定の人は表示しない
			;
		} else {

			//カナの１文字目を切り出す（表示インデックス）
			//前のカナと同じだった場合SPACEにする
			$kana = $dao->get("KANA");
			$kana = mb_substr($kana,0,1);

			if (strcmp($kana, $kana_mae) == 0) {
				$kana = "";
			} else {
				$kana_mae = $kana;
			}
//	echo $dao->get("KANA")."/".$kana."  |";

			$row2['SEATID'] = $dao->get("SEATID");
//			$row2['MID'] = $dao->get("MID");
			$row2['KANA'] = $kana;
			$row2['NAME'] = $dao->get("NAME");
			$row2['PHONE'] = $dao->get("PHONE");
			$row2['BIKO1'] = $dao->get("BIKO1");

	 		$rows2[] = $row2;
		}


//		//カナの１文字目を切り出す（表示インデックス）
//		//前のカナと同じだった場合SPACEにする
//		$kana = $dao->get("KANA");
//		$kana = mb_substr($kana,0,1);
//
//		if (strcmp($kana, $kana_mae) == 0) {
//			$kana = "";
//		} else {
//			$kana_mae = $kana;
//		}
//echo $dao->get("KANA")."/".$kana."  |";
//
//		$row2['SEATID'] = $dao->get("SEATID");
//		$row2['MID'] = $dao->get("MID");
//		$row2['KANA'] = $kana;
//		$row2['NAME'] = $dao->get("NAME");
//		$row2['PHONE'] = $dao->get("PHONE");
//
//		if (strcmp($row2['PHONE'],"")==0) {
//			//電話番号未設定の人は表示しない
//			;
//		} else {
//	 		$rows2[] = $row2;
//		}


	}




	$dao->close();

?>



<table width="100%">
	<tr>
		<td colspan="3" class="td5">
			<font face='ＭＳ Ｐゴシック' size='5'><CENTER><B>
			<?php echo substr($date,0,4)."/".((int)substr($date,4,2))."/".((int)substr($date,6,2))." (".$week[$youbi].")" ?></td>
			</B></CENTER>
			</font>
	</tr>
	<tr>
		<td colspan="3" class="td4">

<?php 
if (strcmp($dt,"")==0 or strcmp($dt,"0")==0) { echo "
			<button type='submit' class='BTN31' onclick='goServletA();'><<前日</button>
			<input type='submit' class='example' value='閉じる' />
			<button type='submit' class='BTN31' onclick='goServletB();' disabled>翌日>></button>
";}

else { echo "
			<button type='submit' class='BTN31' onclick='goServletA();'><<前日</button>
			<input type='submit' class='example' value='閉じる' />
			<button type='submit' class='BTN31' onclick='goServletB();'>翌日>></button>
";} ?>

		</td>
	</tr>
	<tr>
		<td class="tds">席順</td>
		<td class="tdx"></td>
		<td class="tds">名前順</td>
	</tr>
	<tr>
		<td valign="top" class="td1" width="100%">
			<div class="foo1"  >


<table>
<tr>
	<td valign="top">
		<table>
		 
		<?php 
		foreach($rows as $row){
		?> 
		<tr> 
			<td class='D1'><?php echo htmlspecialchars($row['SEATID'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td class='D2'><?php echo htmlspecialchars($row['MID'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td class='D3'><?php echo htmlspecialchars($row['NAME'],ENT_QUOTES,'UTF-8'); ?></td> 
		</tr> 
		<?php 
		} 
		?>
		 
		</table>
		
	</td>
</tr>
</table>


	</div>
</td>
<td class="tdx"></td>
<td valign="top" class="td2"  width="100%">
	<div class="foo2">

		<table>
			<?php 
			foreach($rows2 as $row2){
			?> 
				<tr> 
					<td class='D4'><?php echo htmlspecialchars($row2['KANA'],ENT_QUOTES,'UTF-8'); ?></td> 
					<td class='D5'><?php echo htmlspecialchars($row2['NAME'],ENT_QUOTES,'UTF-8'); ?></td> 
					<td class='D6'><?php echo htmlspecialchars($row2['PHONE'],ENT_QUOTES,'UTF-8'); ?></td> 
					<td class='D7' style="
											<?php
												if (strcmp($id,"111111111")==0) {
													if (strcmp($row2['BIKO1'],"001")==0) {
														echo "background-color: #FF7D7D;";
													}
													if (strcmp($row2['BIKO1'],"002")==0) {
														echo "background-color: #B3E2B4;";
													}
													if (strcmp($row2['BIKO1'],"003")==0) {
														echo "background-color: #B8B2EA;";
													}
													if (strcmp($row2['BIKO1'],"004")==0) {
														echo "background-color: #84b5cf;";
													}
												}
											?>
									"><?php echo htmlspecialchars($row2['SEATID'],ENT_QUOTES,'UTF-8'); ?></td> 
				</tr> 
			<?php 
			} 
			?>
		</table>


	</div>
</td>
</tr>
<tr>
<td colspan="3" class="td3">
		<input type="submit" class="example" value="閉じる"/>
</td>
</tr>
</table>





<?php require "framework_tail.php"; ?>
</form>
</body>
</html>

