<?php

namespace App;

use Dez\Micro\Application;

error_reporting(1); ini_set('display_errors', 1);

include_once '../vendor/autoload.php';

try {

    include_once 'config/_services.php';

    $app    = new Application();

    var_dump( $app->count() );

} catch ( \Exception $e ) {
    header( 'content-type: text/plain' );
    die( get_class( $e ) . ': ' . $e->getMessage() );
}