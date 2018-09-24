<?php

namespace MyFW\App;

use \MyFW\Core\Request;

class ControllerDefaut
{

    private $_request;

    public function __construct(Request $r)
    {
        $this->_request = $r;
    }

}
