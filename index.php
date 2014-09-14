<?php
echo "This is {$_SERVER['SCRIPT_NAME']}";

require_once 'app/Dad.php';
Dad::run();
//phpinfo();
?>