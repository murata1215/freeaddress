<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス 管理者ページ</title></head>
<body>
<form id='form' name='form' action="seat.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>



<H1>管理者ページ</H1>

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
		
		echo "<a href='./upload/sample-seat.xlsx' download='sample-seat.xlsx'>サンプルマスタダウンロード</a></p>";
		echo "<a href='./upload/".$fileName."' download='".$id."-seat.xlsx'>マスタダウンロード</a></p>";


		echo "<button type='submit' onclick='goServletB();'>メールアドレス変更</button></p>";
		echo "<button type='submit' onclick='goServletC();'>パスワード変更</button></p>";
		echo "<button type='submit' onclick='goServletE();'>会社名変更</button></p>";
		echo "<button type='submit' onclick='goServletD();'>マスタアップロード</button></p>";

		echo "<a href='seat.php?id=".$id."'>一般用フリーアドレス画面URL</a></p>";
		echo "<a href='seat.php?id=".$id."&manage=true'>管理者画面URL</a></p>";
		echo "<a href='seat_result.php?id=".$id."'>着席リストURL</a></p>";
		echo "<a href='seat_member.php?id=".$id."'>メンバーリストURL</a></p>";
		
	} else {
		//パスワードが一致しない
		echo "パスワードが一致しません<p>";
		echo "お忘れですか？<p>";
		echo "<button type='submit' onclick='goServletA();'>パスワードを確認する</button>";

	}





	$dao->close();

?>

</p>

<input type="submit" value="戻る">





<?php require "framework_tail.php"; ?>
</form>
</body>
</html>

