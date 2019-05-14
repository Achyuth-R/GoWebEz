<?php

class Dbh {

	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $charset;
	public function connect() {

		$this->servername = "localhost";
		$this->username = "devuser";
		$this->password = "123";
		$this->dbname = "gowebez_application";
		$this->charset = "utf8";
		
		try {

			$db = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
			$pdo = new PDO($db,$this->username,$this->password);
			$pdo -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$pdo -> setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			return $pdo;

		}
		catch(PDOException $e) {

			echo "connection failed".$e->getMessage();
		}

	}

}

?>