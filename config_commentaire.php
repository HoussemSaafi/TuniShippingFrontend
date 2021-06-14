<?php
define('DB_SERVER', 'sql11.freemysqlhosting.net');
define('DB_USERNAME', 'sql11407789');
define('DB_PASSWORD', '2E4pTsZbBr');
define('DB_DATABASE', 'sql11407789');

$connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die(mysqli_connect_error());

?>
