<?php
class DbHandler {
	private $host = "localhost"; //using localhost - change your url if necessary
	private $user = "your_usr";
	private $password = "your_pw";
	private $database = "your_db";
	
	
	function __construct() {
		$conn=$this->connectDB();
		if(!empty($conn)) {
			$this->selectDB($conn);
		}
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function selectDB($conn) {
		mysqli_select_db($conn,$this->database);
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->connectDB(),$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
			
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	
	function numRows($query) {
		$result  = mysqli_query($this->connectDB(),$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	
	}
        
        function insertQuery($query){
                mysqli_query($this->connectDB(),$query);
				
        }

        function updateQuery($query){
                mysqli_query($this->connectDB(),$query);
				
        }
}
?>	
