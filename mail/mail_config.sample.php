<?php
/**
 * メール設定ファイル（サンプル）
 *
 * 使用方法:
 * 1. このファイルを mail_config.php にコピー
 * 2. SMTP_PASSWORD に実際のアプリパスワードを設定
 *
 * ※ mail_config.php は .gitignore に含まれ、Gitにコミットされません
 */

define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'fwjg2507@gmail.com');
define('SMTP_PASSWORD', 'your-app-password-here');
define('ADMIN_EMAIL', 'fwjg2507@gmail.com');
define('ADMIN_NAME', 'HotDesk管理者');
?>
