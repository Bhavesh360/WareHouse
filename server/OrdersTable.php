<?php

include_once 'lib/Database.php';

class OrdersTable {

	function updateStatus($data) {
		$db = Database::connection();

		$params = array(
			':order_id'           		=>$data['order_id'],
			':status'     =>$data['order_status']
		);

		$sql = $db->prepare("update orders set status_code = :status, fulfillment_date = CURDATE() where id = :order_id");
		if (!$sql->execute( $params )) {

			return $sql->errorCode();
		}

		return true;
	}

	function create(){

		$db = Database::connection();

		// $params = array(
		// 	//  ':id'           		=>$data['id'],
		// 		':status_code'					=>	1,
		// 		':complete_data'				=>	NULL,
		// 		':quantity'					=>$data['quantity'],
		// 		':retail_price'   	=>$data['retail_price'],
		// 		':whole_sale_price' =>$data['whole_sale_price'],
		// 		':type'   					=>$data['type'],
		// 		':color'						=>$data['color']
		// );

		$sql = $db->prepare("INSERT INTO orders( status_code, complete_date, fulfillment_date, shipped_date, shipment_address, delete_date)
													VALUES (  1, CURDATE(), NULL, NULL, NULL, NULL)");
		if(!$sql->execute())
		{
			return $sql->errorCode();
		}
		$id = $db->lastInsertId();
		return $id;

	}
}
?>
