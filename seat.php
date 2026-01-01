<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>フリーアドレス メニュー</title>
<style>
:root {
	--primary-color: #2563eb;
	--primary-hover: #1d4ed8;
	--secondary-color: #64748b;
	--success-color: #059669;
	--success-hover: #047857;
	--warning-color: #d97706;
	--warning-hover: #b45309;
	--danger-color: #dc2626;
	--danger-hover: #b91c1c;
	--purple-color: #7c3aed;
	--purple-hover: #6d28d9;
	--olive-color: #65a30d;
	--olive-hover: #4d7c0f;
	--background: #f8fafc;
	--card-bg: #ffffff;
	--text-primary: #1e293b;
	--text-secondary: #64748b;
	--border-color: #e2e8f0;
	--shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
	--radius: 12px;
}

* {
	box-sizing: border-box;
}

body {
	background: var(--background);
	margin: 0;
	padding: 20px;
	font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
	min-height: 100vh;
}

.menu-container {
	max-width: 800px;
	margin: 0 auto;
	padding: 20px;
}

.menu-grid {
	display: grid;
	gap: 16px;
}

.menu-grid-2col {
	grid-template-columns: repeat(2, 1fr);
}

.menu-grid-3col {
	grid-template-columns: repeat(3, 1fr);
}

.menu-btn {
	display: flex;
	align-items: center;
	justify-content: center;
	padding: 32px 24px;
	font-size: 24px;
	font-weight: 700;
	border: none;
	border-radius: var(--radius);
	cursor: pointer;
	transition: all 0.2s;
	text-decoration: none;
	color: white;
	text-align: center;
	line-height: 1.4;
	min-height: 120px;
	box-shadow: var(--shadow);
}

.menu-btn:hover {
	transform: translateY(-2px);
	box-shadow: 0 8px 16px -4px rgba(0, 0, 0, 0.2);
}

.menu-btn:active {
	transform: translateY(0);
}

.menu-btn-primary {
	background: var(--primary-color);
}

.menu-btn-primary:hover {
	background: var(--primary-hover);
}

.menu-btn-warning {
	background: var(--warning-color);
}

.menu-btn-warning:hover {
	background: var(--warning-hover);
}

.menu-btn-success {
	background: var(--success-color);
}

.menu-btn-success:hover {
	background: var(--success-hover);
}

.menu-btn-purple {
	background: var(--purple-color);
}

.menu-btn-purple:hover {
	background: var(--purple-hover);
}

.menu-btn-olive {
	background: var(--olive-color);
}

.menu-btn-olive:hover {
	background: var(--olive-hover);
}

.menu-btn-danger {
	background: var(--danger-color);
}

.menu-btn-danger:hover {
	background: var(--danger-hover);
}

.menu-btn-secondary {
	background: var(--secondary-color);
}

.menu-btn-secondary:hover {
	background: #475569;
}

.menu-btn-large {
	font-size: 28px;
	padding: 40px 24px;
	min-height: 140px;
}

.menu-btn-full {
	grid-column: 1 / -1;
}

.menu-section {
	margin-bottom: 24px;
}

.menu-section-title {
	font-size: 14px;
	font-weight: 600;
	color: var(--text-secondary);
	text-transform: uppercase;
	letter-spacing: 0.5px;
	margin-bottom: 12px;
	padding-left: 4px;
}

@media (max-width: 600px) {
	.menu-btn {
		font-size: 18px;
		padding: 24px 16px;
		min-height: 100px;
	}
	
	.menu-btn-large {
		font-size: 22px;
		padding: 32px 16px;
	}
	
	.menu-grid-3col {
		grid-template-columns: repeat(2, 1fr);
	}
}
</style>
</head>
<body>
<form id='form' name='form' action="seat_lottery.php">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>

<script type="text/javascript">
	document.getElementById("dt").value = "";
	function goServletB(){
		document.getElementById('form').action="seat_away.php";
	}

	function goServletC(){
		document.getElementById('form').action="seat_seat.php";
	}

	function goServletD(){
		document.getElementById('form').action="seat_result.php";
	}

	function goServletE(){
		document.getElementById('form').action="seat_member.php";
	}

	function goServletF(){
		document.getElementById('form').action="seat_upload.php";
	}

	function goServletG(){
		document.getElementById('form').action="seat_regist.php";
	}

	function goServletH(){
		document.getElementById('form').action="seat_manage.php";
	}
</script>

<?php 

if (strcmp($id,"")==0) { echo "

<div class='menu-container'>
	<div class='menu-grid'>
		<button type='submit' class='menu-btn menu-btn-primary menu-btn-large menu-btn-full' onclick='goServletG();'>利用者登録をする</button>
	</div>
</div>

";}

else if (strcmp($manage,"true")==0) { echo "

<div class='menu-container'>
	<div class='menu-section'>
		<div class='menu-grid'>
			<button type='submit' class='menu-btn menu-btn-secondary menu-btn-full' onclick='goServletH();'>管理者ページ</button>
		</div>
	</div>
	
	<div class='menu-section'>
		<div class='menu-grid menu-grid-3col'>
			<button type='submit' class='menu-btn menu-btn-primary' onclick='goServletE();'>席・内線を<br>確認する</button>
			<button type='submit' class='menu-btn menu-btn-warning menu-btn-large'>フリーアドレスの<br>抽選を行う</button>
			<button type='submit' class='menu-btn menu-btn-success' onclick='goServletD();'>着席を確認する</button>
		</div>
	</div>
	
	<div class='menu-section'>
		<div class='menu-grid menu-grid-2col'>
			<button type='submit' class='menu-btn menu-btn-purple' onclick='goServletB();'>外出<br>(席を開放する)</button>
			<button type='submit' class='menu-btn menu-btn-olive' onclick='goServletC();'>座席表を見る</button>
		</div>
	</div>
</div>

";}

else { echo "

<div class='menu-container'>
	<div class='menu-section'>
		<div class='menu-grid menu-grid-3col'>
			<button type='submit' class='menu-btn menu-btn-primary' onclick='goServletE();'>席を確認する</button>
			<button type='submit' class='menu-btn menu-btn-warning menu-btn-large'>フリーアドレスの<br>抽選を行う</button>
			<button type='submit' class='menu-btn menu-btn-success' onclick='goServletD();'>着席を確認する</button>
		</div>
	</div>
	
	<div class='menu-section'>
		<div class='menu-grid menu-grid-2col'>
			<button type='submit' class='menu-btn menu-btn-purple' onclick='goServletB();'>外出<br>(席を開放する)</button>
			<button type='submit' class='menu-btn menu-btn-olive' onclick='goServletC();'>座席表を見る</button>
		</div>
	</div>
</div>

";} ?>

<?php require "framework_tail.php"; ?>

</form>

</body>
</html>
