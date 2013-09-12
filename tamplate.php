<?
if(isset($_POST['username']))
    {$username = $_POST['username'];}
else{echo 'Aniqlanmagan foydalanuvchi';}
//$username = isset($_POST['username']) ? $_POST['username'] : 'Aniqlanmagan foydalanuvchi';
//$email	  = isset($_POST['email']) ? $_POST['email']:false;
//$message  = isset($_POST['msgbody'])? $_POST['msgbody']:false;
if(isset($_POST['email'])){$email = $_POST['email'];}else{$email=false;}
if(isset($_POST['msgbody'])){$message = $_POST['msgbody'];}else{$message=false;}
//sleep(1);
if(!$email && !$message)
	die("{'success':'0', 'error':'1', 'notification':'Yetarlicha ma`lumot kirmagan'}");
	
	$header = 'Reply-To: '.$email;

if(mail("man780@mail.ru", "Xabar AJAX-formdan yuborilgan!",$username."\n".$message,$header))
	die("{'success':'1', 'notification':'Xabar yuborildi'}");
else
	die("{'success':'0', 'error':'1', 'notification':'Xabar yuborilishda xatolik boldi'}");

?>