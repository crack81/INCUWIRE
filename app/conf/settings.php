<?php

/*DATABASE SETTINGS*/
define('DATABASE','incuwire');
define('DB_USER','root');
define('DB_PASSWORD','secret');
define('PORT',3306);
define('HOST','localhost');



/*PATH SETTINGS*/
define('ROOT_PATH',$_SERVER['DOCUMENT_ROOT']);
define('LIB_PATH',ROOT_PATH . 'lib/');
define('APP_PATH',ROOT_PATH . 'app/');
define('CONF_PATH',APP_PATH . 'conf/');
define('ROUTES_PATH',APP_PATH . 'routes/');