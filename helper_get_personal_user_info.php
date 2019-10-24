<?php
// $Revision: 12259 $ $Date:: 2019-10-24 #$ $Author: serge $

namespace user_management_api;

require_once __DIR__.'/api.php';

function get_personal_user_info( & $api, $session_id, $user_id, & $resp )
{
    // execute request

    $req = new \user_management_protocol\GetPersonalUserInfoRequest( $session_id, $user_id );

    $resp = $api->submit( $req );

    if( get_class ( $resp ) == "generic_protocol\ErrorResponse" )
    {
        return false;
    }
    elseif( get_class( $resp ) == "user_management_protocol\GetPersonalUserInfoResponse" )
    {
    }
    else
    {
        $new_resp = new \generic_protocol\ErrorResponse( \generic_protocol\ErrorResponse::RUNTIME_ERROR, "unknown response: " . get_class( $resp ) );

        $resp = $new_resp;

        return false;
    }

    return true;
}

function get_personal_user_info_auto( $host, $port, $login, $password, $user_id, & $resp )
{
    $api = new \user_management_api\Api( $host, $port );

    $error_msg = NULL;
    $session_id = NULL;

    // open session
    if( $api->open_session( $login, $password, $session_id, $error_msg ) == true )
    {
        $res = get_personal_user_info( $api, $session_id, $user_id, $resp );

        if( $api->close_session( $session_id, $error_msg ) == true )
        {
            //echo "OK: session closed\n";
        }
        else
        {
            //echo "ERROR: cannot close session: $error_msg\n";
        }
    }
    else
    {
        $resp = new \generic_protocol\ErrorResponse( \generic_protocol\ErrorResponse::RUNTIME_ERROR, "cannot open session: " . $error_msg );

        return false;
    }

    return $res;
}

?>
