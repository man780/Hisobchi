<?
    include("blocks/bd.php"); 
        if(isset($_GET['id'])){
            $priz = $_GET['priz'];
            $id = $_GET['id'];
        }
        if($priz=="k"){
            $resDel = mysql_query("DELETE FROM kirim WHERE id=".$id,$db);
            echo "<html><head>
<meta http-equiv='Refresh' content='0; URL=kirim.php'>
</head></html>";
        }else if($priz = "ch"){
            $resDel = mysql_query("DELETE FROM chiqim WHERE id=".$id,$db);
            //echo "o`chirdi";
            echo "<html><head><meta http-equiv='Refresh' content='0; URL=chiqim.php'></head></html>";
        }
        
    ?>