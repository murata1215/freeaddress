<?php require "lang/lang.php"; ?>
<!doctype html>
<html lang="<?php echo Lang::getInstance()->getCurrentLang(); ?>">
<head><meta charset="UTF-8"><title><?php _e('seat.title'); ?></title></head>
<body>
<form id='form' name='form' action="seat_lottery.php" >
<?php require "framework_head.php"; ?>
<?php echo Lang::getInstance()->renderSwitcher(); ?>
<?php require "framework_body.php"; ?>

	<script type="text/javascript">
		document.getElementById("dt").value = "";
            function goServletA(){
                document.getElementById('form').action="seat_lottery.php";
            }

	    function goServletB(){
	        document.getElementById('form').action="seat_away.php";
	    }

	    function goServletC(){
	        document.getElementById('form').action="seat_seat.php";
	    }

	    function goServletD(){
	        document.getElementById('form').action="seat_result.php";
	    }

	    function goServletE(){
	        document.getElementById('form').action="seat_member.php";
	    }

	    function goServletF(){
	        document.getElementById('form').action="seat_upload.php";
	    }

	    function goServletG(){
	        document.getElementById('form').action="seat_regist.php";
	    }

	    function goServletH(){
	        document.getElementById('form').action="seat_manage.php";
	    }
	</script>

	<style>
	  html, body, form, div { height: 98% }
	</style>

	<style type="text/css">

		input.example {
			font-size:  50pt;
			height:     120;
			width:      100%;
		}

		button.BTN11 {
			font-size:  50pt;
			height:100%;
			width:99%;
			border-style:none;
			background-color:#3498db;
			text-align:centert;
			color:white;
		}

		button.BTN21 {
			font-size:  50pt;
			height:99%;
			width:      98%;
			border-style:none;
			background-color:#3498db;
			text-align:   centert;
			color:white;
		}

		button.BTN22 {
			font-size:  50pt;
			height:99%;
			width:      98%;
			border-style:none;
			background-color:#e8aa00;
			text-align:  center;
			color:white;
		}

		button.BTN23 {
			font-size: 50pt;
			height:99%;
			width:      98%;
			border-style:none;
			background-color:green;
			text-align:   center;
			color:white;
		}

		button.BTN31 {
			font-size: 33pt;
			height:95%;
			width:      98%;
			border-style:none;
			background-color:#8e18a5;
			text-align:   center;
			color:white;
		}

		button.BTN32 {
			font-size:  40pt;
			height:99%;
			width:      98%;
			border-style:none;
			background-color:#69c621;
		    text-align:   centert;
			color:white;
		}

		button.BTN41 {
			font-size: 33pt;
			height:95%;
			width:      98%;
			border-style:none;
			background-color:red;
			text-align:   center;
			color:white;
		}

		button.BTN42 {
			font-size: 50pt;
			height:95%;
			width:      99%;
			border-style:none;
			background-color:#808000;
			text-align:   center;
			color:white;
		}


		table{
			table-layout: fixed;
		}

		td.td11{
			height:100%;
			width:33%;
			text-align:center;
			padding-top:10px;
		}

		td.td21{
			height:70%;
			width:33%;
			text-align:center;
			padding-top:10px;
		}

		td.td22{
			height:100%;
			width:33%;
			text-align:center;
			padding-top:10px;
		}

		td.td23{
			height:70%;
			width:33%;
			text-align:center;
			padding-top:10px;
		}

		td.td31{
			height:30%;
			width:33%;
			text-align:center;
			padding-top:5px;
		}

		td.td32{
			height:30%;
			width:33%;
			text-align:center;
			padding-top:5px;
		}

		td.td41{
			height:100%;
			width:50%;
			text-align:center;
			padding-top:5px;
		}

		td.td42{
			height:100%;
			width:50%;
			text-align:center;
			padding-top:5px;
		}

	</style>





<?php

if (strcmp($id,"")==0) { ?>

	<table align='center' width='100%' height='90%' style='display:none;'>

		<tr>
			<td colspan='3' class='td11'>
				<button type='submit' class='BTN11' onclick='goServletG();'><?php _e('seat.register'); ?></button>
			</td>
		</tr>

	</table>

<?php }

else if (strcmp($manage,"true")==0) { ?>

<table align='center' width='100%' height='30%'>

		<tr>
			<td colspan='3' class='td42'>
				<button type='submit' class='BTN42' onclick='goServletH();'><?php _e('seat.adminPage'); ?></button>
			</td>
		</tr>

</table>

<table align='center' width='100%' height='70%'>

	<tr>
		<td class='td21'>
			<button type='submit' class='BTN21' onclick='goServletE();'><?php _e('seat.checkSeatExtension'); ?></button>
		</td>
		<td rowspan='2' class='td22'>
			<button type='submit' class='BTN22' onclick='goServletA();'><?php _e('seat.lottery'); ?></button>
		</td>
		<td class='td23'>
			<button type='submit' class='BTN23' onclick='goServletD();'><?php _e('seat.confirmSeat'); ?></button>
		</td>
	</tr>
	<tr>
		<td class='td31'>
			<button type='submit' class='BTN31' onclick='goServletB();'><?php _e('seat.away'); ?></button>
		</td>
		<td class='td32'>
			<button type='submit' class='BTN32' onclick='goServletC();'><?php _e('seat.seatMap'); ?></button>
		</td>
	</tr>

</table>

<?php }

else { ?>

	<table align='center' width='100%' height='100%'>

		<tr>
			<td class='td21'>
				<button type='submit' class='BTN21' onclick='goServletE();'><?php _e('seat.checkSeat'); ?></button>
			</td>
			<td rowspan='2' class='td22'>
				<button type='submit' class='BTN22' onclick='goServletA();'><?php _e('seat.lottery'); ?></button>
			</td>
			<td class='td23'>
				<button type='submit' class='BTN23' onclick='goServletD();'><?php _e('seat.confirmSeat'); ?></button>
			</td>
		</tr>
		<tr>
			<td class='td31'>
				<button type='submit' class='BTN31' onclick='goServletB();'><?php _e('seat.away'); ?></button>
			</td>
			<td class='td32'>
				<button type='submit' class='BTN32' onclick='goServletC();'><?php _e('seat.seatMap'); ?></button>
			</td>
		</tr>

	</table>

<?php } ?>




<?php require "framework_tail.php"; ?>


</form>


</body>

</html>

