<?php

include_once 'lib/Database.php';

class OrdersProductsTable {

	function updateStatus($data) {
		$db = Database::connection();

		$params = array(
			':order_id'           		=>$data['order_id'],
			':product_id'           	=>$data['product_id'],
			':order_product_status'     =>$data['order_product_status']
		);

		$sql = $db->prepare("update orders_products set status_code = :order_product_status, fulfillment_date = CURDATE() where order_id = :order_id and product_id = :product_id");

		if (!$sql->execute( $params )) {

			return $sql->errorCode();
		}

		return true;
	}

	function addOrdertoTable($data){
		$db = Database::connection();


		$params = array(
      //  ':id'           		=>$data['id'],
		    ':order_id'							=>$data['order_id'],
				':product_id'				=>$data['product_id'],
				':quantity'					=>$data['quantity'],
		    ':price'   	=>$data['retail_price']

		);

		$sql = $db->prepare("INSERT INTO orders_products(order_id , product_id, status_code, price, quantity, fulfillment_date, delete_date)
		  			              VALUES (:order_id, :product_id, 1, :price, :quantity, NULL, NULL)");
		if(!$sql->execute( $params ))
		{
			return $sql->errorCode();
		}

		return true;
	}

	function selectOrderProductNeedsToBePicked($data){

		$db = Database::connection();

		$params = array(
			':order_id'           		=>$data['order_id'],
		);

		$sql = $db->prepare("SELECT * FROM orders_products where order_id = :order_id and status_code = 1");

		$sql->execute($params);

		$result = $sql->fetchAll(\PDO::FETCH_OBJ);

		return $result;
	}
}
?>
