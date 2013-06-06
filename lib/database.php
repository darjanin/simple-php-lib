<?php 
class Database {
	var $host, $login, $password, $db_name, $connection;

	public function __construct($host, $login, $password, $db_name) {
		$this->host = $host;
		$this->login = $login;
		$this->password = $password;
		$this->db_name = $db_name;
	}

	public function connect() {
		$this->connection = mysql_connect($this->host,$this->login,$this->password);
		if (! $this->connection) {
			return false;
			die("MYSQL ERROR >> ".mysql_error());
		}
		if (isset($this->db_name)) {
			$this->choose_database($this->db_name, $this->connection);
		}
		return true;
	}

	public function choose_database($db_name) {
		if ($this->connection) {
			$this->db_name = $db_name;
			mysql_select_db($db_name);
		}
	}

	public function insert($table, $data) {
		$keys = "";
		$values = "";
		foreach ($data as $key => $value) {
			$keys .= "$key, ";
			$values .= "'$value', ";
		}
		$keys = substr($keys, 0, -2);
		$values = substr($values, 0, -2);
		$query = "INSERT INTO $table ($keys)".
						 "VALUES ($values)";
		return mysql_query($query, $this->connection) ? true : false;
	}

	public function all($table) {
		$table = $this->injects_safe($table);
		$query = "SELECT * FROM $table";
		$result = mysql_query($query, $this->connection);
		return isset($result) ? $this->results_assoc($result) : array();
	}

	public function find($table ,$col, $value) {
		$value = $this->injects_safe($value);
		$query = "SELECT *".
						 "FROM $table".
						 "WHERE $col=$value";
		$result = mysql_query($query, $this->connection);

		print_r($result);
		if ($result) {

			return mysql_fetch_assoc($result);
		} else {
			echo "ERROR";
			return array();
		}
	}


	public function __destructor() {
		if ($this->connection) {
			mysql_close($this->connection);
		}
	}

	private function injects_safe($string) {
		return mysql_real_escape_string($string);
	}

	private function results_assoc($result) {
		$tmp = Array();
		while($row = mysql_fetch_assoc($result)) {
			array_push($tmp, $row);
		}
		return $tmp;
	}


}
 ?>