<?php

namespace App\Config;

use Dez\Config\Adapter\Json as ConfigJson;
use Dez\DependencyInjection\Container as DiContainer;
use Dez\EventDispatcher\Dispatcher;
use Dez\Http\Request;
use Dez\Http\Response;
use Dez\Loader\Loader;
use Dez\Router\Router;
use Dez\Session\Adapter\CustomFiles as SessionCustomFiles;

// requires services

$di = DiContainer::instance();

$di->set( 'loader', new Loader() )->resolve( [], $di )->register();
$di->set( 'config', new ConfigJson( __DIR__ . '/config.json' ) );

$di->set( 'eventDispatcher', new Dispatcher() );
$di->set( 'event', $di['eventDispatcher'] );

$di->set( 'request', new Request() );
$di->set( 'response', new Response() );

$di->set( 'session', function() use ( $di ) {
    return ( new SessionCustomFiles( [
        'directory' => __DIR__ . '/../sessions'
    ] ) )->setName( $di['config']['app']['session']['name'] )->start();
} )->resolve( [], $di );

$di->set( 'router', function() {
    $router     = new Router();
    return $router;
} );
