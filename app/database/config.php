<?php
/* localhost
define('DB_SERVER', 'invetory');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'InventorySys');
*/
define('hostname', 'mysql');
define('username', 'root');
define('password', 'root');
define('database', 'InventorySys');
define('port', '3306'); 

/* Attempt to connect to MySQL database 
localhost: 
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

*/
$con = mysqli_connect(hostname, username, password, database, port);
 
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>