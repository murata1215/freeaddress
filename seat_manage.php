<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス 管理者ページ</title></head>
<body>
<form action="seat_manage2.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>



<H1>管理者ページ</H1>

<table>
	<tr>
		<td>
			パスワードを入力
		</td>
		<td>
			<input type="password" id="pass" name="pass" value="" >
		</td>
		<td>
			<input type="submit" value="OK">
		</td>
	</tr><tr>
		<td>
			<button class="example2" type="button" onclick="history.back()">戻る</button>
		</td>
		<td>
		</td>
		<td>
		</td>
	</tr>
</table>


<?php require "framework_tail.php"; ?>
</form>
</body>
</html>

