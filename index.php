<?
include("blocks/bd.php");
echo md5("xor")."<br />";
try{
$conn = new PDO("mysql:host=localhost;dbname=hisobchi",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$result = mysql_query("SELECT title,text FROM settings WHERE page='index'",$db);

if(!$result)
{
echo "<p>Zapros o`tmadi. Bu haqda adminga aytishingiz mumkin: man780@mail.ru<br> <b>Xatolik kodi:</b></p>";
exit(mysql_error());
}
if(mysql_num_rows($result)>0)
{
$myrow = mysql_fetch_array($result);
}
else
{
echo "<p>Zapros bo`yicha ma`lumot olinmadi, jadvalda hech narsa yo`q.</p>";
exit();
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="shortcut icon" href="img/favicon(m).ico"/>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta name="description" content="<? echo $myrow["meta_d"]; ?>">
<meta name="keywords" content="<? echo $myrow["meta_k"]; ?>">
<title><? echo $myrow["title"]; ?></title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery-1.5.2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#zebra').slideToggle();
	});
    
    $(document).ready(function(){
		$('#zebra tbody tr:odd').css('background', '#f5f5f5');
	});
	
	$('#zebra tbody').mouseover(function(){
	    $(this).addClass('highlight');
	}).mouseout(function(){
	    $(this).removeClass('highlight');
	});
</script>
</head> <body>
<br />
<table width="1000" align="center" id="main_border">
  <? include("blocks/head.php"); ?>
	<tr>
    <? include("blocks/lefttd.php"); ?>
    <td width="788" valign="top">
	
	<div id="chooseMonth">
    
	<form action="index.php" method="get">
		<? include("chooseMonth.php"); ?>
	</form>
	</div>
		<? echo $myrow["text"];
		if(isset($_GET["date"]))	{$date = $_GET["date"];}
		else	{$date = date("m");}
            //Kirimlar bo`yicha
            $ksum = 0;
            //echo "<br>Kirimlar bo`yicha";
            $sqlk = "select date,sum_k from kirim WHERE MONTH(date)=$date";
            $rkirim = $conn->prepare($sqlk);
            $rkirim->execute ();  
            $tdata = $rkirim->fetchAll ();  
            foreach ($tdata as $row){
                //любые действия например  
                //echo "<p><b>".$row['date']."</b> - ".$row['sum']."</p>";
                $ksum += $row['sum_k'];
            }             	
            //Chiqimlar bo`yicha
            $csum = 0;
            //echo "Chiqimlar bo`yicha";
            $sqlc = "select date,sum_c from chiqim WHERE MONTH(date)=$date";
            $rchiqim = $conn->prepare($sqlc);  
            $rchiqim->execute ();  
            $tdata = $rchiqim->fetchAll ();  
            foreach ($tdata as $row){  
                //любые действия например  
                //echo "<p><b>".$row['date']."</b> - ".$row['sum_c']."</p>";
                $csum += $row['sum_c'];  
            }             			
			if(is_null($ksum))$ksum=0;
			if(is_null($csum))$csum=0;
			$qoldiq = $ksum-$csum;
			echo "<p><b>".$date." - bo`yicha kirim va chiqimlar haqida ma`lumot.</b></p>";
			echo "<table width='120px'><tr><td><b style='color:#00f'>Kirim</td><td align='right'>".$ksum."</td></tr>
					<tr><td><b style='color:#00f'>Chiqim</td><td align='right'>".$csum."</td></tr>
					<tr><td><b style='color:#00f'>Qoldiq</td><td align='right'>".$qoldiq."</td></tr></table>";
 
 
                    }
catch(PDOException $e){
    echo "Ошибка: ".$e->getMessage();
}
		?>
		

<a href="test.php">test</a>
	</td>
  </tr>
  <? include("blocks/subcontent.php"); ?>
  <? include("blocks/footer.php"); ?>
</table>
</body>
</html>