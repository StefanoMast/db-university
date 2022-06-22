<?php 

require_once __DIR__ . "./Department.php";
require_once __DIR__ . "./database.php";

// define("DB_SERVERNAME", "localhost");
// define("DB_USERNAME", "root");
// define("DB_PASSWORD", "root");
// define("DB_NAME", "university");
// define("DB_PORT", 3306);

// $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

// //per fare controllo se il nostro database è connesso a php. Se non c'è nessun errore la pagina rimane vuota
// if( $conn && $conn->connect_error) {
//     echo "DB connection error" . $conn->connect_error;
//     die();
// }

//prepariamo la query per il database
$sql = "SELECT `id`, `name` FROM `departments`;"; //query
$result = $conn->query($sql); //result è la variabile che ci restituisce il risultato della query. Possiamo anche fare un controllo su result

// var_dump($result);

//prepariamo un array vyuoto e lavoriamo sul result per prendere i valori nascosti all'interno di questo oggetto

$departments = [];

//controllo se il risultato c'è e se non è vuoto
if ($result && $result->num_rows>0) {
    //abbiamo i risultati della query
    while ($row = $result->fetch_assoc()) { //fetch_assoc è un metodo. Row è un record della tabella che è un array associato
        // var_dump($row); la row possiamo salvarla all0interno di departments
        //da questo momento ho a che fare con gli oggetti e non più con il databse
        $curr_department = new Department($row["id"], $row ["name"]);
        $departments[] = $curr_department; //abbiamo salvato row nell'array departmets creato vuoto in precedenza
    }
} elseif ($result) {
    //query è andata a buon fine, ma non ci sono risultati
} else {
    //query non è andata a buon fine e che c'è un errore di sintassi nella query
    echo "Query error";
    die();
}

// var_dump($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Lista dei dipartimenti</h1>
<?php foreach($departments as $department) { ?>
    <div>
        <h2><?php echo $department->name; ?></h2>
        <a href="single-department.php?id=<?php echo $department->id; ?>">Vedi informazioni</a>
    </div>
<?php } ?>
    
</body>
</html>