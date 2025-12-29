<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス 会社変更</title></head>
<body>
<form action="seat_companychange2.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>

<?php
	$param = new param();
	$company = $param->getParam($id, "COMPANY");

?>



<H1>会社名を変更する</H1>

<table>
	<tr>
		<td>
			会社名
		</td>
		<td>
			<input type="text" name="company" size="100" value="<?php echo $company ?>">
		</td>
	</tr>
</table>

<input type="submit" name="s" value="実行">

</p>



<?php require "framework_tail.php"; ?>
</form>
</body>
</html>

