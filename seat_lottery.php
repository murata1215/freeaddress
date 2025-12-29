<!doctype html>
<html lang="ja">
<head><meta charset="UTF-8"><title>フリーアドレス 抽選</title></head>
<body onLoad="document.test.mid.focus()">
<form id="test" action="seat_lottery2.php">
<?php require "framework_head.php"; ?>
<?php require "framework_body.php"; ?>

<style type="text/css">
	input.example1 {
	font-size:  50pt;
	height:     120;
	width:      100%;
	padding-top:20px;
	}

	button.example2 {
	font-size:  40pt;
	height:     120;
	width:      80%;
	padding-top:10px;
	}

	input.example2 {
	font-size:  40pt;
	height:     120;
	width:      100%;
	padding-top:10px;
	}
	
	table.brwsr1 {
    font-size:       12px;
    margin:          0 auto;
    border-collapse: separate;
    border-spacing:  0px 1px;
	}
	
	table.brwsr1 td {
    text-align: center;
    height:     125;
    }
	
	input.tenKey {
	font-family: "ＭＳ Ｐゴシック",sans-serif;
	font-size:      40pt;
	height:         90%;
	width:          90%;
	padding:        12px;
    vertical-align: middle;
    text-align:     centert;
    border-left:    #fff 1px solid;
    border-right:   #999 1px solid;
    background:     #3498db;
    color:          #fff;
	}
	 
	table.brwsr2 td{
	font-size:  40pt;
	align:      center;
	height:     120%;
	width:      30%;
	}
	
	table.brwsr2 td.td1 {
	position:      relative;
	padding:       .40em 0 .5em .40em;
	border-left:   20px solid #3498db;
	border-bottom: 1px solid #ccc;
	text-align:    justify;
	width:         30%;
	}
	
	table.brwsr2 td.tdx1{
	font-size:  50pt;
	align:      center;
	height:     120%;
	width:      2%;
	}
	
	table.brwsr2 td.tdx2{
	font-size:  50pt;
	align:      center;
	height:     120%;
	width:      3%;
	}
	
</style>
<script type="text/javascript"><!--
 	var inputPlace = "";
	function onTenkey( num ){
		var fid = document.forms[0].id
		
		if( inputPlace == "" ){
			inputPlace = "mid";
		}

		var obj;
		if( num == "RET" ){
			obj = document.getElementById(inputPlace );
			obj.value = "";
			return;
		}
			 
		obj = document.getElementById(inputPlace );

		if( num == "BS" ){
			var str = obj.value;
			if( str.length > 0 ){
				obj.value = str.substr( 0, str.length -1 );
			}
		} else {
			obj.value += num;
		}
		 
	}
	 
	function onNum(){
		inputPlace = "mid";
	}
	 
	function onPass(){
		inputPlace = "pass";
	}

	function initFocusSet() {
		var fid = document.forms[0].id
		document.all.item("mid").focus();
	}

// --></script>

      <table align="center" width="100%"class="brwsr2">
        <tr>
          <td class="tdx1"></td>
          <td class="td1">社員番号：</td>
          <td class="tdx2"></td>
          <td class="td2">
			<input type="text" class="example1" id="mid" name="mid" value="" onfocus="onNum()" >
          </td>
          <td class="tdx2"></td>
          <td colspan="2" align="center" class="td3">
			<input type="submit" class="example2" value="次へ" action="#{seat.exec}"/>
          </td>
          <td class="tdx2">
        </tr>
      </table>
      <br>

      <table width="100%" class="brwsr1">
        <tr>
          <td class="td1">
            <input type="button" value="   1   " class="tenKey" onclick="onTenkey('1');initFocusSet();">
          </td>
          <td class="td1">
            <input type="button" value="   2   " class="tenKey" onclick="onTenkey('2');initFocusSet();">
          </td>
          <td class="td1">
            <input type="button" value="   3   " class="tenKey" onclick="onTenkey('3');initFocusSet();">
          </td>
        </tr>
        <tr>
          <td class="td1">
            <input type="button" value="4" class="tenKey" onclick="onTenkey('4');initFocusSet();">
          </td>
          <td class="td1">
            <input type="button" value="5" class="tenKey" onclick="onTenkey('5');initFocusSet();">
          </td>
          <td class="td1">
            <input type="button" value="6" class="tenKey" onclick="onTenkey('6');initFocusSet();">
          </td>
        </tr>
        <tr>
          <td class="td1">
            <input type="button" value="7" class="tenKey" onclick="onTenkey('7');initFocusSet();">
          </td>
          <td class="td1">
            <input type="button" value="8" class="tenKey" onclick="onTenkey('8');initFocusSet();">
          </td>
          <td class="td1">
            <input type="button" value="9" class="tenKey" onclick="onTenkey('9');initFocusSet();">
          </td>
        </tr>
        <tr>
          <td class="td2">
            <input type="button" value="クリア" class="tenKey" onclick="onTenkey('RET');initFocusSet();">
          </td>
          <td class="td1">
            <input type="button" value="0" class="tenKey" onclick="onTenkey('0');initFocusSet();">
          </td>
          <td class="td2">
            <input type="button" value="BS" class="tenKey" onclick="onTenkey('BS');initFocusSet();">
          </td>
        </tr>
        <tr>
          <td class="td2">
          </td>
          <td class="td1">
			<button class="example2" type="button" onclick="history.back()">戻る</button>
          </td>
          <td class="td2">
          </td>
        </tr>
      </table>


<?php require "framework_tail.php"; ?>
</form>
</body>

<script>
initFocusSet();
// --></script>

</html>

