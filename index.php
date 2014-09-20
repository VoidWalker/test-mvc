<?php
echo "This is {$_SERVER['SCRIPT_NAME']}";

require_once 'app' . DIRECTORY_SEPARATOR . 'Sohan.php';

Sohan::run();
//phpinfo();


?>