<?php

namespace MyFW\App;

use MyFW\Core\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ControllerRestUsers
{

    private $_request;

    public function __construct(Request $r)
    {
        $this->_request = $r;
    }

    function defaut($params = NULL)
    {
        // 8 cas REST
        header('Content-Type: application/json');
        switch ($this->_request->getMethod()) {
            case 'GET':
                if (is_null($params)) {
                    echo Users::all()->toJSON();
                } else {
                    try {
                        echo Users::findOrFail($params)->toJSON();
                    } catch (ModelNotFoundException $e) {
                        //echo '{"success": "fail", "message": "not found"}';
                        $data = array("success" => "fail", "message" => "not found");
                        echo json_encode($data);
                    }
                }
                break;
            case 'POST':
                $data = $this->_request->getArguments()['data'];
                $u = new Users();
                $u->firstname = $data['firstname'];
                $u->lastname = $data['lastname'];
                $u->save();


                break;
            case 'PUT':
                break;
            case 'PATCH':
                print_r($this->_request->getArguments()['data']);
                print_r($params);
                $u = Users::find($params);
                $u->firstname = $this->_request->getArguments()['data']['firstname'];
                $u->lastname = $this->_request->getArguments()['data']['lastname'];
                $u->save();


                break;
            case 'DELETE':
                if (is_null($params)) {
                    echo 'Delete all users';
                } else {
                    echo 'Delete user #' . $params;
                }
                break;
        }


    }
}
