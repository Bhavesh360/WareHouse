<?php
include '../lib/AJAXServer.php';
include '../ProductsTable.php';
include '../LocationProductsTable.php';
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
                'name'              => $request['name'],
                'quantity'          => $request['quantity'],
                'retail_price'      => $request['retail_price'],
                'whole_sale_price'  => $request['whole_sale_price'],
                'type'              => $request['type'],
                'color'             => $request['color']

        );

        $productTable = new ProductsTable();
        $result = $productTable->create($dbParams);// not only create, but also read

        for ($x = 0; $x < 800; $x++) {
        // GET RANDOM NO FROM 1 TO 800
          $dbParams["location_id"] = mt_rand(0,800);
          // SELECT THE RO W FROM DB
          $LocationProductsTable = new LocationProductsTable();
          $result = $LocationProductsTable->SelectLocation($dbParams);

          // IF IT WAS NULL, PUT THE PRODUCT IN

          if($result){

          //update
            $result = $LocationProductsTable->UpdateLocation($dbParams);
            break;

          } else{
              continue;
          }

        // IF IT WAS NOT NULL, TRY OTHERS
        }
        // return $result;
        $response ["error"] = 0;
        return $response;
    }
}

$myServer = new Server ();
?>
