<?php
/*
 * mysql database connection class/ mysql 数据库连接类
 * @author HollenMok
 * @date 2015/08/02
 * 
 */

class pMysql{
	public $host;
	public $db;
	public $user; 
	public $pwd;
	public $connection; 
	public $sql; 
	public $queryResult;
	public function __construct($dbKey){
		//require ROOT.'/applications/pandoraf/install/config.php';
		//$pConfig = new config();
		if($dbKey){
			$this->host = $dbKey[host];
			$this->db = $dbKey[db];
			$this->user = $dbKey[user];
			$this->pwd = $dbKey[pwd];
		}
	   $this->connection = mysql_connect($this->host,$this->user,$this->pwd);
	   if(!$this->connection){
	   	die('failed to connect mysql!');
	   }
	}
	//free resource/释放查询资源
	public function mysqlFree(){
		mysql_free_result($this->queryResult);
	}
	//close connection/关闭连接
	public function mysqlClose(){
		mysql_close($this->connection);
	}
	//execute query/执行查询 
	public function dbQuery($sql){
		//test sql
		$this->sql = $sql;
		$this->queryResult = mysql_db_query($this->db,$this->sql, $this->connection);
		return $queryResult; 
	}
	//get a row of result after querying/取查询结果中的一行数据
    public function getRow(){
        $row = mysql_fetch_row($this->queryResult);
    	return $row; 
   	}
}



