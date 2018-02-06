<?php

include_once 'lib/Database.php';

// Adapt to your Table
class TypeMasterTable {

	function selectAll(){

		$db = Database::connection();
		$sql = $db->prepare("SELECT * FROM TYPE_MASTER");

		$sql->execute();

		$result = $sql->fetchAll(\PDO::FETCH_OBJ);

		return $result;
	}

}
?>
