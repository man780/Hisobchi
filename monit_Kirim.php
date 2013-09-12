<? 
include("blocks/bd.php"); 

$sql    = "SELECT * FROM chiqim ORDER BY date ";
$result = mysql_query($sql, $db);
$dataNum = 1;
while ( $row = mysql_fetch_array($result,MYSQL_ASSOC) ) 
{
        echo "series1data" . $dataNum . " = " . $row["sum_c"] . PHP_EOL;
        echo "series2data" . $dataNum . " = " . $row["cat_c"] . PHP_EOL;
        //echo "series3data" . $dataNum . " = " . $row["productz"] . PHP_EOL;
        $dataNum++;
}

/*
 * release the result set and close the databse connection
 */
mysql_free_result($result);
mysql_close($db);

/*
 * all finished so exit
 */
exit(0);
?>