<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス アップロード</title></head>
<body>
<form action="seat_manage2.php" enctype="multipart/form-data" method="post">

<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>



<?php 

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	if(isset($_POST['id'])) {
		$id = $_POST['id'];
	}

	//元ファイル名の先頭にアップロード日時を加える
	$newfilename = $id."-".date("Ymd-His")."-seat.xlsx";
//	$newfilename = $id."-".date("Ymd-His")."-".$_FILES['file_upload']['name'];
	//ファイルの保存先
	$upload = './upload/'.$newfilename;
	//アップロードが正しく完了したかチェック
	if(move_uploaded_file($_FILES['file_upload']['tmp_name'], $upload)){
		echo 'アップロード完了';

		//新ファイルチェック
		if (check($newfilename) == true) {
			echo "正確なファイルがアップロードされました";

			//元ファイル削除
			$param = new param();
			$fileName = $param->getParam($id,"FileName");

			if (strcmp($fileName,"")!=0) {
				unlink("./upload/".$fileName);
			}

			//新ファイル名を設定ファイルに保存
			$param->setParam($id,"FileName",$newfilename);

			$rows = update($id, $newfilename);
			$rows2 = update2($id, $newfilename);
			update3($id, $newfilename);

		} else {
			echo "アップロードファイルは正しくないです";
			unlink($newfilename);
		}




	}else{
		echo 'アップロード失敗';
	}


	function check($newfilename){

		//リーダークラスを生成
		$reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		//ファイル名を設定
		$spreadsheet = $reader->load("./upload/".$newfilename);
		//グリッドラインを非表示
		$spreadsheet->getActiveSheet()->setShowGridlines(false);
		//シートを取り出し
		$sheet = $spreadsheet->getSheetByName("seat");
		if ($sheet == null) {
			echo "「seat」がありません";
			return false;
		}
		//シートを取り出し
		$sheet = $spreadsheet->getSheetByName("member");
		if ($sheet == null) {
			echo "「member」がありません";
			return false;
		}
		//シートを取り出し
		$sheet = $spreadsheet->getSheetByName("view");
		if ($sheet == null) {
			echo "「view」がありません";
			return false;
		}
		return true;

	}


	function update($id, $newfilename){

		$dao = new db();
		$dao->connect();

		$rows = array();

		//リーダークラスを生成
		$reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		//ファイル名を設定
		$spreadsheet = $reader->load("./upload/".$newfilename);
		//グリッドラインを非表示
		$spreadsheet->getActiveSheet()->setShowGridlines(false);
		//シートを取り出し
		$sheet = $spreadsheet->getSheetByName("seat");

		error_log("id = " . $id);

		$dao->exec("DELETE FROM seat WHERE id='".$id."'");

		//excel内のすべての要素を取り出す（行、列）
		$count = 0;
		foreach ($sheet->getRowIterator() as $row) {
			$col = 0;
			$seatid = "";
			$mid = "";
			foreach ($sheet->getColumnIterator() as $column) {
				//EXCELのセルIDを取得
				$excelid = $column->getColumnIndex().$row->getRowIndex();
				if ($col == 0) {
					//EXCEL内に記述している席IDを取得
					$seatid = $sheet->getCell($excelid)->getValue();
				}
				if ($col == 1) {
					//EXCEL内に記述しているメンバーIDを取得
					$mid = $sheet->getCell($excelid)->getValue();
				}
				if ($col == 2) {
					//EXCEL内に記述している備考１を取得
					$biko1 = $sheet->getCell($excelid)->getValue();
				}
				if ($col == 3) {
					//EXCEL内に記述している備考２を取得
					$biko2 = $sheet->getCell($excelid)->getValue();
				}
				if ($col == 4) {
					//EXCEL内に記述している備考３を取得
					$biko3 = $sheet->getCell($excelid)->getValue();
				}
				$col = $col + 1;
			}
			
			$row = array();
			$row['SEATID'] = $seatid;
			$row['MID'] = $mid;
			$row['BIKO1'] = $biko1;
			$row['BIKO2'] = $biko2;
			$row['BIKO3'] = $biko3;

			if ($count > 0 && $seatid != '') {
				error_log("sql = " . "INSERT INTO seat (id, seatid, mid, biko1, biko2, biko3) VALUES ('".$id."', '".$seatid."','".$mid."','".$biko1."','".$biko2."','".$biko3."')");
				$dao->exec("INSERT INTO seat (id, seatid, mid, biko1, biko2, biko3) VALUES ('".$id."', '".$seatid."','".$mid."','".$biko1."','".$biko2."','".$biko3."')");
				$rows[] = $row;
			}
			$count=$count+1;
		}

		$dao->close();

		return $rows;
	}

	function update2($id, $newfilename){

		$dao = new db();
		$dao->connect();

		$rows2 = array();
		//リーダークラスを生成
		$reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		//ファイル名を設定
		$spreadsheet = $reader->load("./upload/".$newfilename);
		//グリッドラインを非表示
		$spreadsheet->getActiveSheet()->setShowGridlines(false);
		//シートを取り出し
		$sheet = $spreadsheet->getSheetByName("member");

		$dao->exec("DELETE FROM member WHERE id='".$id."'");

		//excel内のすべての要素を取り出す（行、列）
		$count = 0;
		foreach ($sheet->getRowIterator() as $row) {
			$col = 0;
			$mid = "";
			$name = "";
			$kana = "";
			$phone = "";
			$seat_range = "";
			foreach ($sheet->getColumnIterator() as $column) {
				//EXCELのセルIDを取得
				$excelid = $column->getColumnIndex().$row->getRowIndex();
				if ($col == 0) {
					//EXCEL内に記述している席IDを取得
					$mid = $sheet->getCell($excelid)->getValue();
				}
				if ($col == 1) {
					//EXCEL内に記述しているメンバーIDを取得
					$name = $sheet->getCell($excelid)->getValue();
				}
				if ($col == 2) {
					//EXCEL内に記述しているカナを取得
					$kana = $sheet->getCell($excelid)->getValue();
				}
				if ($col == 3) {
					//EXCEL内に記述している電話を取得
					$phone = $sheet->getCell($excelid)->getValue();
				}
				if ($col == 4) {
					//EXCEL内に記述しているSEAT_RANGEを取得
					$seat_range = $sheet->getCell($excelid)->getValue();
				}
				if ($col == 5) {
					//EXCEL内に記述している備考１を取得
					$biko1 = $sheet->getCell($excelid)->getValue();
				}
				if ($col == 6) {
					//EXCEL内に記述している備考２を取得
					$biko2 = $sheet->getCell($excelid)->getValue();
				}
				if ($col == 7) {
					//EXCEL内に記述している備考３を取得
					$biko3 = $sheet->getCell($excelid)->getValue();
				}
				$col = $col + 1;
			}
			
			$row2 = array();
			$row2['MID'] = $mid;
			$row2['NAME'] = $name;
			$row2['KANA'] = $kana;
			$row2['PHONE'] = $phone;
			$row2['SEAT_RANGE'] = $seat_range;
			$row2['BIKO1'] = $biko1;
			$row2['BIKO2'] = $biko2;
			$row2['BIKO3'] = $biko3;

			if ($count > 0 && $mid != '') {
				error_log("INSERT INTO member (id, mid, name, kana, phone, seat_range, biko1, biko2, biko3) VALUES ('".$id."', '".$mid."', '".$name."', '".$kana."','".$phone."','".$seat_range."','".$biko1."','".$biko2."','".$biko3."')");
				$dao->exec("INSERT INTO member (id, mid, name, kana, phone, seat_range, biko1, biko2, biko3) VALUES ('".$id."', '".$mid."', '".$name."', '".$kana."','".$phone."','".$seat_range."','".$biko1."','".$biko2."','".$biko3."')");
				$rows2[] = $row2;
			}
			$count=$count+1;
		}

		$dao->close();

		return $rows2;
	}

	function update3($id, $newfilename){

		$dao = new db();
		$dao->connect();

		$rows2 = array();
		//リーダークラスを生成
		$reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		//ファイル名を設定
		$spreadsheet = $reader->load("./upload/".$newfilename);
		//グリッドラインを非表示
		$spreadsheet->getActiveSheet()->setShowGridlines(false);
		//シートを取り出し
		$sheet = $spreadsheet->getSheetByName("view");
		//excel内のすべての要素を取り出す（行、列）
		$count = 0;
		$bak_column = "";
		
		foreach ($sheet->getRowIterator() as $row) {
			foreach ($sheet->getColumnIterator() as $column) {
				//EXCELのセルIDを取得
				$excelid = $column->getColumnIndex().$row->getRowIndex();
				$value = $sheet->getCell($excelid)->getValue();
				if (strcmp($value,"END")==0) {
					echo $excelid;

					$param = new param();
					$param->setParam($id,"viewRow",$row->getRowIndex());
					$param->setParam($id,"viewColumn",$bak_column);
				}
				$bak_column=$column->getColumnIndex();
			}
		}
	}

?>






<H1>マスタアップロード結果</H1>


<table>
<tr>
	<td valign="top">
		<table border='1'>
		<tr><th>seatid</th><th>mid</th><th>biko1</th><th>biko2</th><th>biko3</th></tr>
		 
		<?php 
		foreach($rows as $row){
		?> 
		<tr> 
			<td><?php echo htmlspecialchars($row['SEATID'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td><?php echo htmlspecialchars($row['MID'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td><?php echo htmlspecialchars($row['BIKO1'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td><?php echo htmlspecialchars($row['BIKO2'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td><?php echo htmlspecialchars($row['BIKO3'],ENT_QUOTES,'UTF-8'); ?></td> 
		</tr> 
		<?php 
		} 
		?>
		 
		</table>
		
	</td>
	<td valign="top">
		<table border='1'>
		<tr><th>mid</th><th>name</th><th>kana</th><th>phone</th><th>seat_range</th><th>biko1</th><th>biko2</th><th>biko3</th></tr>
		 
		<?php 
		foreach($rows2 as $row){
		?> 
		<tr> 
			<td><?php echo htmlspecialchars($row['MID'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td><?php echo htmlspecialchars($row['NAME'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td><?php echo htmlspecialchars($row['KANA'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td><?php echo htmlspecialchars($row['PHONE'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td><?php echo htmlspecialchars($row['SEAT_RANGE'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td><?php echo htmlspecialchars($row['BIKO1'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td><?php echo htmlspecialchars($row['BIKO2'],ENT_QUOTES,'UTF-8'); ?></td> 
			<td><?php echo htmlspecialchars($row['BIKO3'],ENT_QUOTES,'UTF-8'); ?></td> 
		</tr> 
		<?php 
		} 
		?>
		 
		</table>
		
	</td>
</tr>
</table>






<input type="submit" value="戻る">




<?php require "framework_tail.php"; ?>
</form>
</body>
</html>

