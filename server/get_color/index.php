<?php
include '../lib/AJAXServer.php';
include '../ColorTable.php';
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

        $ColorTable = new ColorTable();
        $result = $ColorTable->selectColor();

        if (empty($result)) {
            return $response;
        }

        $color = [];
        foreach ($result as $key => $value) {
            $color[$key] = $value;
        }

        $response["color"] = $color;
        $response ["error"] = 0;

        return $response;
    }
}

$myServer = new Server ();
?>
