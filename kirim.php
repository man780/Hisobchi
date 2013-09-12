<? 
include("blocks/bd.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="img/favicon(m).ico"> </link>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Kirim</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#zebra tbody tr:odd').css('background', '#f5f5f5');
	});
	
	$('#zebra tbody').mouseover(function(){
	    $(this).addClass('highlight');
	}).mouseout(function(){
	    $(this).removeClass('highlight');
	});
    //$('#delete a').click(alert("Aniq bu malumotni o`chirmoqchimisiz?"));
    
</script>

<style>
.kirim thead{
    border-bottom: 3px solid #0c0;
}
.kirim tfoot{
    color: #0c0;
    border-top: 3px solid #0c0;
}
h1{
    text-align: center;
    font-size: 30px;
    font-style: oblique;
    color: plum;
}
</style>
</head>

<body onload="$(function(){$('#zebra').fadeOut(100);});" onmousemove="$(function(){$('#zebra').fadeIn(900);});">
<br />
<table width="1000" align="center" id="main_border">
  <? include("blocks/head.php"); ?>
  
  <tr>
    <? include("blocks/lefttd.php"); ?>
	<td width="788" valign="top">
	<div id="chooseMonth">
	<form action="kirim.php" method="get">
		<? include("chooseMonth.php"); ?>
	</form>
	</div>
	<h1><b>Kirimlar jadvali</b></h1>
    <?
    if(isset($_GET["date"]))	{$date = $_GET["date"];}
		else	{$date = date("m");}
        //$date = $date-1;
    echo "<p class='oylar'><b>".$date." - oy bo`yicha kirim haqida ma`lumot.</b></p>";
    ?>
	<p><a id="newButton" href="new_kirim.php">Yangi kirim qo`shish</a></p>
	<? 
		
		$result = mysql_query("SELECT * FROM kirim WHERE MONTH(date)=".$date." ORDER BY date DESC",$db);
		
		if(!$result)
		{
		echo "<p>Zapros o`tmadi. Bu haqda adminga aytishingiz mumkin: man780@mail.ru<br> <b>Xatolik kodi:</b></p>";
		exit(mysql_error());
		}
        echo "<table id='zebra' class='kirim'>
		    <thead>
			<tr height='40'>
				<td>№</td>
				<td>Sana</td>
				<td>Kategoriya</td>
				<td>Ost Kategoriya</td>
				<td>Soni</td>
				<td>Summa</td>
				<td>Qo`shimcha</td>	
				<td>O`zgartirish</td>
				<td>O`chirish</td>
			</tr>
			</thead>";
		if(mysql_num_rows($result)>0)
		{		
    		$sum=0;
    		$i=1;
    		$myrow = mysql_fetch_array($result);
    		do{		
    			printf("
    			<tbody>
    			<tr>
					<td>%s</td>
					<td>%s</td>
    				<td>%s</td>
        			<td style='text-align:left'>%s</td>
    				<td style='text-align:right'>%s</td>			
    				<td style='text-align:right'>%s</td>
    				<td>%s</td>
    				<td id='edit'><a href='updateKirim.php?id=%s' alt='Edit'>Red</a></td>
    				<td id='delete'><a href='deleteKirimChiqim.php?id=%s&priz=k' alt='Edit'>Del</a></td>
    			</tr>
    			</tbody>
    			",$i,$myrow["date"],$myrow["cat_k"],$myrow["podcat_k"],$myrow["soni"],$myrow["sum_k"],$myrow["primech"],$myrow["id"],$myrow["id"]);
    			$i++;
    			$sum = $sum + $myrow["sum_k"];
    		}while($myrow = mysql_fetch_array($result));
		}
		else
		{
    		echo "<tr><td colspan='7'>So`rov bo`yicha ma`lumot olinmadi, yoki bu oyda hali kirim kiritilmagan.</td></tr>";
    		//exit();
		}
        echo "<tfoot><tr>
						<td colspan='5' align='right'>1 oylik kirim:</td>			
						<td>".$sum."</td>
						<td align='left' colspan='3'>so`m</td>
			</tr></tfoot></table>";
		?>
		</td>
  </tr>
  
  <? include("blocks/subcontent.php"); ?>
  <? include("blocks/footer.php"); ?>
</table>
</body>
</html>