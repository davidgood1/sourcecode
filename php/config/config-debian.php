<?php
###############################################
# RabbitMQ in Action
#
# Requires: php-amqplib
#
# Author: Alvaro Videla
# (C)2010
###############################################

spl_autoload_register(
    function ($class) {
        include str_replace("\\", "/", $class) . '.php';
    }
);

define('HOST', 'localhost');
define('PORT', 5672);
define('USER', 'guest');
define('PASS', 'guest');
define('VHOST', '/');

?>