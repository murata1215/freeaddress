<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス 会社変更</title></head>
<body>
<form action="seat_manage2.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>





<H1>会社名を変更する</H1>

<?php

if(isset($_GET['company'])) {
	$company = $_GET['company'];
}
if(isset($_POST['company'])) {
	$company = $_POST['company'];
}



$dao = new db();
$dao->connect();


//設定ファイルにメールを格納
echo "会社名を「".$company."」に変更しました";
$param = new param();
$param->setParam($id, "COMPANY", $company);


$dao->close();

?>

<input type="submit" name="s" value="終了">

</p>





<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
