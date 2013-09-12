<? 
//include("blocks/bd.php");
$username = "admin";
$password = "123456";

try{
$conn = new PDO("mysql:host=localhost;dbname=hisob",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Chiqim</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script>
    $(document).ready(function(){        
        $(".bugun").hover(firstClickHendler,secondClickHendler);                
	});	
    function firstClickHendler(eventObject){        
        $("#bugun").fadeIn(500);
    }
    function secondClickHendler(eventObject){        
        $("#bugun").fadeOut(500);
    }
        
</script>
<style>
    #oy a{
        color: #ccc;
        text-decoration: none;
    }
    .day{
        font-family: fantasy;
    }
    .bugun{
        background: #555;
        font-family: fantasy;        
    }
    .bugun div{
        border: 1px dashed #000;
    }
    .yakshanba{
        background: #f66;
        font-family: fantasy;
    }
    
    #kirim{
        margin: 0;
        padding: 0;
        color: #0f0;
        font-family: sans-serif;
    }
    #chiqim{
        margin: 0;
        padding: 0;
        color: #f00;
        font-family: sans-serif;
    }
    .none{
        background: #aaa;
        font-family: fantasy;
    }
</style>

</head>
<body>
<br />
<table width="1000" align="center" id="main_border">
  <? include("blocks/head.php"); ?>
  
  <tr>
    <? include("blocks/lefttd.php"); ?>
	<td width="788" valign="top">
	<div>
	
	</div>
	<table border="1" id="sana" valign='top'>
    <thead>
    <?
    if(isset($_GET["ym"]))
    {
    	$year = (int)substr($_GET["ym"], 0, 4);
    	$month = (int)substr($_GET["ym"], 4, 2);        
        if($month<10)
            $month = "0".$month;
    }
    else	// иначе выводить текущие месяц и год
    {
    	$month = date("m", mktime(0,0,0,date('m'),1,date('Y')));
    	$year = date("Y", mktime(0,0,0,date('m'),1,date('Y')));
    }
     echo '<tr id="oy">  	
    	<th colspan="2"><a href="?ym='.date("Ym", mktime(0,0,0,$month-1,1,$year)).'">&laquo; Oldingi</a></th>
      	<th colspan="3">'.date("F, Y", mktime(0,0,0,$month,1,$year)).'</th>
      	<th colspan="2"><a href="?ym='.date("Ym", mktime(0,0,0,$month+1,1,$year)).'">Keyingi &raquo;</a></th>
    </tr>';
    ?>
    <tr height='50'><td width='110'>Du</td>
    <td width='110'>Se</td>
    <td width='110'>Chor</td>
    <td width='110'>Pa</td>
    <td width='110'>Ju</td>
    <td width='110'>Sha</td>
    <td width='110'>Yak</td></tr>
    </thead>
        <tbody>
<?
            //Kirimlar bo`yicha            
            $kirim = 0;
            $ksum = array ();
            $kdate = array();            
            $sqlk = "select date,sum_k from kirim WHERE MONTH(date)=$month";  
            $rkirim = $conn->prepare($sqlk);  
            $rkirim->execute ();  
            $tdata = $rkirim->fetchAll ();              
            foreach ($tdata as $row){  
                //любые действия например  
                //echo "<p><b>".$row['date']."</b> - ".$row['sum']."</p>";
                $kirim += $row['sum_k'];
                array_push ($ksum, $row['sum_k']);
                array_push ($kdate, $row['date']);
            }
            $resultk = array_merge ($ksum, $kdate);
            	
            //Chiqimlar bo`yicha
            $csum = array ();
            $cdate = array ();
            $chiqim = 0;
            $sqlc = "select date,sum_c from chiqim WHERE MONTH(date)=$month";            
            $rchiqim = $conn->prepare($sqlc);  
            $rchiqim->execute ();
            $tdata = $rchiqim->fetchAll ();            
            foreach ($tdata as $row){
                //любые действия например  
                //echo "<p><b>".$row['date']."</b> - ".$row['sum_c']."</p>";
                $chiqim += $row['sum_c'];
                array_push ($csum, $row['sum_c']);
                array_push ($cdate, $row['date']);
            }
            $resultc = array_merge ($csum, $cdate);
$skip = date("w", mktime(0,0,0,$month,1,$year)); // узнаем номер дня недели
$daysInMonth = date("t", mktime(0,0,0,$month,1,$year));	// узнаем число дней в месяце
$calendar_body = '';	// обнуляем calendar boday
$day = 01;	// для цикла далее будем увеличивать значение
$hafta = date("W", mktime(0,0,0,$month,$daysInMonth ,$year)) - date("W", mktime(0,0,0,$month,0,$year)) + 1;
if($hafta<3)$hafta = 6;
if($skip == 0)$skip=7; // agar oyning birinchi kuni yakshanba bo`lsa
for($i = 0; $i < $hafta; $i++) // haftalarni sikli 
{      
	$calendar_body .= '<tr height="80" valign="top">';	// hafta satrini ochilishi
	for($j = 0; $j < 7; $j++)	// Hafta kunlarini yasash uchun ichki sikl
	{	   
		if(($skip-1 > 0)or($day > $daysInMonth)) // Oyning 1-kunidan chapdagi va oxiridan o`ngdagi kunlarni chiqarmaslik 
		{
			$calendar_body .= '<td class="none">&nbsp;</td>';
			$skip--;
		}
		else
		{ 
		  if($day<10)
	       $day = "0".$day;           
           $calday=$year."-".$month."-".$day;
           //echo "<br>".$day;
           //echo "<br>".$calday;
			if($j == 6){	//Yakshanba bo`lsa
            $calendar_body .= '<td class="yakshanba">'.$day;
                if(in_array($calday,$kdate)){
                    $calendar_body .='<p id="kirim">">'.$kirim;	
                }
                if(in_array($calday,$cdate)){
                    $calendar_body .='</p><p id="chiqim">'.$chiqim;	
                }
            $calendar_body .= '</p></td>';
            }
			else {	// aks holda kunni oddiy yacheykada chiqaramiz
				if ((date(j)==$day)&&(date(m)==$month)&&(date(Y)==$year)){//bugungi kunga tekshirish
                    $calendar_body .= '<td class="bugun">'.$day;
                    if(in_array($calday,$kdate)){
                        $calendar_body .= '<p id="kirim">'.$kirim;				    
                    }
                    if(in_array($calday,$cdate)){
                        $calendar_body .='</p><p id="chiqim">'.$chiqim;				    
                    }
                    $calendar_body .=  '</p></td>';
				}	
				else{//Oddiy kun bo`lsa
					$calendar_body .= '<td class="day">'.$day;
                    if(in_array($calday,$kdate)){
                        //echo "<br>kirim ".key($kdate);
                        $calendar_body .= '<p id="kirim">'.$kirim;				    
                    }
                    if(in_array($calday,$cdate)){
                        //echo "<br>";print_r($csum);
                        //echo "<br>chiqim ".key($cdate);
                        $calendar_body .='</p><p id="chiqim">'.$chiqim;				    
                    }
                    $calendar_body .=  '</p></td>';
				   }
				 }
			$day++; // $day ni oshiramiz
		}		
	}	// ichki sikl yopildi
	$calendar_body .= '</tr>'; // hafta satri yopildi
} // tashqi sikl yopildi
          echo $calendar_body;
?>
        </tbody>
        <tfoot><tr><td colspan="7"><? echo date("M"); ?></td></tr></tfoot>
    </table>
    <div id="bugun"><? 
    echo "Bugun: ".date("j - M  Y");
              }
catch(PDOException $e){
    echo "Ошибка: ".$e->getMessage();
}
?></div>
		
		</td>
  </tr>
  <? include("blocks/subcontent.php"); ?>
  <? include("blocks/footer.php"); ?>
</table>

</body>
</html>