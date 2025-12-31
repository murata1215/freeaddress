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
	--success-color: #059669;
	--success-hover: #047857;
	--warning-color: #d97706;
	--warning-hover: #b45309;
	--danger-color: #dc2626;
	--danger-hover: #b91c1c;
	--background: #f8fafc;
	--card-bg: #ffffff;
	--text-primary: #1e293b;
	--text-secondary: #64748b;
	--border-color: #e2e8f0;
	--shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
	--radius: 8px;
}

.manage-container {
	max-width: 600px;
	margin: 40px auto;
	padding: 0 20px;
}

.manage-card {
	background: var(--card-bg);
	border-radius: var(--radius);
	box-shadow: var(--shadow);
	padding: 32px;
	margin-bottom: 24px;
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

.manage-section {
	margin-bottom: 24px;
}

.manage-section-title {
	font-size: 14px;
	font-weight: 600;
	color: var(--text-secondary);
	text-transform: uppercase;
	letter-spacing: 0.5px;
	margin-bottom: 12px;
	padding-bottom: 8px;
	border-bottom: 1px solid var(--border-color);
}

.manage-btn {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	padding: 12px 24px;
	font-size: 15px;
	font-weight: 600;
	border: none;
	border-radius: var(--radius);
	cursor: pointer;
	transition: all 0.2s;
	text-decoration: none;
	box-sizing: border-box;
	width: 100%;
	margin-bottom: 10px;
}

.manage-btn:last-child {
	margin-bottom: 0;
}

.manage-btn-primary {
	background: var(--primary-color);
	color: white;
}

.manage-btn-primary:hover {
	background: var(--primary-hover);
	transform: translateY(-1px);
	box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.manage-btn-success {
	background: var(--success-color);
	color: white;
}

.manage-btn-success:hover {
	background: var(--success-hover);
	transform: translateY(-1px);
	box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
}

.manage-btn-warning {
	background: var(--warning-color);
	color: white;
}

.manage-btn-warning:hover {
	background: var(--warning-hover);
	transform: translateY(-1px);
	box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
}

.manage-btn-secondary {
	background: var(--secondary-color);
	color: white;
}

.manage-btn-secondary:hover {
	background: var(--secondary-hover);
}

.manage-btn-outline {
	background: transparent;
	color: var(--primary-color);
	border: 2px solid var(--primary-color);
}

.manage-btn-outline:hover {
	background: var(--primary-color);
	color: white;
}

.manage-link-list {
	list-style: none;
	padding: 0;
	margin: 0;
}

.manage-link-item {
	margin-bottom: 8px;
}

.manage-link-item:last-child {
	margin-bottom: 0;
}

.manage-link {
	display: flex;
	align-items: center;
	padding: 12px 16px;
	background: var(--background);
	border-radius: var(--radius);
	color: var(--primary-color);
	text-decoration: none;
	font-weight: 500;
	transition: all 0.2s;
	border: 1px solid var(--border-color);
}

.manage-link:hover {
	background: var(--primary-color);
	color: white;
	border-color: var(--primary-color);
}

.manage-link-icon {
	margin-right: 12px;
	font-size: 18px;
}

.manage-error {
	background: #fef2f2;
	border: 1px solid #fecaca;
	border-radius: var(--radius);
	padding: 20px;
	text-align: center;
	margin-bottom: 20px;
}

.manage-error-text {
	color: var(--danger-color);
	font-weight: 600;
	margin-bottom: 8px;
}

.manage-error-hint {
	color: var(--text-secondary);
	font-size: 14px;
	margin-bottom: 16px;
}

.manage-btn-group {
	display: flex;
	gap: 12px;
}

.manage-btn-group .manage-btn {
	flex: 1;
	margin-bottom: 0;
}
</style>
</head>
<body style="background: var(--background); margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
<form id='form' name='form' action="seat.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>

<script type="text/javascript">
    function goServletA(){
        document.getElementById('form').action="seat_owasure.php";
    }
    function goServletB(){
        document.getElementById('form').action="seat_mailchange.php";
    }
    function goServletC(){
        document.getElementById('form').action="seat_password.php";
    }
    function goServletD(){
        document.getElementById('form').action="seat_upload.php";
    }
    function goServletE(){
        document.getElementById('form').action="seat_companychange.php";
    }
    function goServletF(){
        document.getElementById('form').action="";
    }
</script>

<div class="manage-container">
<?php

	if(isset($_GET['pass'])) {
		$pass = $_GET['pass'];
	}
	if(isset($_POST['pass'])) {
		$pass = $_POST['pass'];
	}

	$dao = new db();
	$dao->connect();

	//ファイル名取得
	$param = new param();
	$param_password = $param->getParam($id,"PASSWORD");

	if (strcmp($pass, $param_password)==0 || strcmp($password, $param_password)==0) {
		$password = $param_password;

		echo "
		<script type='text/javascript'>
		document.getElementById('password').value='$param_password';
		</script>
		";

		//パスワードが一致した
		$param = new param();
		$fileName = $param->getParam($id,"FileName");
		
		echo "<div class='manage-card'>";
		echo "<h1 class='manage-title'>管理者ページ</h1>";
		
		// ダウンロードセクション
		echo "<div class='manage-section'>";
		echo "<div class='manage-section-title'>マスタデータ</div>";
		echo "<a href='./upload/sample-seat.xlsx' download='sample-seat.xlsx' class='manage-btn manage-btn-outline'>サンプルマスタダウンロード</a>";
		echo "<a href='./upload/".$fileName."' download='".$id."-seat.xlsx' class='manage-btn manage-btn-success'>マスタダウンロード</a>";
		echo "</div>";
		
		// 設定変更セクション
		echo "<div class='manage-section'>";
		echo "<div class='manage-section-title'>設定変更</div>";
		echo "<button type='submit' class='manage-btn manage-btn-primary' onclick='goServletB();'>メールアドレス変更</button>";
		echo "<button type='submit' class='manage-btn manage-btn-primary' onclick='goServletC();'>パスワード変更</button>";
		echo "<button type='submit' class='manage-btn manage-btn-primary' onclick='goServletE();'>会社名変更</button>";
		echo "<button type='submit' class='manage-btn manage-btn-warning' onclick='goServletD();'>マスタアップロード</button>";
		echo "</div>";
		
		// URLリンクセクション
		echo "<div class='manage-section'>";
		echo "<div class='manage-section-title'>各種URL</div>";
		echo "<ul class='manage-link-list'>";
		echo "<li class='manage-link-item'><a href='seat.php?id=".$id."' class='manage-link'><span class='manage-link-icon'>&#128100;</span>一般用フリーアドレス画面</a></li>";
		echo "<li class='manage-link-item'><a href='seat.php?id=".$id."&manage=true' class='manage-link'><span class='manage-link-icon'>&#128736;</span>管理者画面</a></li>";
		echo "<li class='manage-link-item'><a href='seat_result.php?id=".$id."' class='manage-link'><span class='manage-link-icon'>&#128203;</span>着席リスト</a></li>";
		echo "<li class='manage-link-item'><a href='seat_member.php?id=".$id."' class='manage-link'><span class='manage-link-icon'>&#128101;</span>メンバーリスト</a></li>";
		echo "</ul>";
		echo "</div>";
		
		echo "<button type='submit' class='manage-btn manage-btn-secondary'>トップに戻る</button>";
		echo "</div>";
		
	} else {
		//パスワードが一致しない
		echo "<div class='manage-card'>";
		echo "<h1 class='manage-title'>管理者ページ</h1>";
		echo "<div class='manage-error'>";
		echo "<div class='manage-error-text'>パスワードが一致しません</div>";
		echo "<div class='manage-error-hint'>お忘れですか？</div>";
		echo "<button type='submit' class='manage-btn manage-btn-primary' onclick='goServletA();'>パスワードを確認する</button>";
		echo "</div>";
		echo "<button type='submit' class='manage-btn manage-btn-secondary'>戻る</button>";
		echo "</div>";
	}

	$dao->close();

?>
</div>

<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
