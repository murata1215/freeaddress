<?php
	require "database_mysql.php";
	require 'vendor/autoload.php';

	class param {
	    public function setParam($id,$param, $val) {
			$dao = new db();
			$dao->connect();
			$dao->exec("DELETE FROM settei WHERE id='".$id."' AND param='".$param."'");
			$dao->exec("INSERT INTO settei (id, param, val) VALUES ('".$id."', '".$param."','".$val."')");
			$dao->close();
	    }
	    public function getParam($id,$param) {
			$name = "";
			$dao = new db();
			$dao->connect();
			$dao->select("SELECT val from settei where id='".$id."' and param='".$param."' ");
			if ($dao->next()){
				$name = $dao->get("val");
			}
			$dao->close();
			return $name;
	    }
	}

?>
