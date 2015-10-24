<?php

namespace App;

use Dez\Http\Response;
use Dez\Micro\Application;

include_once '../vendor/autoload.php';

try {

    include_once 'config/_services.php';

    $app    = new Application();

    $app->error( function( $message ) use ( $app ) {
        $app->view->set( 'message', $message );
        return $app->view->render( 'error.php' );
    } );

    $app->notFound( function() use ( $app ) {
        $app->view->set( 'url', $app->router->getTargetUri() );
        return $app->view->render( '404.php' );
    } );

    $app->get( '/', function() use ( $app ) {
        var_dump($this); die;
        return $this->view->render( 'index.php' );
    } );

    $app->execute();

} catch ( \Exception $e ) {
    header( 'content-type: text/plain' );
    die( get_class( $e ) . ': ' . $e->getMessage() );
}