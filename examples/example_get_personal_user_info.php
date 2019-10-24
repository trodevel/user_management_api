<?php
// $Revision: 12263 $ $Date:: 2019-10-24 #$ $Author: serge $

require_once __DIR__.'/../api.php';
require_once __DIR__.'/../../user_management_protocol/html_helper.php';
require_once __DIR__.'/../helpers.php';
require_once '../credentials.php';

$error_msg = "";

$user_id = 0;

echo "\n";
echo "TEST: get personal user info\n";
{
    $api = new \user_management_api\Api( $host, $port );

    $session_id = NULL;

    // open session
    if( $api->open_session( $login, $password, $session_id, $error_msg ) == true )
    {
        echo "OK: opened session\n";

        // get user ID
        $req = new \generic_protocol\GetUserIdRequest( $session_id, $login );

        echo "REQ = " . $req->to_generic_request() . "\n";
        $resp = $api->submit( $req );
        echo "user id = " . $resp->user_id . "\n\n";
        $user_id = $resp->user_id;

        echo "\n";
        echo "TEST: get personal user info for user $user_id\n";

        // get personal user info

        $res = \user_management_api\get_personal_user_info( $api, $session_id, $user_id, $resp );

        if( $res == true )
        {
            echo "OK: " . \user_management_protocol\to_html( $resp ) . "\n\n";
        }
        else
        {
            echo "ERROR: " . \user_management_protocol\to_html( $resp ) . "\n\n";
        }

        // close session
        if( $api->close_session( $session_id, $error_msg ) == true )
        {
            echo "OK: session closed\n";
        }
        else
        {
            echo "ERROR: cannot close session: $error_msg\n";
        }
    }
    else
    {
        echo "ERROR: cannot open session: $error_msg\n";
    }
}

?>
