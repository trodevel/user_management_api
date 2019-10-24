<?php

/*

User Management API.

Copyright (C) 2019 Sergey Kolevatov

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.

*/

// $Revision: 12266 $ $Date:: 2019-10-24 #$ $Author: serge $

namespace user_management_api;

require_once __DIR__.'/../user_management_protocol/user_management_protocol.php';
require_once __DIR__.'/../user_management_protocol/response_parser.php';      // ResponseParser::parse()
require_once __DIR__.'/../generic_api/api.php';

class Api extends \generic_api\Api
{
    protected function parse_response( $resp )
    {
        $res = \user_management_protocol\ResponseParser::parse( $resp );

        if( $res != NULL )
            return $res;

        return NULL;
    }
}

?>
