<?php
include '../lib/AJAXServer.php';
include '../OrdersTable.php';
include '../OrdersProductsTable.php';
include '../ProductsTable.php';
class Server extends AJAXServer {
    // ========================================================================
    //
    // load_pick_list handler
    //
    public function handleAction( $request ) {

        // TODO UPDATE DATE COLUMN
        $response ["error"] = 1;

        $dbParams=array(
                'order_id'                => $request['ORDER_ID'],
                'product_id'              => $request['PRODUCT_ID'],
                'order_product_status'    => 2,
                'order_status'    => 2
        );

        $productsTable = new ProductsTable();
        $result = $productsTable->decreaseProductsQuantityByFulfillment($dbParams);
        if (!$result) {
            $response["errorInfo"] = "decreaseProductsQuantityByFulfillment";
            return $response;
        }


        $opTable = new OrdersProductsTable();
        $result = $opTable->updateStatus($dbParams);
        if (!$result) {
            $response["errorInfo"] = "OrdersProductsTable updateStatus error";
            return $response;
        }

        $result = $opTable->selectOrderProductNeedsToBePicked($dbParams);

        // if all product was fulfilled
        if (empty($result)) {

            $orderTable = new OrdersTable();
            $result = $orderTable->updateStatus($dbParams);
            if (!$result) {
                $response["errorInfo"] = "OrdersTable updateStatus error";
                return $response;
            }

        }


        $response ["error"] = 0;

        return $response;
    }
}

$myServer = new Server ();
?>
