<?php
// Start with
// php -S localhost:8080 ./graphql.php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/json_header.php';
use \App\Data\DataSource;
use \App\Types;
use \GraphQL\Type\Schema;
use \GraphQL\GraphQL;
use \GraphQL\Error\FormattedError;
use \GraphQL\Error\Debug;

// Disable default PHP error reporting - we have better one for debug mode (see bellow)
ini_set('display_errors', 0);
$output = [];
$debug = false;
if (!empty($_GET['debug'])) {
    set_error_handler(function($severity, $message, $file, $line) use (&$phpErrors) {
        throw new ErrorException($message, 0, $severity, $file, $line);
    });
    $debug = Debug::INCLUDE_DEBUG_MESSAGE | Debug::INCLUDE_TRACE;
}

try {
    // Initialize our database connection
    DataSource::init();

    // Parse incoming query and variables
    if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
        $raw = file_get_contents('php://input') ?: '';
        $data = json_decode($raw, true) ?: [];
    } else {
        $data = $_REQUEST;
    }

    $data += ['query' => null, 'variables' => null];

    if (null === $data['query']) {
        $data['query'] = '{conferences {name}}';
    }


    // #################################
    // EXERCISE #5
    // INITIALIZE SCHEMA INSTANCE WITH QUERY TYPE
    // AND THEN EXECUTE THE QUERY AND SET THE RESULT
    // TO $OUTPUT (WHICH IS RETURNED BELOW)
    // #################################
    //

    $httpStatus = 200;
} catch (\Exception $error) {
    $httpStatus = 500;
}
echo json_encode($output);
