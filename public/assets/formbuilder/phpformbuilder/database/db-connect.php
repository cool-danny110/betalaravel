<?php

/* database connection */

if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1') {
    define('DBUSER', 'root');
    define('DBPASS', 'mysql');
    define('DBHOST', 'localhost');
    define('DBNAME', 'phpformbuilder');
} else {
    define('DBUSER', 'db-user');
    define('DBPASS', 'db-pass');
    define('DBHOST', 'your-db-host.com');
    define('DBNAME', 'db-name');
}
define('DB', 'mysql:host=' . DBHOST . ';dbname=' . DBNAME);
