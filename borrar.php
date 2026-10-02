<?php

require_once "conexion.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: agenda.php");

    exit;

}


$id = isset($_POST["id"])
    ? (int) $_POST["id"]
    : 0;


if ($id <= 0) {

    header("Location: agenda.php");

    exit;

}


$sql = "DELETE FROM eventos WHERE id = :id";


$stmt = $pdo->prepare($sql);


$stmt->execute([
    ":id" => $id
]);


header("Location: agenda.php");

exit;

?>