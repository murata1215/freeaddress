<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス 登録</title></head>
<body>
<form action="seat_regist2.php">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>




<H1>利用者登録する</H1>

<table>
	<tr>
		<td>
			メールアドレスを入力
		</td>
		<td>
			<input type="text" name="mail" value="">
		</td>
	</tr><tr>
		<td>
			パスワードを入力
		</td>
		<td>
			<input type="password" name="pass1" value="">
		</td>
	</tr><tr>
		<td>
			パスワードを入力（確認）
		</td>
		<td>
			<input type="password" name="pass2" value="">
		</td>
	</tr>
</table>

<input type="submit" name="s" value="実行">

</p>



<?php

	echo "</div>";
	echo "<script type='text/javascript'>ALL_DIV.style.display = 'block';</script>";
?>


</form>
</body>
</html>

