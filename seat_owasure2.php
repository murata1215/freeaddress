<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>フリーアドレス 確認</title>
<style>
:root {
	--primary-color: #2563eb;
	--primary-hover: #1d4ed8;
	--secondary-color: #64748b;
	--secondary-hover: #475569;
	--success-color: #059669;
	--success-bg: #ecfdf5;
	--success-border: #a7f3d0;
	--background: #f8fafc;
	--card-bg: #ffffff;
	--text-primary: #1e293b;
	--text-secondary: #64748b;
	--border-color: #e2e8f0;
	--shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
	--radius: 8px;
}

.form-container {
	max-width: 480px;
	margin: 40px auto;
	padding: 0 20px;
}

.form-card {
	background: var(--card-bg);
	border-radius: var(--radius);
	box-shadow: var(--shadow);
	padding: 32px;
}

.form-title {
	font-size: 24px;
	font-weight: 700;
	color: var(--text-primary);
	margin: 0 0 24px 0;
	text-align: center;
	border-bottom: 2px solid var(--primary-color);
	padding-bottom: 16px;
}

.form-message {
	padding: 16px 20px;
	border-radius: var(--radius);
	margin-bottom: 24px;
	font-size: 15px;
	font-weight: 500;
}

.form-message-success {
	background: var(--success-bg);
	border: 1px solid var(--success-border);
	color: var(--success-color);
}

.form-info {
	font-size: 14px;
	color: var(--text-secondary);
	text-align: center;
	margin-bottom: 24px;
	line-height: 1.6;
}

.form-btn {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	padding: 14px 24px;
	font-size: 16px;
	font-weight: 600;
	border: none;
	border-radius: var(--radius);
	cursor: pointer;
	transition: all 0.2s;
	text-decoration: none;
	box-sizing: border-box;
	width: 100%;
}

.form-btn-primary {
	background: var(--primary-color);
	color: white;
}

.form-btn-primary:hover {
	background: var(--primary-hover);
	transform: translateY(-1px);
	box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}
</style>
</head>
<body style="background: var(--background); margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
<form action="seat.php">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>
<?php require "./mail/framework_mail.php"; ?>

<div class="form-container">
	<div class="form-card">
		<h1 class="form-title">確認メール送信</h1>

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

	echo "<div class='form-message form-message-success'>パスワードをメールで送信しました</div>";
	echo "<p class='form-info'>登録されているメールアドレスにパスワードを送信しました。<br>メールをご確認ください。</p>";

?>

		<button type="submit" name="s" class="form-btn form-btn-primary">トップに戻る</button>
	</div>
</div>

<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
