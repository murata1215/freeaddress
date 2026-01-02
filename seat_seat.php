<?php require "lang/lang.php"; ?>
<!doctype html>
<html lang="<?php echo Lang::getInstance()->getCurrentLang(); ?>">
<head><meta charset="UTF-8"><title><?php _e('seatMap.title'); ?></title></head>
<body>
<form action="seat.php">
<?php require "framework_head.php"; ?>
<?php echo Lang::getInstance()->renderSwitcher(); ?>
<?php require "framework_body.php"; ?>


<style type="text/css">
	input.example {
	font-size:  50pt;
	height:     100%;
	width:      20%;
	border-style:none;
	}
	
	td.td1{
	text-align:center;
	}
	
</style>
<script type="text/javascript"><!--
function close_window(){
window.open('about:blank','_self').close();
} 
// --></script>



  <table>
  <tr>
  	<td>
  		<div>



<?php
require __DIR__ . '/vendor/autoload.php';

//	require_once './php-excel-reader-2.21/excel_reader2.php';

//	/var/www/htmlのパーミッション設定
//	semanage fcontext -a -t httpd_sys_rw_content_t /var/www/html
//	restorecon -R /var/www/html

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Html;
use PhpOffice\PhpSpreadsheet\Writer\Csv;




//EXCEL読み込みフィルター、セルの行・列取込制限を行う
//EXCELの表示範囲を枠線で囲わないと、挙動がおかしくなる
class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter {
	public $row_param = "";
	public $column_param = "";

    public function readCell($column, $row, $worksheetName = '') {

        $ret=false;
        //行は 1～29行目を取り込む
//        if ($row >= 1 && $row <= 29) {
        if ($row >= 1 && $row <= $this->row_param) {
            //列は A～BDを取り込む
            $column_len = strlen($column);
            if ($column_len == 1) {
                $column = "0".$column;
            }
//            if (strcmp($column, "BD")<=0) {
            if (strcmp($column, $this->column_param)<=0) {
                $ret=true;
            }
        }
        return $ret;
    }
}

if (!empty($id)) {

	require 'vendor/autoload.php';

	//リーダークラスを生成
	$reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();

	//フィルタの上限、下限をセット
	$param = new param();
	$row_param = $param->getParam($id,"viewRow");
	$column_param = mb_strtoupper($param->getParam($id,"viewColumn"));
	$filter = new MyReadFilter();
	$filter->row_param=$row_param;
	$filter->column_param=$column_param;

	//リードフィルターをセット
	$reader->setReadFilter( $filter );

	//ファイル名取得
	$param = new param();

	$fileName = $param->getParam($id,"FileName");

	//ファイル名を設定
	$spreadsheet = $reader->load("./upload/".$fileName);

	//グリッドラインを非表示
	$spreadsheet->getActiveSheet()->setShowGridlines(false);

	//シートを取り出し
	$sheet = $spreadsheet->getSheetByName("view");



	//excel内のすべての要素を確認する。（これをしないとグリッドが表示される）
	foreach ($sheet->getRowIterator() as $row) {
		foreach ($sheet->getColumnIterator() as $column) {
			if ($sheet->getCell($column->getColumnIndex().$row->getRowIndex())->getValue() != null) {
				;
			}
		}
	}



	//スプレッドシートをHTMLに変換
	$html = new Html($spreadsheet);

	//ヘッダ表示
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
//スタイル設定
if (!empty($id)) {
	echo $html->generateStyles(false); // do not write <style> and </style>
}
?>

-->
</style>

<?php
//ボディ表示
if (!empty($id)) {
	echo $html->generateSheetData();
}
//フッタ表示
if (!empty($id)) {
	echo $html->generateHTMLFooter();
}
?>




		</div>
  	</td>
  </tr>
  <tr>
  <td class="td1">
  	<input type="submit" class="example" value="<?php _e('common.close'); ?>"/>
  </td>
  </tr>
  </table>





<?php require "framework_tail.php"; ?>
</form>
</body>
</html>

