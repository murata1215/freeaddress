<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>フリーアドレス 管理者ページ</title>
<style>
:root {
	--primary-color: #2563eb;
	--primary-hover: #1d4ed8;
	--secondary-color: #64748b;
	--secondary-hover: #475569;
	--background: #f8fafc;
	--card-bg: #ffffff;
	--text-primary: #1e293b;
	--text-secondary: #64748b;
	--border-color: #e2e8f0;
	--shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
	--radius: 8px;
}

.manage-container {
	max-width: 480px;
	margin: 40px auto;
	padding: 0 20px;
}

.manage-card {
	background: var(--card-bg);
	border-radius: var(--radius);
	box-shadow: var(--shadow);
	padding: 32px;
}

.manage-title {
	font-size: 24px;
	font-weight: 700;
	color: var(--text-primary);
	margin: 0 0 24px 0;
	text-align: center;
	border-bottom: 2px solid var(--primary-color);
	padding-bottom: 16px;
}

.manage-form-group {
	margin-bottom: 20px;
}

.manage-label {
	display: block;
	font-size: 14px;
	font-weight: 600;
	color: var(--text-secondary);
	margin-bottom: 8px;
}

.manage-input {
	width: 100%;
	padding: 12px 16px;
	font-size: 16px;
	border: 2px solid var(--border-color);
	border-radius: var(--radius);
	box-sizing: border-box;
	transition: border-color 0.2s, box-shadow 0.2s;
}

.manage-input:focus {
	outline: none;
	border-color: var(--primary-color);
	box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.manage-btn {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	padding: 12px 24px;
	font-size: 16px;
	font-weight: 600;
	border: none;
	border-radius: var(--radius);
	cursor: pointer;
	transition: all 0.2s;
	text-decoration: none;
	box-sizing: border-box;
}

.manage-btn-primary {
	background: var(--primary-color);
	color: white;
	width: 100%;
}

.manage-btn-primary:hover {
	background: var(--primary-hover);
	transform: translateY(-1px);
	box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.manage-btn-secondary {
	background: var(--secondary-color);
	color: white;
	width: 100%;
	margin-top: 12px;
}

.manage-btn-secondary:hover {
	background: var(--secondary-hover);
}

.manage-btn-group {
	margin-top: 24px;
}
</style>
</head>
<body style="background: var(--background); margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
<form action="seat_manage2.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>

<div class="manage-container">
	<div class="manage-card">
		<h1 class="manage-title">管理者ページ</h1>
		
		<div class="manage-form-group">
			<label class="manage-label" for="pass">パスワードを入力</label>
			<input type="password" id="pass" name="pass" value="" class="manage-input" placeholder="パスワード">
		</div>
		
		<div class="manage-btn-group">
			<button type="submit" class="manage-btn manage-btn-primary">ログイン</button>
			<button type="button" class="manage-btn manage-btn-secondary" onclick="history.back()">戻る</button>
		</div>
	</div>
</div>

<?php require "framework_tail.php"; ?>
</form>
</body>
</html>

