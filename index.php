<?php
//echo "This is {$_SERVER['SCRIPT_NAME']}";

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once 'app' . DIRECTORY_SEPARATOR . 'Sohan.php';

Sohan::run();

//phpinfo();


?>