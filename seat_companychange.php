<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>フリーアドレス 会社変更</title>
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
	margin: 0 0 8px 0;
	text-align: center;
}

.form-subtitle {
	font-size: 14px;
	color: var(--text-secondary);
	text-align: center;
	margin-bottom: 24px;
	padding-bottom: 16px;
	border-bottom: 2px solid var(--primary-color);
}

.form-group {
	margin-bottom: 20px;
}

.form-label {
	display: block;
	font-size: 14px;
	font-weight: 600;
	color: var(--text-secondary);
	margin-bottom: 8px;
}

.form-input {
	width: 100%;
	padding: 12px 16px;
	font-size: 16px;
	border: 2px solid var(--border-color);
	border-radius: var(--radius);
	box-sizing: border-box;
	transition: border-color 0.2s, box-shadow 0.2s;
}

.form-input:focus {
	outline: none;
	border-color: var(--primary-color);
	box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.form-input::placeholder {
	color: #94a3b8;
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

.form-btn-group {
	margin-top: 24px;
}

.form-hint {
	font-size: 12px;
	color: var(--text-secondary);
	margin-top: 4px;
}
</style>
</head>
<body style="background: var(--background); margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
<form action="seat_companychange2.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>

<?php
	$param = new param();
	$company = $param->getParam($id, "COMPANY");
?>

<div class="form-container">
	<div class="form-card">
		<h1 class="form-title">会社名変更</h1>
		<p class="form-subtitle">表示される会社名を変更します</p>
		
		<div class="form-group">
			<label class="form-label" for="company">会社名</label>
			<input type="text" id="company" name="company" value="<?php echo $company ?>" class="form-input" placeholder="会社名を入力" required>
			<p class="form-hint">フリーアドレス画面に表示される会社名です</p>
		</div>
		
		<div class="form-btn-group">
			<button type="submit" name="s" class="form-btn form-btn-primary">変更する</button>
			<button type="button" class="form-btn form-btn-secondary" onclick="history.back()">戻る</button>
		</div>
	</div>
</div>

<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
