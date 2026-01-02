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
	margin: 0 0 8px 0;
	text-align: center;
}

.regist-subtitle {
	font-size: 14px;
	color: var(--text-secondary);
	text-align: center;
	margin-bottom: 24px;
	padding-bottom: 16px;
	border-bottom: 2px solid var(--primary-color);
}

.regist-form-group {
	margin-bottom: 20px;
}

.regist-label {
	display: block;
	font-size: 14px;
	font-weight: 600;
	color: var(--text-secondary);
	margin-bottom: 8px;
}

.regist-input {
	width: 100%;
	padding: 12px 16px;
	font-size: 16px;
	border: 2px solid var(--border-color);
	border-radius: var(--radius);
	box-sizing: border-box;
	transition: border-color 0.2s, box-shadow 0.2s;
}

.regist-input:focus {
	outline: none;
	border-color: var(--primary-color);
	box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.regist-input::placeholder {
	color: #94a3b8;
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

.regist-btn-group {
	margin-top: 24px;
}

.regist-hint {
	font-size: 12px;
	color: var(--text-secondary);
	margin-top: 4px;
}
</style>
</head>
<body style="background: var(--background); margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
<form action="seat_regist2.php">
<?php require "framework_head.php"; ?>
<?php echo Lang::getInstance()->renderSwitcher(); ?>
<?php require "framework_body.php"; ?>

<div class="regist-container">
	<div class="regist-card">
		<h1 class="regist-title"><?php _e('regist.pageTitle'); ?></h1>
		<p class="regist-subtitle"><?php _e('regist.subtitle'); ?></p>

		<div class="regist-form-group">
			<label class="regist-label" for="mail"><?php _e('regist.email'); ?></label>
			<input type="email" id="mail" name="mail" value="" class="regist-input" placeholder="<?php _e('regist.emailPlaceholder'); ?>" required>
		</div>

		<div class="regist-form-group">
			<label class="regist-label" for="pass1"><?php _e('regist.password'); ?></label>
			<input type="password" id="pass1" name="pass1" value="" class="regist-input" placeholder="<?php _e('regist.passwordPlaceholder'); ?>" required>
		</div>

		<div class="regist-form-group">
			<label class="regist-label" for="pass2"><?php _e('regist.passwordConfirm'); ?></label>
			<input type="password" id="pass2" name="pass2" value="" class="regist-input" placeholder="<?php _e('regist.passwordConfirmPlaceholder'); ?>" required>
			<p class="regist-hint"><?php _e('regist.passwordHint'); ?></p>
		</div>

		<div class="regist-btn-group">
			<button type="submit" name="s" class="regist-btn regist-btn-primary"><?php _e('regist.submit'); ?></button>
			<button type="button" class="regist-btn regist-btn-secondary" onclick="history.back()"><?php _e('regist.back'); ?></button>
		</div>
	</div>
</div>

<?php
	echo "</div>";
	echo "<script type='text/javascript'>ALL_DIV.style.display = 'block';</script>";
?>

</form>
</body>
</html>
