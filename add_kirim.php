<? 
include("blocks/bd.php"); 
if(isset($_POST['date'])){$date = $_POST['date'];}
if(isset($_POST['cat_k'])){$cat_k = $_POST['cat_k'];}
if(isset($_POST['podcat_k'])){$podcat_k = $_POST['podcat_k'];}
if(isset($_POST['soni'])){$soni = $_POST['soni'];}
if(isset($_POST['sum_k'])){$sum_k = $_POST['sum_k'];}
if(isset($_POST['primech'])){$primech = $_POST['primech'];}
if(isset($_POST['id'])){$id = $_POST['id'];}
if(isset($sub_com))
{
if(isset($_POST['cat_k'])){trim($cat_k);}else {$cat_k = "";}
if(isset($_POST['podcat_k'])){trim($podcat_k);}else {$podcat_k = "";}

/*if(empty($cat_k) or empty($date))
{
echo $cat_k;
echo $date;
exit("<p>Hamma malumotni to`ldiring! <br> Orqaga qaytib qayta to`ldiring <br> <input name='back' type='button' value='Orqaga' onclick='javascript:self.back();' /></p>");
}*/

}
//echo $id." ".$date;
$cat_k = stripcslashes($cat_k);
$podcat_k= stripcslashes($podcat_k);
$cat_k = htmlspecialchars($cat_k);
$podcat_k = htmlspecialchars($podcat_k);



//$date = date("Y-m-d");

if(isset($id)){
    $rupdate = mysql_query("UPDATE kirim SET cat_k='$cat_k',podcat_k='$podcat_k',
                            date='$date',soni='$soni',sum_k='$sum_k',primech='$primech' WHERE id='$id'",$db);
}else{
    $rinsert = mysql_query("INSERT INTO kirim (cat_k,podcat_k,date,soni,sum_k,primech) 
							VALUES ('$cat_k','$podcat_k','$date','$soni','$sum_k','$primech')",$db);    
}

echo "<html><head><meta http-equiv='Refresh' content='0; URL=kirim.php'></head></html>";

exit();
