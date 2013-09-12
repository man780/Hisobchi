<? 
include("blocks/bd.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="img/favicon(m).ico"> </link>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Chiqim</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('#zebra tbody tr:even').css('background', '#eee');       
		$('#zebra').hover($('#zebra tbody tr').toggleClass("highlight"));
		$('#edit').mouseover();		
	});
</script>
<style>
.chiqim thead{
    border-bottom: 3px solid #c00;
}
.chiqim tfoot{
    color: #f00;
    border-top: 3px solid #c00;
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
	<form action="chiqim.php" method="get" >
		<? include("chooseMonth.php"); ?>
	</form>
	</div>
	<h1><b>Chiqimlar jadvali</b></h1>
    <?
    if(isset($_GET["date"]))	{$date = $_GET["date"];}
		else	{$date = date("n");}
//        $date = $date-1;
    echo "<p class='oylar'><b>".$date." - oy bo`yicha chiqimlar haqida ma`lumot.</b></p>";
    ?>
	<p><a id="newButton" href="new_chiqim.php">Yangi chiqim qo`shish</a></p>
		<?
		$result = mysql_query("SELECT * FROM chiqim WHERE MONTH(date)=".$date." ORDER BY date DESC",$db);		
		//echo "<span style='visibility:hidden' id='help'>Bu tugma ko`rsatilganni o`zgartiradi!</span>";
		
		if(!$result)
		{
		echo "<p>Zapros o`tmadi. Bu haqda adminga aytishingiz mumkin: man780@mail.ru<br> <b>Xatolik kodi:</b></p>";
		exit(mysql_error());
		}
        echo "<table id='zebra' class='chiqim'>
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
    				<td style='text-align:left'>%s</td>
    				<td style='text-align:left'>%s</td>
    				<td style='text-align:right'>%s</td>			
    				<td style='text-align:right'>%s</td>
    				<td>%s</td>
    				<td id='edit'><a href='updateChiqim.php?id=%s' alt='Edit'>Red</a></td>
    				<td id='delete'><a href='deleteKirimChiqim.php?id=%s&priz=ch' alt='Edit'>Del</a></td>
    			</tr>
    			</tbody>
    			",$i,$myrow["date"],$myrow["cat_c"],$myrow["podcat_c"],$myrow["soni"],
                $myrow["sum_c"],$myrow["primech"],$myrow["id"],$myrow["id"]);
    			$i++;
    			$sum = $sum + $myrow["sum_c"];
    		}while($myrow = mysql_fetch_array($result));
		}
		else
		{
    		echo "<tr><td colspan='7'>So`rov bo`yicha ma`lumot olinmadi, yoki bu oyda hali chiqim kiritilmagan.</td></tr>";
    		exit();
		}
        echo "<tfoot><tr>
						<td colspan='5' align='right'>1 oylik chiqim:</td>			
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