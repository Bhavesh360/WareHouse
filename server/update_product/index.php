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

                'id'                => $request['id'],
                'name'              => $request['name'],
                'quantity'          => $request['quantity'],
                'retail_price'      => $request['retail_price'],
                'whole_sale_price'  => $request['whole_sale_price'],
                'type'              => $request['type'],
                'color'             => $request['color']
        );

        $productTable = new ProductsTable();
        $result = $productTable->update($dbParams);// not only create, but also read

        if ($result) {
            $response ["error"] = 0;
        }

        return $response;
    }
}

$myServer = new Server ();
?>
