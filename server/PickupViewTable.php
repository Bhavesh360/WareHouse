<?php

include_once 'lib/Database.php';

// Adapt to your Table
class PickupViewTable {

	function selectAll(){

		$db = Database::connection();
		$sql = $db->prepare("SELECT * FROM pickup_view");

		$sql->execute();

		$result = $sql->fetchAll(\PDO::FETCH_OBJ);

		return $result;
	}

}
?>
