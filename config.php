<?php
define('DBHOST','localhost:3306');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','formi');
try {

    //create PDO connection
    $db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    //show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}
?>