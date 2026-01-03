<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	// メール設定ファイルを読み込み
	require_once __DIR__ . '/mail_config.php';

	class mymail {
		// Gmail SMTP設定（mail_config.phpから読み込み）
		private $smtpHost;
		private $smtpPort;
		private $smtpUsername;
		private $smtpPassword;
		private $adminEmail;
		private $adminName;

		public function __construct() {
			$this->smtpHost = SMTP_HOST;
			$this->smtpPort = SMTP_PORT;
			$this->smtpUsername = SMTP_USERNAME;
			$this->smtpPassword = SMTP_PASSWORD;
			$this->adminEmail = ADMIN_EMAIL;
			$this->adminName = ADMIN_NAME;
		}

	    public function sendMail($to, $toname, $from, $fromname, $subject, $body) {

			$mail = new PHPMailer(true);

			try {
				//メール設定
				//$mail->SMTPDebug = 2; //デバッグ用
				$mail->isSMTP();
				$mail->SMTPAuth = true;
				$mail->Host = $this->smtpHost;
				$mail->Username = $this->smtpUsername;
				$mail->Password = $this->smtpPassword;
				$mail->SMTPSecure = 'tls';
				$mail->Port = $this->smtpPort;
				$mail->CharSet = "utf-8";
				$mail->Encoding = "base64";

				// 送信者設定（Gmail SMTPでは認証アカウントと同じにする必要あり）
				$mail->setFrom($this->adminEmail, $this->adminName);
				$mail->addReplyTo($from, $fromname);

				// 宛先設定
				$mail->addAddress($to, $toname);

				// BCC（管理者に控えを送信）
				$mail->addBCC($this->adminEmail, $this->adminName);

				$mail->Subject = $subject;
				$mail->Body    = $body;

				//メール送信
				$mail->send();
				return true;

			} catch (Exception $e) {

				// エラーログに記録（本番環境では適切なログ出力に変更）
				error_log('メール送信が失敗しました: ' . $mail->ErrorInfo);
				return false;

			}

	    }
	}

?>
