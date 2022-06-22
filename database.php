<?php
require_once __DIR__ . "./Department.php";

define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "university");
define("DB_PORT", 3306);

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

//per fare controllo se il nostro database è connesso a php. Se non c'è nessun errore la pagina rimane vuota
if( $conn && $conn->connect_error) {
    echo "DB connection error" . $conn->connect_error;
    die();
}