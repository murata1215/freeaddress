<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス 登録</title></head>
<body>
<form action="seat.php">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>





<H1>利用者登録する</H1>

<?php

if(isset($_GET['mail'])) {
	$mail = $_GET['mail'];
}
if(isset($_GET['pass1'])) {
	$pass1 = $_GET['pass1'];
}
if(isset($_GET['pass2'])) {
	$pass2 = $_GET['pass2'];
}



$dao = new db();
$dao->connect();

//メールアドレスがすでに使われているかをチェックする
$sql = "";
$sql = $sql." SELECT ID FROM SETTEI WHERE PARAM='MAIL' AND VAL='".$mail."' ";
$dao->select($sql);

$exist_id = "";
if ($dao->next()){
	$exist_id = $dao->get("ID");
}

$regist = false;
if (empty($exist_id)) {
	//入力したメールアドレスは使用されていない
	if (!empty($pass1)) {
		//パスワードは空ではない
		if (strcmp($pass1,$pass2)==0) {
			//パスワードが一致した
			$regist = true;
		} else {
			//パスワードが一致しない
			echo "パスワードが一致していません";
		}
	} else {
		//パスワードは空である
		echo "パスワード入力されていません";
	}
} else {
	//入力したメールアドレスが使用されている。
	echo "入力されたメールアドレスはすでに利用されています";
}

if ($regist == true) {
	
		//IDを生成。（9桁の数字）
		$id_new = mt_rand(100000000,999999999);

		//生成したIDの設定ファイルに,入力されたメールとパスワードを格納する
		$param = new param();
		$param->setParam($id_new, "MAIL", $mail);
		$param->setParam($id_new, "PASSWORD", $pass1);

		echo $id_new;

		//生成したIDを id_new に格納してフレームワークのIDに格納する
		echo "<input type='text' id='id_new' name='id_new' style='display:block' value='{$id_new}'>";
		echo "
		<script type='text/javascript'>
		var elem = document.getElementById('id');
		var elem_new = document.getElementById('id_new');
		var manage = document.getElementById('manage');
		elem.value = elem_new.value;
		manage.value = 'true';
		</script>
		";


}

$dao->close();

?>

<input type="submit" name="s" value="終了">

</p>



<?php

	echo "</div>";
	echo "<script type='text/javascript'>ALL_DIV.style.display = 'block';</script>";
?>


</form>
</body>
</html>
