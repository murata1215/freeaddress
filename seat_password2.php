<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>フリーアドレス パスワード</title>
<style>
:root {
	--primary-color: #2563eb;
	--primary-hover: #1d4ed8;
	--secondary-color: #64748b;
	--secondary-hover: #475569;
	--success-color: #059669;
	--success-bg: #ecfdf5;
	--success-border: #a7f3d0;
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

.form-message-error {
	background: var(--danger-bg);
	border: 1px solid var(--danger-border);
	color: var(--danger-color);
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

.form-btn-secondary {
	background: var(--secondary-color);
	color: white;
	margin-top: 12px;
}

.form-btn-secondary:hover {
	background: var(--secondary-hover);
}
</style>
</head>
<body style="background: var(--background); margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
<form action="seat_manage2.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>

<div class="form-container">
	<div class="form-card">
		<h1 class="form-title">パスワード変更</h1>

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
$error_message = "";

if (strcmp($pass0,$old_password)==0) {
	//旧パスワードとパスワードが一致した
	if (strcmp($pass1,$pass2)==0) {
		//パスワードが一致した
		$regist = true;
	} else {
		//パスワードが一致しない
		$error_message = "新パスワードが一致していません";
	}
} else {
	//旧パスワードとパスワードが一致しない
	$error_message = "現在のパスワードが正しくありません";
}

if ($regist == true) {
	//設定ファイルにパスワードを格納
	$param = new param();
	$param->setParam($id, "PASSWORD", $pass1);

	echo "<script type='text/javascript'>document.getElementById('password').value='$pass1';</script>";

	echo "<div class='form-message form-message-success'>パスワードを変更しました</div>";
	echo "<button type='submit' name='s' class='form-btn form-btn-primary'>管理画面に戻る</button>";
} else {
	echo "<div class='form-message form-message-error'>".$error_message."</div>";
	echo "<button type='button' class='form-btn form-btn-secondary' onclick='history.back()'>戻って修正する</button>";
}

$dao->close();

?>

	</div>
</div>

<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
