<?php
//dobbiamo prendere le informazioni del singolo dipartimento dal database

require_once __DIR__ . "./database.php";
require_once __DIR__ . "/Department.php";

$id = $_GET["id"];
$sql = "SELECT * FROM `departments` WHERE `id`= $id;";
$result = $conn->query($sql);
// var_dump($result); //così ho prelevato una riga

$departments = [];

if ($result && $result->num_rows>0) {
    while ($row = $result->fetch_assoc()) {
        $curr_department = new Department($row["id"], $row["name"]);
        $curr_department->setContactData($row["address"], $row["phone"], $row["email"], $row["website"]);
        $curr_department->head_of_department = $row["head_of_department"];
        $departments[] =$curr_department;
    }

    // var_dump($departments);

} elseif ($result) {
    echo "il dipartimento non è stato trovato";
} else {
    echo "errore nella query";
}
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
<?php foreach ($departments as $department) { ?>
    <h1><?php echo $department->name; ?></h1>
    <p><?php echo $department->head_of_department; ?></p>

    <h2>Contatti</h2>
    <ul>
        <?php foreach($department->getContactsAsArray() as $key => $value) { ?>
            <li><?php echo "$key: $value" ?></li>
        <?php } ?>
       
    </ul>
<?php } ?>
</body>
</html>