<?php

require_once "conexion.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: index.html");
    exit;

}


/* =========================
   RECIBIR DATOS
   ========================= */

$titulo = trim($_POST["titulo"] ?? "");

$cliente = trim($_POST["cliente"] ?? "");

$fecha = $_POST["fecha"] ?? "";

$hora = $_POST["hora"] ?? "";

$categoria = $_POST["categoria"] ?? "";

$ubicacion = trim($_POST["ubicacion"] ?? "");

$descripcion = trim($_POST["descripcion"] ?? "");


/* =========================
   VALIDACIONES
   ========================= */

if ($titulo === "") {

    die("El título es obligatorio.");

}


if ($cliente === "") {

    die("El nombre del cliente es obligatorio.");

}


if ($fecha === "") {

    die("La fecha es obligatoria.");

}


if ($hora === "") {

    die("La hora es obligatoria.");

}


if ($categoria === "") {

    die("La categoría es obligatoria.");

}


/* =========================
   VALIDAR CATEGORÍA
   ========================= */

$categoriasPermitidas = [
    "Evento",
    "Trabajo",
    "Cita",
    "Personal"
];


if (!in_array($categoria, $categoriasPermitidas, true)) {

    die("La categoría seleccionada no es válida.");

}


/* =========================
   INSERTAR EN MYSQL
   ========================= */

$sql = "INSERT INTO eventos
        (titulo, cliente, fecha, hora, categoria, ubicacion, descripcion)
        VALUES
        (:titulo, :cliente, :fecha, :hora, :categoria, :ubicacion, :descripcion)";


$stmt = $pdo->prepare($sql);


$stmt->execute([

    ":titulo" => $titulo,

    ":cliente" => $cliente,

    ":fecha" => $fecha,

    ":hora" => $hora,

    ":categoria" => $categoria,

    ":ubicacion" => $ubicacion,

    ":descripcion" => $descripcion

]);


/* =========================
   REGRESAR A MI AGENDA
   ========================= */

header("Location: agenda.php?guardado=1");

exit;

?>