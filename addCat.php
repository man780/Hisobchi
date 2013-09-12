<? 
include("blocks/bd.php"); 

if(isset($_POST['name'])){$name = $_POST['name'];}
if(isset($_POST['priz'])){$priz = $_POST['priz'];}


if(empty($name))
{
exit("<p>Hamma malumotni to`ldiring! <br> Orqaga qaytib qayta to`ldiring <br> <input name='back' type='button' value='Orqaga' onclick='javascript:self.back();' /></p>");
}

$name = stripcslashes($name);
$name = htmlspecialchars($name);

$result2 = mysql_query("INSERT INTO cat (name, priz) VALUES ('$name','$priz')",$db);

if($priz==1){
echo "<html><head>
<meta http-equiv='Refresh' content='0; URL=new_kirim.php'>
</head></html>";}
else if($priz==2){
echo "<html><head>
<meta http-equiv='Refresh' content='0; URL=new_chiqim.php'>
</head></html>";
}