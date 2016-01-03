<?php

// This version works on Debian when using the php-amqplib Debian package

spl_autoload_register(
    function ($class) {
        include str_replace("\\", "/", $class) . '.php';
    }
);

use PhpAmqpLib\Connection\AMQPStreamConnection;

define('HOST', 'localhost');
define('PORT', 5672);
define('USER', 'guest');
define('PASS', 'guest');
define('VHOST', '/');

$conn = new AMQPStreamConnection(HOST, PORT, USER, PASS, VHOST);
$channel = $conn->channel();

$channel->exchange_declare('logs-exchange', 'topic', false, true, false);

$channel->queue_declare('msg-inbox-errors', false, true, false, false);
$channel->queue_declare('msg-inbox-logs', false, true, false, false);
$channel->queue_declare('all-logs', false, true, false, false);

$channel->queue_bind('msg-inbox-errors', 'logs-exchange', 'error.msg-inbox');
$channel->queue_bind('msg-inbox-logs', 'logs-exchange', '*.msg-inbox');

?>
