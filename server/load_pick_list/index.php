<?php
include '../lib/AJAXServer.php';
include '../PickupViewTable.php';
class Server extends AJAXServer {
    // ========================================================================
    //
    // load_pick_list handler
    //
    public function handleAction( $request ) {

        // perhaps close the db connection
        $response ["error"] = 1;

        $pickupViewTable = new PickupViewTable();
        $result = $pickupViewTable->selectAll();

        if(empty($result)){
            $response ["error"] = 0;
            $response["picklist"] = [];
            return $response;
        }

        $picklist = [];
        foreach ($result as $key => $value) {
            $picklist[$key] = $value;
        }

        $response["picklist"] = $picklist;
        $response ["error"] = 0;

        return $response;
    }
}

$myServer = new Server ();
?>
