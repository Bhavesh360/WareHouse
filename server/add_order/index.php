<?php
include '../lib/AJAXServer.php';
include '../OrdersTable.php';
include '../OrdersProductsTable.php';
class Server extends AJAXServer {
    // ========================================================================
    //
    // save_product handler
    //
    public function handleAction( $request ) {

        // The 'action' requested is named for the folder this server lives in
        // no data to handle here, just the user is logged out.

        // perhaps close the db connection
        $response ["error"] = 1;


        $ordersTable = new OrdersTable();
        $result = $ordersTable->create();// not only create, but also read


        for ($i = 0; $i < count($request); $i++) {
              $item = $request[$i];
              $dbParams = array('order_id' => $result,
                                'product_id' => $item['ID'],
                                'retail_price' => $item['RETAIL_PRICE'],
                                'quantity' => $item['QUANTITY']);
              $ordersProductsTable = new OrdersProductsTable();
              $result2 = $ordersProductsTable->addOrdertoTable($dbParams);
        }
        // $dbParams=array(
        //         'id'                => $request['id'],
        //         'name'              => $request['name'],
        //         'aisle_num'         => $request['aisle_num'],
        //         'quantity'          => $request['quantity'],
        //         'retail_price'      => $request['retail_price'],
        //         'whole_sale_price'  => $request['whole_sale_price'],
        //         'type'              => $request['type'],
        //         'color'             => $request['color']
        //
        // );


        return $result;
    }
}

$myServer = new Server ();
?>
