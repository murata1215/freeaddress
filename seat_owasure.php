<?php require "lang/lang.php"; ?>
<!doctype html>
<html lang="<?php echo Lang::getInstance()->getCurrentLang(); ?>">
<head>
<meta charset="UTF-8">
<title><?php _e('owasure.title'); ?></title>
<style>
:root {
	--primary-color: #2563eb;
	--primary-hover: #1d4ed8;
	--secondary-color: #64748b;
	--secondary-hover: #475569;
	--info-color: #0284c7;
	--info-bg: #f0f9ff;
	--info-border: #bae6fd;
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

.form-info {
	background: var(--info-bg);
	border: 1px solid var(--info-border);
	border-radius: var(--radius);
	padding: 20px;
	margin-bottom: 24px;
}

.form-info-text {
	color: var(--info-color);
	font-size: 15px;
	line-height: 1.6;
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
</style>
</head>
<body style="background: var(--background); margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
<form action="seat_owasure2.php">
<?php require "framework_head.php"; ?>
<?php echo Lang::getInstance()->renderSwitcher(); ?>
<?php require "framework_body.php"; ?>

<div class="form-container">
	<div class="form-card">
		<h1 class="form-title"><?php _e('owasure.title'); ?></h1>

		<div class="form-info">
			<p class="form-info-text"><?php _e('owasure.info'); ?></p>
		</div>

		<button type="submit" name="s" class="form-btn form-btn-primary"><?php _e('owasure.sendPassword'); ?></button>
		<button type="button" class="form-btn form-btn-secondary" onclick="history.back()"><?php _e('common.back'); ?></button>
	</div>
</div>

<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
