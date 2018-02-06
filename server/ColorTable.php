<?php

include_once 'lib/Database.php';

// Adapt to your Table
class ColorTable {

	function selectColor(){

		$db = Database::connection();
		$sql = $db->prepare("SELECT * FROM COLOR_MASTER");

		$sql->execute();

		$result = $sql->fetchAll(\PDO::FETCH_OBJ);

		return $result;
	}

}
?>
