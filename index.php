<?php
echo "This is {$_SERVER['SCRIPT_NAME']}";

require_once 'app/Dad.php';
$GLOBALS['ini'] = parse_ini_file('config.ini');

Dad::run();
//phpinfo();

?>