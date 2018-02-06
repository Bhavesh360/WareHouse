<?php

include_once 'lib/Database.php';

// Adapt to your Table
class ProductsTable {

	function create( $data ){

		$db = Database::connection();

		$params = array(
      //  ':id'           		=>$data['id'],
		    ':name'						=>$data['name'],
			':quantity'					=>$data['quantity'],
		    ':retail_price'   	        =>$data['retail_price'],
		    ':whole_sale_price'         =>$data['whole_sale_price'],
		    ':type'   					=>$data['type'],
			':color'					=>$data['color']
		);

		$sql = $db->prepare("INSERT INTO products( name, quantity, retail_price, whole_sale_price, type, color)
		  			              VALUES (  :name, :quantity, :retail_price, :whole_sale_price, :type, :color)");
		if(!$sql->execute( $params ))
		{
			return $sql->errorCode();
		}

		return true;

	}


	function update($data){

		$db = Database::connection();

		$params = array(
			':id'           		=>$data['id'],
			':name'					=>$data['name'],
			':quantity'				=>$data['quantity'],
			':retail_price'   	    =>$data['retail_price'],
			':whole_sale_price'     =>$data['whole_sale_price'],
			':type'   				=>$data['type'],
			':color'				=>$data['color']
		);
		$sql = $db->prepare("UPDATE products
		                     SET name = :name,
								quantity = :quantity,
	                            retail_price = :retail_price,
		                        whole_sale_price = :whole_sale_price,
					            type = :type,
								color = :color
						     WHERE id= :id");

		if (!$sql->execute( $params )) {

			return $sql->errorCode();
		}

		return true;

	}

	function readProductByName($name){

        $db = Database::connection();
		$handler = $db->prepare("SELECT * FROM products p where p.name LIKE '%".trim($name)."%'");

		$sql->execute();

		$result = $sql->fetchAll(\PDO::FETCH_OBJ);

		if(empty($result)) return false;

		return $result;

	}

	function readAllProducts(){

		$db = Database::connection();
		$sql = $db->prepare("SELECT p.ID as ID, p.NAME as NAME, p.QUANTITY as QUANTITY, p.RETAIL_PRICE as RETAIL_PRICE, p.WHOLE_SALE_PRICE as WHOLE_SALE_PRICE, t.DESCRIPTION as TYPE, c.DESCRIPTION as COLOR FROM products p join type_master t on t.id = p.type join color_master c on c.id = p.color");

		$sql->execute();

		$result = $sql->fetchAll(\PDO::FETCH_OBJ);

		if(empty($result)) $result[]["name"] = "No product found";

		return $result;
	}

	function readProductByID($id){

        $db = Database::connection();
		$handler = $db->prepare("SELECT * FROM products p where p.id=".$id );

		$sql->execute();

		$row = $sql->fetch(\PDO::FETCH_OBJ);

		if (!isset( $row->id )) $row = "No product found";

		return $row;
	}

	function decreaseProductsQuantityByFulfillment($data) {
		$db = Database::connection();

		$params = array(
			':order_id'           		=>$data['order_id'],
			':product_id'           	=>$data['product_id'],
		);
		$sql = $db->prepare("update products p inner join orders_products op on p.id = op.product_id set p.quantity = (p.quantity-op.quantity) where op.order_id = :order_id and p.id = :product_id");

		if (!$sql->execute( $params )) {

			return $sql->errorCode();
		}

		return true;
	}
	function readProductsByType($data){

		$params = array(
			':type'   					=>$data['type']
		);

		$db = Database::connection();
		$sql = $db->prepare("SELECT p.ID as ID, p.NAME as NAME, p.QUANTITY as QUANTITY, p.RETAIL_PRICE as RETAIL_PRICE, t.DESCRIPTION as TYPE, c.DESCRIPTION as COLOR FROM products p join type_master t on t.id = p.type join color_master c on c.id = p.color WHERE p.type = :type");// WHERE type= :type

		$sql->execute($params);

		$result = $sql->fetchAll(\PDO::FETCH_OBJ);

		if(empty($result)) return false;

		return $result;
	}
}
?>
