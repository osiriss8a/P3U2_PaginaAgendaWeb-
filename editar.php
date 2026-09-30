<?php

$archivo = "datos.json";

$eventos = [];

if (file_exists($archivo)) {

    $contenido = file_get_contents($archivo);

    $eventos = json_decode($contenido, true) ?? [];

}


$id = $_GET["id"] ?? "";

$eventoEncontrado = null;


foreach ($eventos as $evento) {

    if ((string)$evento["id"] === (string)$id) {

        $eventoEncontrado = $evento;

        break;

    }

}


if (!$eventoEncontrado) {

    header("Location: agenda.php");

    exit;

}


/* ================= ACTUALIZAR ================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    foreach ($eventos as &$evento) {

        if ((string)$evento["id"] === (string)$id) {

            $evento["titulo"] =
                $_POST["titulo"] ?? "";

            $evento["cliente"] =
                $_POST["cliente"] ?? "";

            $evento["fecha"] =
                $_POST["fecha"] ?? "";

            $evento["hora"] =
                $_POST["hora"] ?? "";

            $evento["categoria"] =
                $_POST["categoria"] ?? "";

            $evento["ubicacion"] =
                $_POST["ubicacion"] ?? "";

            $evento["descripcion"] =
                $_POST["descripcion"] ?? "";

            break;

        }

    }

    unset($evento);


    file_put_contents(
        $archivo,
        json_encode(
            $eventos,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        )
    );


    header("Location: agenda.php");

    exit;

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>AgendaWeb - Editar evento</title>

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="css/styles.css"
    >

</head>

<body>

    <div class="glow glow-1"></div>
    <div class="glow glow-2"></div>


    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="brand">

            <div class="brand-icon">

                <i class="fa-solid fa-calendar-days"></i>

            </div>

            <div>

                <h2>
                    Agenda<span>Web</span>
                </h2>

                <p>
                    Organiza tus momentos
                </p>

            </div>

        </div>


        <nav class="menu">

            <a
                href="index.php"
                class="menu-item"
            >

                <i class="fa-solid fa-house"></i>

                <span>
                    Inicio
                </span>

            </a>


            <a
                href="agenda.php"
                class="menu-item active"
            >

                <i class="fa-solid fa-calendar-days"></i>

                <span>
                    Mi Agenda
                </span>

            </a>


            <a
                href="#"
                class="menu-item"
            >

                <i class="fa-regular fa-note-sticky"></i>

                <span>
                    Notas
                </span>

            </a>


            <a
                href="#"
                class="menu-item"
            >

                <i class="fa-solid fa-gear"></i>

                <span>
                    Configuración
                </span>

            </a>

        </nav>


        <div class="sidebar-frase">

            <i class="fa-solid fa-quote-left"></i>

            <p>
                "Organiza tu tiempo y disfruta cada momento."
            </p>

            <i class="fa-solid fa-quote-right"></i>

        </div>


        <div class="sidebar-footer">

            <i class="fa-solid fa-heart"></i>

            <span>
                AgendaWeb
            </span>

        </div>

    </aside>


    <!-- MAIN -->

    <main class="main">


        <header class="topbar">

            <div class="buscador">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    placeholder="Buscar eventos, notas..."
                >

            </div>


            <div class="usuario">

                <button class="notificacion">

                    <i class="fa-regular fa-bell"></i>

                    <span></span>

                </button>


                <div class="avatar">

                    <i class="fa-solid fa-user"></i>

                </div>


                <span>
                    Mi Agenda
                </span>

            </div>

        </header>


        <!-- CONTENIDO -->

        <div class="inicio-contenido">


            <section class="inicio-presentacion">

                <div>

                    <p class="etiqueta">

                        <i class="fa-solid fa-pen"></i>

                        MI AGENDA

                    </p>


                    <h2>
                        Editar evento
                    </h2>


                    <p class="texto-inicio">

                        Modifica la información de tu evento.

                    </p>

                </div>


                <div class="decoracion-calendario">

                    <i class="fa-solid fa-pen-to-square"></i>

                </div>

            </section>


            <!-- FORMULARIO -->

            <section class="formulario-card">

                <div class="formulario-titulo">

                    <div>

                        <h3>
                            Información del evento
                        </h3>

                        <p>
                            Actualiza los datos que necesites.
                        </p>

                    </div>

                    <i class="fa-solid fa-calendar-pen"></i>

                </div>


                <form
                    class="formulario-agenda"
                    method="POST"
                >


                    <div class="campo">

                        <label for="titulo">
                            <i class="fa-solid fa-heading"></i>
                            Título del evento
                        </label>

                        <input
                            type="text"
                            id="titulo"
                            name="titulo"
                            value="<?= htmlspecialchars($eventoEncontrado["titulo"]) ?>"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="cliente">
                            <i class="fa-solid fa-user"></i>
                            Cliente
                        </label>

                        <input
                            type="text"
                            id="cliente"
                            name="cliente"
                            value="<?= htmlspecialchars($eventoEncontrado["cliente"]) ?>"
                        >

                    </div>


                    <div class="campo">

                        <label for="fecha">
                            <i class="fa-regular fa-calendar"></i>
                            Fecha
                        </label>

                        <input
                            type="date"
                            id="fecha"
                            name="fecha"
                            value="<?= htmlspecialchars($eventoEncontrado["fecha"]) ?>"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="hora">
                            <i class="fa-regular fa-clock"></i>
                            Hora
                        </label>

                        <input
                            type="time"
                            id="hora"
                            name="hora"
                            value="<?= htmlspecialchars($eventoEncontrado["hora"]) ?>"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="categoria">
                            <i class="fa-solid fa-tag"></i>
                            Categoría
                        </label>

                        <select
                            id="categoria"
                            name="categoria"
                        >

                            <option value="">
                                Selecciona una categoría
                            </option>

                            <?php

                            $categorias = [
                                "Reunión",
                                "Cita",
                                "Trabajo",
                                "Personal",
                                "Evento"
                            ];

                            foreach ($categorias as $categoria):

                            ?>

                                <option
                                    value="<?= htmlspecialchars($categoria) ?>"
                                    <?= $eventoEncontrado["categoria"] === $categoria ? "selected" : "" ?>
                                >

                                    <?= htmlspecialchars($categoria) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <div class="campo">

                        <label for="ubicacion">
                            <i class="fa-solid fa-location-dot"></i>
                            Ubicación
                        </label>

                        <input
                            type="text"
                            id="ubicacion"
                            name="ubicacion"
                            value="<?= htmlspecialchars($eventoEncontrado["ubicacion"]) ?>"
                        >

                    </div>


                    <div class="campo campo-completo">

                        <label for="descripcion">
                            <i class="fa-solid fa-align-left"></i>
                            Descripción
                        </label>

                        <textarea
                            id="descripcion"
                            name="descripcion"
                        ><?= htmlspecialchars($eventoEncontrado["descripcion"]) ?></textarea>

                    </div>


                    <div class="formulario-botones">

                        <a
                            href="agenda.php"
                            class="btn-limpiar"
                        >

                            <i class="fa-solid fa-arrow-left"></i>

                            Cancelar

                        </a>


                        <button
                            type="submit"
                            class="btn-guardar"
                        >

                            <i class="fa-solid fa-floppy-disk"></i>

                            Guardar cambios

                        </button>

                    </div>


                </form>

            </section>

        </div>


        <footer>

            <i class="fa-solid fa-heart"></i>

            AgendaWeb · Organiza tu tiempo

        </footer>


    </main>

</body>

</html>