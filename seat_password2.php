<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス パスワード</title></head>
<body>
<form action="seat_manage2.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>





<H1>パスワードを変更する</H1>

<?php

if(isset($_GET['pass0'])) {
	$pass0 = $_GET['pass0'];
}
if(isset($_GET['pass1'])) {
	$pass1 = $_GET['pass1'];
}
if(isset($_GET['pass2'])) {
	$pass2 = $_GET['pass2'];
}

if(isset($_POST['pass0'])) {
	$pass0 = $_POST['pass0'];
}
if(isset($_POST['pass1'])) {
	$pass1 = $_POST['pass1'];
}
if(isset($_POST['pass2'])) {
	$pass2 = $_POST['pass2'];
}



$dao = new db();
$dao->connect();

//メールアドレスがすでに使われているかをチェックする
$sql = "";
$sql = $sql." SELECT VAL FROM SETTEI WHERE ID='".$id."' AND PARAM='PASSWORD' ";
$dao->select($sql);

$old_password = "";
if ($dao->next()){
	$old_password = $dao->get("VAL");
}

$regist = false;
if (strcmp($pass0,$old_password)==0) {
	//旧パスワードとパスワードが一致した
	if (strcmp($pass1,$pass2)==0) {
		//パスワードが一致した
		$regist = true;
	} else {
		//パスワードが一致しない
		echo "新パスワードが一致していません";
	}
} else {
	//旧パスワードとパスワードが一致しない
	echo "旧パスワードが一致していません";
}


if ($regist == true) {
	//設定ファイルにパスワードを格納
	echo "パスワードを変更しました";
	$param = new param();
	$param->setParam($id, "PASSWORD", $pass1);

	echo "<script type='text/javascript'>document.getElementById('password').value='$pass1';</script>";

}


$dao->close();

?>

<input type="submit" name="s" value="終了">

</p>





<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
