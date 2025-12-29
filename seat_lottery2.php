<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス 抽選</title></head>
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
	font-size:  20pt;
	text-align: center;
	height:     80;
	width:      10%;
	}
	
	td.td3{
	font-size:  20pt;
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


<?php  echo "

      <table align='center' width='100%'>
        <tr>
          <td class='tdx'></td>
          <td class='td1'>

";

?>

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

//5日前以前のデータは消す
$sql = "";
$sql = $sql." delete from alloc where id='".$id."' and dt<'".$date100."' ";
$dao->exec($sql);


//離籍確認を行い、離籍者の再抽選は行わないようにする
$sql = "";
$sql = $sql." select mid from alloc where id='".$id."' and dt='".$date."' and mid='".$mid."' and delkb='D' ";
$dao->select($sql);

if ($dao->next()){

	//ALLOCにDELKB='D'の設定がある場合、離籍済みと判断
	echo "今日は離籍済みです<p>";

} else {


	//メンバーＩＤの存在チェック
	$sql = "";
	$sql = $sql." select mid,seat_range from member where id='".$id."' and mid='".$mid."' ";
	$dao->select($sql);
	if ($dao->next()) {

		//biko2に,区切りでseatidの頭を入れるとその範囲で検索するようにLIKEを組み立てる
		//select * from seat where seatid like ('A%') or seatid like ('B%')
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
//		echo "[".$range."]";
//		echo "[".$range_like."]";
		//範囲で検索する場合、その席に空きがるか？
		if ($range_like != "") {
			$range_like = " AND (".$range_like.")";
			$sql = "";
			$sql = $sql." select upper(a.seatid) as seatid,ifnull(a.mid,'') as amid, ifnull(b.mid,'') as bmid ";
			$sql = $sql."  from seat a ";
			$sql = $sql."         left join alloc b ";
			$sql = $sql."            on b.id = a.id and b.seatid = a.seatid and b.dt='".$date."' and b.delkb is null ";
			$sql = $sql."  where a.id='".$id."' and (ifnull(a.mid,'') = '' and ifnull(b.mid,'') = '')  ".$range_like." ";
//			echo $sql;
			$dao->select($sql);
			if ($dao->next()){
				//空きあり
				;
//				echo "空きあり";
			} else {
				$range_like = "";
//				echo "空きなし";
			}
		}

		//席リストを取得する。着席、固定席の場合はメンバーＩＤも取得する
		$sql = "";
		$sql = $sql." select upper(a.seatid) as seatid,a.mid as seatmid, b.mid ";
		$sql = $sql."  from seat a ";
		$sql = $sql."         left join alloc b ";
		$sql = $sql."            on b.id = a.id and b.seatid = a.seatid and b.dt='".$date."' and b.delkb is null ";
		$sql = $sql."  where a.id='".$id."' ".$range_like." ";

		$dao->select($sql);

		//未割当のシートリスト
		$seat_list = array();

		$cnt = 0;
		$kettei_seatid = "";

		while ($dao->next()){
			$seatid = $dao->get("seatid");
			$seatmid = $dao->get("seatmid");
			$allocmid = $dao->get("mid");

			//未割当のシートリストを作成する
			if ($allocmid == "" && $seatmid == "") {
				$seat_list[] = $seatid;
				$cnt = $cnt + 1;
			}

			//固定席の人の場合、シートIDを退避。抽選は行わない
			if ($seatmid == $mid) {
				$kettei_seatid = $seatid;
			}

			//すでに抽選されている場合、決定されたものを使用
			if ($allocmid == $mid) {
				$kettei_seatid = $seatid;
			}

		}

		//メンバーマスタから名前を取得
		$name = "";
		$dao->select("SELECT name from member where id='".$id."' and mid='".$mid."' ");
		if ($dao->next()){
			$name = $dao->get("name");
		}

		if ($cnt == 0) {
			echo $name."さん 本日は満席です、打ち合わせコーナーをご利用ください<p>";
			
		} else {
			//決定された席番号がない場合、抽選を行う
			if ($kettei_seatid == "") {
				$lottry = rand(0,($cnt-1));
				$kettei_seatid = $seat_list[$lottry];
				$dao->exec("insert into alloc (id, dt, mid, seatid, updtime) values ('".$id."', '".$date."','".$mid."','".$kettei_seatid."','".date("Y-m-d H:i:s")."')");
			}

			echo $name."さん 今日の席は <font color='red'>".$kettei_seatid."</font> です<p>";
		}


	} else {

		//メンバーマスタに存在しなかった
		echo "コードが存在しません[".$mid."]<p>";

	}



}

$dao->close();

?>

<?php  echo "

		</td>
          <td class='tdx'></td>
        </tr>
        <tr>
          <td colspan='3' align='center' class='td3'>
          	<br>
			<input type='submit' class='example2' value='閉じる' />
          </td>
        </tr>
      </table>

";
?>






<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
