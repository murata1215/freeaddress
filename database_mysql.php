<?php

class db{
	//インスタンス変数を定義
	private $mysqli;
	private $res_result;
	private $row;

	public function connect(){
		//インスタンス変数を利用するときは$thisをつける
		$this->mysqli = mysqli_connect("127.0.0.1", "freeuser", "freepass", "freeaddress");

		if ($this->mysqli->connect_error) {
		    echo $this->$mysqli->connect_error;
			var_dump("DBに接続できませんでした");
			exit;
		} else {
		    $this->mysqli->set_charset("utf8");
			return true;
		}

	}

	public function exec($sql) {
		//$str = mb_strtolower($sql);
		$str = $sql;
		$result = $this->mysqli->query($str);
		if ($result == false) {
			var_dump(mysqli_error($this->mysqli));
		}
		return $result;
	}

	public function select($sql) {
		$str = mb_strtolower($sql);
		$this->res_result = $this->mysqli->query($str);
		if ($this->res_result == false) {
			var_dump(mysqli_error($this->mysqli));
		}
	}

	public function next() {
		$this->row = $this->res_result->fetch_assoc();
		return $this->row;
	}

	public function get($item) {
		$str = mb_strtolower($item);
//		var_dump($this->row);
		return $this->row[$str];
	}

	public function close(){
		$this->mysqli->close();
	}
}

?>
