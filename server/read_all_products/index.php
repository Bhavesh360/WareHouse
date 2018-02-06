<?php
include '../lib/AJAXServer.php';
include '../ProductsTable.php';
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

        $productTable = new ProductsTable();
        $result = $productTable->readAllProducts();

        if (empty($result)) {
            return $response;
        }

        $products = [];
        foreach ($result as $key => $value) {
            $products[$key] = $value;
        }

        $response["products"] = $products;
        $response ["error"] = 0;

        return $response;
    }
}

$myServer = new Server ();
?>
