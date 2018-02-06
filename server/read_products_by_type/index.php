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
        $dbParams=array(
                'type' => $request['type']
        );

        $productTable = new ProductsTable();
        $result = $productTable->readProductsByType($dbParams);

        if (!$result || empty($result)) {
            return $response;
        }


        // $response["hello"] = $result;
        $products = [];
        foreach ($result as $key => $value) {
            $products[$key] = $value;
        }
        // $response["size"] = count($result);
        $response["products"] = $products;
        $response ["error"] = 0;

        return $response;
    }
}

$myServer = new Server ();
?>
