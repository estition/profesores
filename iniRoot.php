<?php
define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER['SCRIPT_FILENAME'], 0, (strlen($_SERVER['SCRIPT_FILENAME']) - strlen($_SERVER['PHP_SELF']))));

define('ROOT_URL1', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));

?>