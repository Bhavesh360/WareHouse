<?php

include_once 'lib/Database.php';

class LocationProductsTable {

	function SelectLocation($data) {
		$db = Database::connection();

		$params = array(
			':location_id'           		=>$data['location_id']

		);

		$sql = $db->prepare("SELECT LOCATION_ID, PRODUCT_ID FROM products_location WHERE LOCATION_ID=:location_id AND PRODUCT_ID IS NULL");
		if (!$sql->execute( $params )) {

			return false;
		}

		return true;
	}

  function UpdateLocation($data){
    $db = Database::connection();

		$params = array(
			':location_id'           		=>$data['location_id'],
		);

		$sql = $db->prepare("UPDATE products_location SET PRODUCT_ID = LAST_INSERT_ID() WHERE LOCATION_ID = :location_id");
		if (!$sql->execute( $params )) {

			return false;
		}

		return true;


  }
}
?>
