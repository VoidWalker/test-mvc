<?php
echo "This is {$_SERVER['SCRIPT_NAME']}";

require_once 'app/Sohan.php';

$GLOBALS['ini'] = parse_ini_file('config.ini');

Sohan::run();
//phpinfo();

?>