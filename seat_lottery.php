<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>フリーアドレス 抽選</title>
<style>
:root {
	--primary-color: #2563eb;
	--primary-hover: #1d4ed8;
	--secondary-color: #64748b;
	--warning-color: #d97706;
	--warning-hover: #b45309;
	--background: #f8fafc;
	--card-bg: #ffffff;
	--text-primary: #1e293b;
	--text-secondary: #64748b;
	--border-color: #e2e8f0;
	--shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
	--radius: 8px;
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

.page-container {
	max-width: 600px;
	margin: 0 auto;
}

.page-card {
	background: var(--card-bg);
	border-radius: var(--radius);
	box-shadow: var(--shadow);
	padding: 32px;
	margin-bottom: 20px;
}

.page-title {
	font-size: 24px;
	font-weight: 700;
	color: var(--text-primary);
	margin: 0 0 24px 0;
	text-align: center;
	padding-bottom: 16px;
	border-bottom: 3px solid var(--warning-color);
}

.form-group {
	margin-bottom: 24px;
}

.form-label {
	display: block;
	font-size: 16px;
	font-weight: 600;
	color: var(--text-secondary);
	margin-bottom: 8px;
}

.form-input {
	width: 100%;
	padding: 16px 20px;
	font-size: 24px;
	border: 2px solid var(--border-color);
	border-radius: var(--radius);
	text-align: center;
	transition: border-color 0.2s, box-shadow 0.2s;
}

.form-input:focus {
	outline: none;
	border-color: var(--warning-color);
	box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.1);
}

.form-actions {
	display: flex;
	gap: 12px;
	margin-top: 24px;
}

.btn {
	flex: 1;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	padding: 16px 24px;
	font-size: 18px;
	font-weight: 600;
	border: none;
	border-radius: var(--radius);
	cursor: pointer;
	transition: all 0.2s;
}

.btn-warning {
	background: var(--warning-color);
	color: white;
}

.btn-warning:hover {
	background: var(--warning-hover);
}

.btn-secondary {
	background: var(--secondary-color);
	color: white;
}

.btn-secondary:hover {
	background: #475569;
}

.tenkey-grid {
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 8px;
	margin-top: 24px;
}

.tenkey-btn {
	display: flex;
	align-items: center;
	justify-content: center;
	padding: 20px;
	font-size: 28px;
	font-weight: 700;
	border: none;
	border-radius: var(--radius);
	cursor: pointer;
	transition: all 0.2s;
	background: var(--primary-color);
	color: white;
}

.tenkey-btn:hover {
	background: var(--primary-hover);
	transform: scale(1.02);
}

.tenkey-btn:active {
	transform: scale(0.98);
}

.tenkey-btn-clear {
	font-size: 16px;
}
</style>
</head>
<body onLoad="document.test.mid.focus()">
<form id="test" action="seat_lottery2.php">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>

<script type="text/javascript">
var inputPlace = "";
function onTenkey( num ){
	var fid = document.forms[0].id
	
	if( inputPlace == "" ){
		inputPlace = "mid";
	}

	var obj;
	if( num == "RET" ){
		obj = document.getElementById(inputPlace );
		obj.value = "";
		return;
	}
		 
	obj = document.getElementById(inputPlace );

	if( num == "BS" ){
		var str = obj.value;
		if( str.length > 0 ){
			obj.value = str.substr( 0, str.length -1 );
		}
	} else {
		obj.value += num;
	}
	 
}
 
function onNum(){
	inputPlace = "mid";
}
 
function onPass(){
	inputPlace = "pass";
}

function initFocusSet() {
	var fid = document.forms[0].id
	document.all.item("mid").focus();
}
</script>

<div class="page-container">
	<div class="page-card">
		<h1 class="page-title">フリーアドレス抽選</h1>
		
		<div class="form-group">
			<label class="form-label">社員番号</label>
			<input type="text" class="form-input" id="mid" name="mid" value="" onfocus="onNum()">
		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-warning">抽選する</button>
		</div>
		
		<div class="tenkey-grid">
			<button type="button" class="tenkey-btn" onclick="onTenkey('1');initFocusSet();">1</button>
			<button type="button" class="tenkey-btn" onclick="onTenkey('2');initFocusSet();">2</button>
			<button type="button" class="tenkey-btn" onclick="onTenkey('3');initFocusSet();">3</button>
			<button type="button" class="tenkey-btn" onclick="onTenkey('4');initFocusSet();">4</button>
			<button type="button" class="tenkey-btn" onclick="onTenkey('5');initFocusSet();">5</button>
			<button type="button" class="tenkey-btn" onclick="onTenkey('6');initFocusSet();">6</button>
			<button type="button" class="tenkey-btn" onclick="onTenkey('7');initFocusSet();">7</button>
			<button type="button" class="tenkey-btn" onclick="onTenkey('8');initFocusSet();">8</button>
			<button type="button" class="tenkey-btn" onclick="onTenkey('9');initFocusSet();">9</button>
			<button type="button" class="tenkey-btn tenkey-btn-clear" onclick="onTenkey('RET');initFocusSet();">クリア</button>
			<button type="button" class="tenkey-btn" onclick="onTenkey('0');initFocusSet();">0</button>
			<button type="button" class="tenkey-btn" onclick="onTenkey('BS');initFocusSet();">BS</button>
		</div>
		
		<div class="form-actions" style="margin-top: 16px;">
			<button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
		</div>
	</div>
</div>

<?php require "framework_tail.php"; ?>
</form>

<script>
initFocusSet();
</script>

</body>
</html>
