<?php require "lang/lang.php"; ?>
<!doctype html>
<html lang="<?php echo Lang::getInstance()->getCurrentLang(); ?>">
<head>
<meta charset="UTF-8">
<title><?php _e('regist.title'); ?></title>
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

.regist-container {
	max-width: 480px;
	margin: 40px auto;
	padding: 0 20px;
}

.regist-card {
	background: var(--card-bg);
	border-radius: var(--radius);
	box-shadow: var(--shadow);
	padding: 32px;
}

.regist-title {
	font-size: 24px;
	font-weight: 700;
	color: var(--text-primary);
	margin: 0 0 24px 0;
	text-align: center;
	border-bottom: 2px solid var(--primary-color);
	padding-bottom: 16px;
}

.regist-message {
	padding: 16px 20px;
	border-radius: var(--radius);
	margin-bottom: 24px;
	font-size: 15px;
	font-weight: 500;
}

.regist-message-success {
	background: var(--success-bg);
	border: 1px solid var(--success-border);
	color: var(--success-color);
}

.regist-message-error {
	background: var(--danger-bg);
	border: 1px solid var(--danger-border);
	color: var(--danger-color);
}

.regist-id-display {
	background: #f1f5f9;
	border-radius: var(--radius);
	padding: 20px;
	text-align: center;
	margin-bottom: 24px;
}

.regist-id-label {
	font-size: 14px;
	color: var(--text-secondary);
	margin-bottom: 8px;
}

.regist-id-value {
	font-size: 28px;
	font-weight: 700;
	color: var(--primary-color);
	font-family: 'Courier New', monospace;
	letter-spacing: 2px;
}

.regist-info {
	font-size: 14px;
	color: var(--text-secondary);
	text-align: center;
	margin-bottom: 24px;
	line-height: 1.6;
}

.regist-btn {
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

.regist-btn-primary {
	background: var(--primary-color);
	color: white;
}

.regist-btn-primary:hover {
	background: var(--primary-hover);
	transform: translateY(-1px);
	box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.regist-btn-secondary {
	background: var(--secondary-color);
	color: white;
	margin-top: 12px;
}

.regist-btn-secondary:hover {
	background: var(--secondary-hover);
}
</style>
</head>
<body style="background: var(--background); margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
<form action="seat.php">
<?php require "framework_head.php"; ?>
<?php echo Lang::getInstance()->renderSwitcher(); ?>
<?php require "framework_body.php"; ?>
<?php require "mail/framework_mail.php"; ?>

<div class="regist-container">
	<div class="regist-card">
		<h1 class="regist-title"><?php _e('regist.pageTitle'); ?></h1>

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

//メールアドレスがすでに使われているかをチェックする（SQLインジェクション対策）
$mail_escaped = $dao->conn->real_escape_string($mail);
$sql = "";
$sql = $sql." SELECT ID FROM SETTEI WHERE PARAM='MAIL' AND VAL='".$mail_escaped."' ";
$dao->select($sql);

$exist_id = "";
if ($dao->next()){
	$exist_id = $dao->get("ID");
}

$regist = false;
$error_message = "";

if (empty($exist_id)) {
	//入力したメールアドレスは使用されていない
	if (!empty($pass1)) {
		//パスワードは空ではない
		if (strcmp($pass1,$pass2)==0) {
			//パスワードが一致した
			$regist = true;
		} else {
			//パスワードが一致しない
			$error_message = __('regist.errorPasswordMismatch');
		}
	} else {
		//パスワードは空である
		$error_message = __('regist.errorPasswordEmpty');
	}
} else {
	//入力したメールアドレスが使用されている。
	$error_message = __('regist.errorEmailExists');
}

if ($regist == true) {
	
	//IDを生成。（9桁の数字）
	$id_new = mt_rand(100000000,999999999);

	//生成したIDの設定ファイルに,入力されたメールとパスワードを格納する
	$param = new param();
	$param->setParam($id_new, "MAIL", $mail);
	$param->setParam($id_new, "PASSWORD", $pass1);

	echo "<div class='regist-message regist-message-success'>".__('regist.success')."</div>";

	echo "<div class='regist-id-display'>";
	echo "<div class='regist-id-label'>".__('regist.yourId')."</div>";
	echo "<div class='regist-id-value'>".$id_new."</div>";
	echo "</div>";

	echo "<p class='regist-info'>".__('regist.idNote')."</p>";

	// 管理者ページURLをメールで送信（多言語対応）
	$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
	$script_path = dirname($_SERVER['SCRIPT_NAME']);
	if ($script_path !== '/' && $script_path !== '\\') {
		$base_url .= $script_path;
	}

	$general_url = $base_url . "/seat.php?id=" . $id_new;
	$admin_url = $base_url . "/seat.php?id=" . $id_new . "&manage=true";

	$mail_subject = __('regist.mailSubject');
	$mail_body = __('regist.mailBody1') . "\n\n";
	$mail_body .= __('regist.mailBody2') . "\n\n";
	$mail_body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
	$mail_body .= "■ " . __('regist.mailBodyYourId') . "\n";
	$mail_body .= $id_new . "\n\n";
	$mail_body .= "■ " . __('regist.mailBodyGeneralUrl') . "\n";
	$mail_body .= $general_url . "\n\n";
	$mail_body .= "■ " . __('regist.mailBodyAdminUrl') . "\n";
	$mail_body .= $admin_url . "\n";
	$mail_body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
	$mail_body .= __('regist.mailBodyNote1') . "\n";
	$mail_body .= __('regist.mailBodyNote2') . "\n\n";
	$mail_body .= "----\n";
	$mail_body .= __('regist.mailBodyFooter') . "\n";

	$mailer = new mymail();
	$mail_result = $mailer->sendMail(
		$mail,                          // 宛先メールアドレス
		"",                             // 宛先名
		"noreply@freeaddress.local",    // Reply-Toアドレス
		"FreeAddress",                  // Reply-To名
		$mail_subject,                  // 件名
		$mail_body                      // 本文
	);

	if ($mail_result) {
		$emailSentMsg = str_replace('{email}', htmlspecialchars($mail), __('regist.emailSent'));
		echo "<p class='regist-info' style='color: var(--success-color);'>📧 " . $emailSentMsg . "</p>";
	}

	//生成したIDを id_new に格納してフレームワークのIDに格納する
	echo "<input type='text' id='id_new' name='id_new' style='display:none' value='{$id_new}'>";
	echo "
	<script type='text/javascript'>
	var elem = document.getElementById('id');
	var elem_new = document.getElementById('id_new');
	var manage = document.getElementById('manage');
	elem.value = elem_new.value;
	manage.value = 'true';
	</script>
	";

	echo "<button type='submit' class='regist-btn regist-btn-primary'>".__('regist.startButton')."</button>";

} else {
	echo "<div class='regist-message regist-message-error'>".$error_message."</div>";
	echo "<p class='regist-info'>".__('regist.errorRetry')."</p>";
	echo "<button type='button' class='regist-btn regist-btn-secondary' onclick='history.back()'>".__('regist.backToFix')."</button>";
}

$dao->close();

?>

	</div>
</div>

<?php
	echo "</div>";
	echo "<script type='text/javascript'>ALL_DIV.style.display = 'block';</script>";
?>

</form>
</body>
</html>
