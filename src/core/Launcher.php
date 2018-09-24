<?php

namespace MyFW\Core;

use \Illuminate\Database\Capsule\Manager as Capsule;

class Launcher
{

    public static function run(Request $r)
    {

        // démarage de l'ORM Eloquent
        $capsule = new Capsule;
        $capsule->addConnection(array(
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'rest',
            'username' => 'rest',
            'password' => 'tser',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ));
        $capsule->bootEloquent();

        if ($r->getController() == 'rest') {

            if (class_exists('\MyFW\App\Controller' . ucfirst($r->getController()) . ucfirst($r->getAction()))) {
                $controllerName = '\MyFW\App\Controller' . ucfirst($r->getController()) . ucfirst($r->getAction());
                // instanciation du contrôleur .$r->getAction()
                // Request en paramètre
                $controller = new $controllerName($r);

                if (method_exists($controller, 'defaut')) {
                    if (isset($r->getArguments()['uri'])) {
                        // avec paramètres
                        call_user_func_array(array($controller, 'defaut'), $r->getArguments()['uri']);
                    } else {
                        // sans paramètres
                        call_user_func(array($controller, 'defaut'));
                    }
                } else {
                    echo 'Action not present';
                }
            }

        } else {
            if (class_exists('\MyFW\App\Controller' . ucfirst($r->getController()))) {
                $controllerName = '\MyFW\App\Controller' . ucfirst($r->getController());
                // instanciation du contrôleur
                // Request en paramètre
                $controller = new $controllerName($r);

                if (method_exists($controller, $r->getAction())) {
                    if (isset($r->getArguments()['uri'])) {
                        // avec paramètres
                        call_user_func_array(array($controller, $r->getAction()), $r->getArguments()['uri']);
                    } else {
                        // sans paramètres
                        call_user_func(array($controller, $r->getAction()));
                    }
                } else {
                    echo 'Action not present';
                }
                //
                //echo '<hr>';
                //print_r($app);

            } else {
                echo 'Controller not present';
            }
        }
    }

}