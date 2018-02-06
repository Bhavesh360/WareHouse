<?php
include '../lib/AJAXServer.php';
include '../TypeMasterTable.php';
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

        $TypeMasterTable = new TypeMasterTable();
        $result = $TypeMasterTable->selectAll();

        if (empty($result)) {
            return $response;
        }

        $types = [];
        foreach ($result as $key => $value) {
            $types[$key] = $value;
        }

        $response["types"] = $types;
        $response ["error"] = 0;

        return $response;
    }
}

$myServer = new Server ();
?>
