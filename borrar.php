<?php

$archivo = "datos.json";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = $_POST["id"] ?? "";

    if (file_exists($archivo)) {

        $contenido = file_get_contents($archivo);

        $eventos = json_decode($contenido, true) ?? [];

        $eventos = array_filter(
            $eventos,
            function ($evento) use ($id) {

                return (string)$evento["id"] !== (string)$id;

            }
        );


        file_put_contents(
            $archivo,
            json_encode(
                array_values($eventos),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );

    }

}

header("Location: agenda.php");

exit;

?>
