<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス メール変更</title></head>
<body>
<form action="seat_mailchange2.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>




<H1>メールアドレスを変更する</H1>

<table>
	<tr>
		<td>
			メールアドレスを入力
		</td>
		<td>
			<input type="text" name="mail1" value="">
		</td>
	</tr><tr>
		<td>
			メールアドレスを入力（確認）
		</td>
		<td>
			<input type="text" name="mail2" value="">
		</td>
	</tr>
</table>

<input type="submit" name="s" value="実行">

</p>



<?php require "framework_tail.php"; ?>
</form>
</body>
</html>

