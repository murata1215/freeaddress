<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	class mymail {
	    public function sendMail($to, $toname, $from, $fromname, $subject, $body) {

			$mail = new PHPMailer(true);

			$param = new param();
			$mailaddress = $param->getParam($id,"MAIL");
			$pass = $param->getParam($id,"PASSWORD");


			try {
				//認証情報
				$host = '10.20.170.222';
//				$username = 'fwjg2507@gmail.com'; // example@gmail.com
//				$password = 'getThep0wer';

				//メール設定
				//$mail->SMTPDebug = 2; //デバッグ用
				$mail->isSMTP();
				$mail->SMTPAuth = false;
				$mail->Host = $host;
//				$mail->Username = $username;
//				$mail->Password = $password;
//				$mail->SMTPSecure = 'tls';
				$mail->Port = 25;
				$mail->CharSet = "utf-8";
				$mail->Encoding = "base64";
				$mail->setFrom($from, $fromname);
				$mail->addAddress($to, $toname);
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
