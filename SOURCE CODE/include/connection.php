<?php



# DATABASE CONFIGURATION
$DBHOST = 'localhost';
$DBUSER = 'root';
$DBPASS = '';
$DBNAME = 'petgroomingsoq';

# DATABASE CONNECTION
try {
    $conn = new PDO("mysql:host=$DBHOST;dbname=$DBNAME", $DBUSER, $DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    print('Aplikasi mengalami kendala serius, harap lapor ke developer!');
    print('<br><strong>t.me/ubaii_id</strong>');
    print('<br>Error didapat: ' . $e->getMessage());
    exit();
}


?>