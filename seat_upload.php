<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>フリーアドレス アップロード</title>
<style>
:root {
	--primary-color: #2563eb;
	--primary-hover: #1d4ed8;
	--secondary-color: #64748b;
	--secondary-hover: #475569;
	--warning-color: #d97706;
	--warning-bg: #fffbeb;
	--warning-border: #fde68a;
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

.form-file-input {
	width: 100%;
	padding: 12px 16px;
	font-size: 16px;
	border: 2px dashed var(--border-color);
	border-radius: var(--radius);
	box-sizing: border-box;
	background: var(--background);
	cursor: pointer;
	transition: border-color 0.2s, background-color 0.2s;
}

.form-file-input:hover {
	border-color: var(--primary-color);
	background: #f1f5f9;
}

.form-file-input:focus {
	outline: none;
	border-color: var(--primary-color);
}

.form-warning {
	background: var(--warning-bg);
	border: 1px solid var(--warning-border);
	border-radius: var(--radius);
	padding: 12px 16px;
	margin-bottom: 20px;
}

.form-warning-text {
	color: var(--warning-color);
	font-size: 13px;
	line-height: 1.5;
	margin: 0;
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
<form action="seat_upload2.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>

<div class="form-container">
	<div class="form-card">
		<h1 class="form-title">マスタアップロード</h1>
		<p class="form-subtitle">座席マスタデータをアップロードします</p>
		
		<div class="form-warning">
			<p class="form-warning-text">アップロードすると現在のマスタデータが上書きされます。事前にバックアップを取ることをお勧めします。</p>
		</div>
		
		<div class="form-group">
			<label class="form-label" for="file_upload">ファイルを選択</label>
			<input type="file" id="file_upload" name="file_upload" class="form-file-input" accept=".xlsx,.xls" required>
			<p class="form-hint">Excel形式（.xlsx, .xls）のファイルを選択してください</p>
		</div>
		
		<div class="form-btn-group">
			<button type="submit" class="form-btn form-btn-primary">アップロード</button>
			<button type="button" class="form-btn form-btn-secondary" onclick="history.back()">戻る</button>
		</div>
	</div>
</div>

<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
