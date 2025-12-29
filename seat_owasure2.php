<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス 確認</title></head>
<body>
<form action="seat.php">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>
<?php require "./mail/framework_mail.php"; ?>





<H1>確認メールを送信</H1>

<?php

	$param = new param();
	$mailaddress = $param->getParam($id,"MAIL");
	$pass = $param->getParam($id,"PASSWORD");

	//差出人
	$from = 'fwjg2507@gmail.com';
	$fromname = 'FREE ADDRESS SYSTEM';

	//宛先
	$to = $mailaddress;
	$toname = '宛名';

	//件名・本文
	$subject = 'パスワードを送付します';
	$body = "";
	$body = $body."このメールはシステムにて自動的に送付されています\n";
	$body = $body."返信できません\n";
	$body = $body."設定されているパスワードは「".$pass."」です\n";

	$mymail = new mymail();
	$mymail->sendMail($to, $toname, $from, $fromname, $subject, $body);

?>

<input type="submit" name="s" value="終了">

</p>





<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
