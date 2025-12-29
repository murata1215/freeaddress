<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス アップロード</title></head>
<body>
<form action="seat_upload2.php" enctype="multipart/form-data" method="post">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>




<H1>マスタアップロード</H1>
<input name="file_upload" type="file" />
<input type="submit" value="アップロード" />





<?php require "framework_tail.php"; ?>
</form>
</body>
</html>

