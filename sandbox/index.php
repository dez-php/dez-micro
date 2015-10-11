<?php

namespace App;

use Dez\Db\Exception;
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

    $app->get( '/:controller/:action', function() use ( $app ) {
        return $app->view->render( 'index.php' );
    } );

    $app->any( '/login.html', function() use ( $app ) {
        return 'Hello world! ' . $app->router->getMatchedRoute()->getRouteId();
    } );

    $app->any( '/logout.html', function() use ( $app ) {
        return 'Hello world! ';
    } );

    $app->any( '/add-new-post.html', function() use ( $app ) {
        return 'Hello world! ' . $app->router->getTargetUri();
    } );

    $app->any( '/posts', function() {
        return 'Post list!';
    } )->via( [ 'get', 'post' ] );

    $app->any( '/posts/:id-:pseudo.html', function() {
        return 'Item!' . var_dump( func_get_args() );
    } )->via( [ 'get', 'post' ] );

    $app->any( '/posts.json', function() use ( $app ) {
        $app->response->setBodyFormat( Response::RESPONSE_API_JSON );
        return [
            [ 1, 2, 3, ]
        ];
    } )->via( [ 'get' ] );

    $app->any( '/:controller/:action.:auth_driver/:format', function() use ( $app ) {
        $app->response->setBodyFormat( Response::RESPONSE_API_JSON );
        return [
            'request' => func_get_args()
        ];
    } )->via( [ 'get' ] );

    $app->execute();

} catch ( \Exception $e ) {
    header( 'content-type: text/plain' );
    die( get_class( $e ) . ': ' . $e->getMessage() );
}