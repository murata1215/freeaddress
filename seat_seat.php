<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>フリーアドレス 席リスト</title>
<style>
:root {
	--primary-color: #2563eb;
	--primary-hover: #1d4ed8;
	--secondary-color: #64748b;
	--background: #f8fafc;
	--card-bg: #ffffff;
	--text-primary: #1e293b;
	--text-secondary: #64748b;
	--border-color: #e2e8f0;
	--shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
	--radius: 8px;
}

* {
	box-sizing: border-box;
}

body {
	background: var(--background);
	margin: 0;
	padding: 20px;
	font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
}

.page-container {
	max-width: 1200px;
	margin: 0 auto;
}

.page-card {
	background: var(--card-bg);
	border-radius: var(--radius);
	box-shadow: var(--shadow);
	padding: 24px;
	margin-bottom: 20px;
}

.excel-container {
	overflow-x: auto;
	margin-bottom: 20px;
}

.footer-actions {
	text-align: center;
	padding: 20px 0;
}

.close-btn {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	padding: 16px 48px;
	font-size: 18px;
	font-weight: 600;
	border: none;
	border-radius: var(--radius);
	cursor: pointer;
	transition: all 0.2s;
	background: var(--secondary-color);
	color: white;
}

.close-btn:hover {
	background: #475569;
}
</style>
</head>
<body>
<form action="seat.php">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>

<script type="text/javascript">
function close_window(){
	window.open('about:blank','_self').close();
} 
</script>

<div class="page-container">
	<div class="page-card">
		<div class="excel-container">

<?php
require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Html;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter {
	public $row_param = "";
	public $column_param = "";

    public function readCell($column, $row, $worksheetName = '') {

        $ret=false;
        if ($row >= 1 && $row <= $this->row_param) {
            $column_len = strlen($column);
            if ($column_len == 1) {
                $column = "0".$column;
            }
            if (strcmp($column, $this->column_param)<=0) {
                $ret=true;
            }
        }
        return $ret;
    }
}

if (!empty($id)) {

	require 'vendor/autoload.php';

	$reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();

	$param = new param();
	$row_param = $param->getParam($id,"viewRow");
	$column_param = mb_strtoupper($param->getParam($id,"viewColumn"));
	$filter = new MyReadFilter();
	$filter->row_param=$row_param;
	$filter->column_param=$column_param;

	$reader->setReadFilter( $filter );

	$param = new param();

	$fileName = $param->getParam($id,"FileName");

	$spreadsheet = $reader->load("./upload/".$fileName);

	$spreadsheet->getActiveSheet()->setShowGridlines(false);

	$sheet = $spreadsheet->getSheetByName("view");



	foreach ($sheet->getRowIterator() as $row) {
		foreach ($sheet->getColumnIterator() as $column) {
			if ($sheet->getCell($column->getColumnIndex().$row->getRowIndex())->getValue() != null) {
				;
			}
		}
	}



	$html = new Html($spreadsheet);

	echo $html->generateHTMLHeader();

}

?>



<style>
<!--
html {
    font-family: Times New Roman;
    font-size: 9pt;
    background-color: white;
}

<?php
if (!empty($id)) {
	echo $html->generateStyles(false);
}
?>

-->
</style>

<?php
if (!empty($id)) {
	echo $html->generateSheetData();
}
if (!empty($id)) {
	echo $html->generateHTMLFooter();
}
?>

		</div>
	</div>

	<div class="footer-actions">
		<input type="submit" class="close-btn" value="閉じる"/>
	</div>
</div>

<?php require "framework_tail.php"; ?>
</form>
</body>
</html>
