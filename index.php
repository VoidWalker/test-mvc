<?php
echo "This is {$_SERVER['SCRIPT_NAME']}";

error_reporting(E_ALL);

require_once 'app' . DIRECTORY_SEPARATOR . 'Sohan.php';

Sohan::run();

//phpinfo();


?>