<? 
include("blocks/bd.php"); 
if(isset($_POST['date1'])){$date = $_POST['date1'];}
if(isset($_POST['cat_c'])){$cat_c = $_POST['cat_c'];}
if(isset($_POST['podcat_c'])){$podcat_c = $_POST['podcat_c'];}
if(isset($_POST['soni'])){$soni = $_POST['soni'];}
if(isset($_POST['sum_c'])){$sum_c = $_POST['sum_c'];}
if(isset($_POST['primech'])){$primech = $_POST['primech'];}
if(isset($_POST['id'])){$id = $_POST['id'];}

if(isset($sub_com))
{
if(isset($_POST['cat_c'])){trim($cat_c);}else {$cat_c = "";}
if(isset($_POST['podcat_c'])){trim($podcat_c);}else {$podcat_c = "";}

/*if(empty($cat_k) or empty($date))
{
echo $cat_k;
echo $date;
exit("<p>Hamma malumotni to`ldiring! <br> Orqaga qaytib qayta to`ldiring <br> <input name='back' type='button' value='Orqaga' onclick='javascript:self.back();' /></p>");
}*/

}

$cat_c = stripcslashes($cat_c);
$podcat_c= stripcslashes($podcat_c);
$cat_c = htmlspecialchars($cat_c);
$podcat_c = htmlspecialchars($podcat_c);

if(isset($id)){
    $rupdate = mysql_query("UPDATE chiqim SET cat_c='$cat_c',podcat_c='$podcat_c',
                            date='$date',soni='$soni',sum_c='$sum_c',primech='$primech' WHERE id='$id'",$db);
}else{
    $rinsert = mysql_query("INSERT INTO chiqim (cat_c,podcat_c,date,soni,sum_c,primech) 
							VALUES ('$cat_c','$podcat_c','$date','$soni','$sum_c','$primech')",$db);
}
                            
/*
$address = "man780@mail.ru";
$subject = "Blogda yangi komentariya qo`shildi";

$result3 = mysql_query("SELECT title FROM data WHERE id = '$id'");
$myrow3 = mysql_fetch_array($result3);
$post_title = $myrow3["title"];

$message = "'".$post_title."' - maruzasiga yangi fikr qo`shildi \n Fikrni ".$author." qo`shdi \n Bu fikr teksti: ".$text." \n Bu fikrga murojat:\n http://localhost/programmist.uz/view_post.php?id=".$id."";

mail($address,$subject,$message,"Content-type:text/plain; Charset=windows-1251\r\n");
*/
echo "<html><head>
<meta http-equiv='Refresh' content='0; URL=chiqim.php'>
</head></html>";

exit();
