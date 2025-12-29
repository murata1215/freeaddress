<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス メール変更</title></head>
<body>
<form action="seat_manage2.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>





<H1>パスワードを変更する</H1>

<?php

if(isset($_GET['mail1'])) {
	$mail1 = $_GET['mail1'];
}
if(isset($_POST['mail1'])) {
	$mail1 = $_POST['mail1'];
}
if(isset($_GET['mail2'])) {
	$mail2 = $_GET['mail2'];
}
if(isset($_POST['mail2'])) {
	$mail2 = $_POST['mail2'];
}



$dao = new db();
$dao->connect();


$regist = false;
if (empty($mail1)) {
	echo "メールアドレスが入力されていません";
} else {
	if (strcmp($mail1,$mail2)==0) {
		//メールアドレスが一致した
		$regist = true;
	} else {
		//メールアドレスが一致しない
		echo "メールアドレスが一致しません";
	}
}


if ($regist == true) {
	//設定ファイルにメールを格納
	echo "メールアドレスを「".$mail1."」に変更しました";
	$param = new param();
	$param->setParam($id, "MAIL", $mail1);
}


$dao->close();

?>

<input type="submit" name="s" value="終了">

</p>





<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
