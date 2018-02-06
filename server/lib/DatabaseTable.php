<?php

include_once 'Database.php';

// Adapt to your Table
class DatabaseTable {

	function create( $data ){

		$db = Database::connection();

		$params = array(
        ':id'           		=>$data['id'],
		    ':name'							=>$data['name'],
		    ':retail_price'   	=>$data['retail_price'],
		    ':whole_sale_price' =>$data['whole_sale_price'],
		    ':discount_price'   =>$data['discount_price']
		);

		$sql = $db->prepare("INSERT INTO products(id, name, retail_price, whole_sale_price, discount_price)
		  			              VALUES ( NULL, :name, :retail_price, :wholesale_price, :discount_price)");
		if(!$db->execute( $params ))
		{
			return $sql->errorCode();
		}

		return true;

	}


	function update($data){

		$db = Database::connection();

		$params = array(
			':id'           		=>$data['id'],
			':name'							=>$data['name'],
			':retail_price'   	=>$data['retail_price'],
			':whole_sale_price' =>$data['whole_sale_price'],
			':discount_price'   =>$data['discount_price']
		);
		$sql = $db->prepare('UPDATE databasetable
		                     SET name = :name,
	                             retail_price = :retail_price,
		                         whole_sale_price = :whole_sale_price,
					             discount_price = :discount_price,
						     WHERE id= :id');

		if (!$sql->execute( $params )) {

			return $sql->errorCode();
		}

		return true;

	}

	function readProductByName($name){

        $db = Database::connection();
		$handler = $db->prepare("SELECT * FROM productstest p where p.name LIKE '%".trim($name)."%'");

		$sql->execute();

		$result = $sql->fetchAll(\PDO::FETCH_OBJ);

		if(empty($result)) $result[]["name"] = "No product found";

		return $result;

	}

	function readProductByID($id){

        $db = Database::connection();
		$handler = $db->prepare("SELECT * FROM productstest p where p.id=".$id );

		$sql->execute();

		$row = $sql->fetch(\PDO::FETCH_OBJ);

		if (!isset( $row->id )) $row = "No product found";

		return $row;
	}
}
?>
