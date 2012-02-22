<?php

Class Connection{
	public $connect;
	public $result;
	public function __construct(){
		
		/*
		 * Loading the database configuration from config.xml 
		 */ 
		
		if (file_exists('db.xml')) {
			$config = simplexml_load_file('db.xml');
			
		}
		else {
			echo 'database configuration not found';
		}
		
		/*
		 * Initialising connection to the database 
		 */ 
		 
		$this->connect=mysql_connect($config->db_host,$config->db_user,$config->db_password);
		mysql_select_db($config->db_name);
	}
	
	function update($table,$constant1,$constant1value,$constant2,$constant2value,$changethis,$tothis){
		if($this->exist($table,$constant1,$constant1value)){
			$row=mysql_fetch_assoc($this->result);
			$sql="UPDATE ".$this->__($table)." SET ".$this->__($changethis)." = ".$this->__($tothis)." WHERE (".$this->__($constant1)." = '".$this->__($constant1value)."' AND ".$this->__($constant2)." = '".$this->__($constant2value)."')";
			if(mysql_query($sql,$this->connect)){
				return true;
			}
			else{
				echo mysql_error();
				return false;
			}
		}
		else{
			return false;
		}
	}
	
	function __($sqlquerytobesanitized){
		
		/*
		 * To prevent SQL Injections
		 */ 
		 
		return mysql_real_escape_string($sqlquerytobesanitized);
		
	}
	
	function exist($table,$const_name,$const){
		
		$this->result= mysql_query("SELECT * FROM ".$this->__($table)." where ".$this->__($const_name)." = '".$this->__($const)."'",$this->connect);
		if($this->result){
			if(mysql_num_rows($this->result)>0){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
		
	}
	
	function getTableasArray($query){
		/*
		 * Returns a database table as a 2D array
		 */ 
		
		$this->result= mysql_query($query,$this->connect);
		if($this->result){
		while($r[]=mysql_fetch_array($this->result));
		return $r;
		}
		else{
			echo "Database Query <b>$query</b> returned False";
		}
	}
	
	function Insert($str){
		
		$this->result= mysql_query($str,$this->connect);
		if($this->result){
		return true;
		}
		else{
			echo mysql_errno().':'.mysql_error();
		}
	}
	
}
$db = new Connection();

?>
