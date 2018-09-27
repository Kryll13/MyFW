<?php

namespace MyFW\App;

use MyFW\Core\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ControllerRestRoles
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
                // READ 1 or All
                if (is_null($params)) {
                    echo Users::all()->toJSON();
                } else {
                    try {
                        echo Roles::findOrFail($params)->toJSON();
                    } catch (ModelNotFoundException $e) {
                        echo json_encode(['success' => 'false', 'message' => 'role not found']);
                    }
                }
                break;
            case 'POST':
                // CREATE 1
                $data = $this->_request->getArguments()['data'];
                $u = new Roles();
                $u->name = $data['name'];
                $u->save();
                break;
            case 'PUT':
                // CREATE 1 or UPDATE 1
                break;
            case 'PATCH':
                // UPDATE 1
                $u = Roles::find($params);
                $u->name = $this->_request->getArguments()['data']['name'];
                $u->save();
                break;
            case 'DELETE':
                // DELETE 1 or All
                if (is_null($params)) {
                    // TODO implement delete all Roles
                    echo json_encode(['success' => 'true', 'message' => 'all roles deleted']);
                } else {
                    // TODO implement delete Role #n
                    echo json_encode(['success' => 'true', 'message' => 'role #' . $params . ' deleted']);
                }
                break;
        }


    }
}
