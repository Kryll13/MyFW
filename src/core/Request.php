<?php

namespace MyFW\Core;

class Request
{

    private $uri;
    private $method;
    private $arguments = array();
    private $controller = 'Defaut';
    private $action = 'defaut';

    public function __construct()
    {
        // process HTTP Request
        // ...
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        //
        // process URI
        //
        $this->uri = substr($this->uri, 1); // retrait du premier slash
        $uri_parts = explode('/', $this->uri);
        if ($uri_parts[0] != '') {
            $this->controller = array_shift($uri_parts);
            if ((count($uri_parts) > 0) && ($uri_parts[0] != ''))
                $this->action = array_shift($uri_parts);
            $this->arguments['uri'] = $uri_parts;
        }

        if (isset($_SERVER['CONTENT_TYPE'])) {
            switch ($_SERVER['CONTENT_TYPE']) {
                case 'application/xml':
                    // Special Lydie
                    $xml = file_get_contents("php://input");
                    break;
                case 'application/json':
                    $json = file_get_contents("php://input");
                    $data = json_decode($json, true);
                    $this->arguments['data'] = $data;
                    break;
            }
        }

        if ($this->getMethod() == 'POST') {
            $this->arguments['data'] = $_POST;
        }

    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

}