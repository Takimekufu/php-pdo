<?php
require_once "connection.php";
require_once "classes/DataBase.php";

$db = new DataBase($conn);
$db->deleteDb();
$db->createDb();
$db->migrate();
unset($conn, $db);

header("Location: http://php-pdo/");
exit;