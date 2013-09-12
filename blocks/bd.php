<?
class DB{
	protected $dbhost = "localhost";
	protected $dbname = "hisob";
	protected $dbuser = "admin";
	protected $dbpass = "123456";
	
	public function connection(){
		$connection = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass);
		mysql_select_db($this->dbname) or die("Noto`g`ri baza ulangan");
		return true;
	}
	
	public function processRowSet($rowSet, $singleRow="false"){
		$reusltArray = array();
		while($row = mysql_fetch_assoc($rowSet)){
			array_push($reusltArray,$row);
		}
		if($singleRow === true)
		return $resultArray[0];
		return $resultArrat;
	}
	
	public function select($table, $where){
		$sql = "SELECT * FROM $table WHERE $where";
		$result = mysql_query($sql);
		if(mysql_num_rows($result)==1)
		return $this->processRowSet($result, true);
		return $this->processRowset($result);
	}
	
	public function update($data, $table, $where){
		foreach($data as $column => $value){
			$sql = "UPDATE $table SET $column=$value WHERE $where";
			$result = mysql_query($sql) or die(mysql_error());
		}
		return true;
	}
	
	public function insert($data, $table){
		$columns = "";
		$values = "";
		foreach($data as $column => $value){
			$columns .= ($columns == "") ? "" : ", ";
			$columns .= $column;
			$values .= ($values == "") ? "" : ", ";
			$values .= $value;			
		}
		
		$sql = "insert into $table ($columns) values ($values)";
		mysql_query($sql) or die(mysql_error());
		return mysql_insert_id();
	}
}

/*$username = "admin";
$password = "123456";
$db = mysql_connect("localhost",$username,$password);
mysql_select_db("hisobchi",$db);

try{
$conn = new PDO("mysql:host=localhost;dbname=hisobchi",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Ошибка: ".$e->getMessage();
}*/
?>