<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	class mymail {
		// Gmail SMTP設定
		private $smtpHost = 'smtp.gmail.com';
		private $smtpPort = 587;
		private $smtpUsername = 'fwjg2507@gmail.com';
		private $smtpPassword = 'qkcytybplqgkxasq';
		private $adminEmail = 'fwjg2507@gmail.com';
		private $adminName = 'HotDesk管理者';

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
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
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
