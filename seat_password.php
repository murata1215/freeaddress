<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス パスワード</title></head>
<body>
<form action="seat_password2.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>




<H1>パスワードを変更する</H1>

<table>
	<tr>
		<td>
			現在のパスワードを入力
		</td>
		<td>
			<input type="password" name="pass0" value="">
		</td>
	</tr><tr>
		<td>
			新しいパスワードを入力
		</td>
		<td>
			<input type="password" name="pass1" value="">
		</td>
	</tr><tr>
		<td>
			新しいパスワードを入力（確認）
		</td>
		<td>
			<input type="password" name="pass2" value="">
		</td>
	</tr>
</table>

<input type="submit" name="s" value="実行">

</p>



<?php require "framework_tail.php"; ?>
</form>
</body>
</html>

