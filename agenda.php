<?php

$archivo = "datos.json";

$eventos = [];

if (file_exists($archivo)) {

    $contenido = file_get_contents($archivo);

    $eventos = json_decode($contenido, true) ?? [];

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

    <title>AgendaWeb - Mi Agenda</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

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


    <!-- ================= SIDEBAR ================= -->

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


    <!-- ================= MAIN ================= -->

    <main class="main">


        <!-- TOPBAR -->

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


        <!-- ================= CONTENIDO ================= -->

        <div class="inicio-contenido">


            <!-- ENCABEZADO -->

            <section class="inicio-presentacion">

                <div>

                    <p class="etiqueta">

                        <i class="fa-solid fa-calendar-days"></i>

                        MI AGENDA

                    </p>


                    <h2>
                        Mis eventos
                    </h2>


                    <p class="texto-inicio">

                        Aquí puedes consultar todos los eventos
                        que has registrado en tu agenda.

                    </p>

                </div>


                <div class="contador-eventos">

                    <strong>
                        <?= count($eventos) ?>
                    </strong>

                    <span>
                        eventos
                    </span>

                </div>

            </section>


            <!-- BOTÓN NUEVO -->

            <div class="agenda-accion">

                <a
                    href="index.php"
                    class="btn-nuevo"
                >

                    <i class="fa-solid fa-plus"></i>

                    Nuevo evento

                </a>

            </div>


            <?php if (count($eventos) > 0): ?>


                <!-- LISTA DE EVENTOS -->

                <div class="eventos-lista">


                    <?php foreach ($eventos as $evento): ?>

                        <article class="evento-card-agenda">


                            <div class="evento-contenido">


                                <?php if (!empty($evento["categoria"])): ?>

                                    <span class="evento-categoria">

                                        <?= htmlspecialchars($evento["categoria"]) ?>

                                    </span>

                                <?php endif; ?>


                                <h3>

                                    <?= htmlspecialchars($evento["titulo"]) ?>

                                </h3>


                                <?php if (!empty($evento["cliente"])): ?>

                                    <p>

                                        <i class="fa-solid fa-user"></i>

                                        <?= htmlspecialchars($evento["cliente"]) ?>

                                    </p>

                                <?php endif; ?>


                                <div class="evento-datos">


                                    <?php if (!empty($evento["fecha"])): ?>

                                        <span>

                                            <i class="fa-regular fa-calendar"></i>

                                            <?= htmlspecialchars($evento["fecha"]) ?>

                                        </span>

                                    <?php endif; ?>


                                    <?php if (!empty($evento["hora"])): ?>

                                        <span>

                                            <i class="fa-regular fa-clock"></i>

                                            <?= htmlspecialchars($evento["hora"]) ?>

                                        </span>

                                    <?php endif; ?>


                                    <?php if (!empty($evento["ubicacion"])): ?>

                                        <span>

                                            <i class="fa-solid fa-location-dot"></i>

                                            <?= htmlspecialchars($evento["ubicacion"]) ?>

                                        </span>

                                    <?php endif; ?>


                                </div>


                                <?php if (!empty($evento["descripcion"])): ?>

                                    <p class="evento-descripcion">

                                        <?= nl2br(
                                            htmlspecialchars(
                                                $evento["descripcion"]
                                            )
                                        ) ?>

                                    </p>

                                <?php endif; ?>


                            </div>


                            <!-- BOTONES -->

                            <div class="evento-botones">


                                <a
                                    href="editar.php?id=<?= urlencode($evento["id"]) ?>"
                                    class="btn-editar"
                                >

                                    <i class="fa-solid fa-pen"></i>

                                    Editar

                                </a>


                                <form
                                    action="borrar.php"
                                    method="POST"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar este evento?');"
                                >

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= htmlspecialchars($evento["id"]) ?>"
                                    >


                                    <button
                                        type="submit"
                                        class="btn-eliminar"
                                    >

                                        <i class="fa-solid fa-trash"></i>

                                        Eliminar

                                    </button>

                                </form>


                            </div>


                        </article>

                    <?php endforeach; ?>


                </div>


            <?php else: ?>


                <!-- AGENDA VACÍA -->

                <section class="agenda-vacia">

                    <div class="agenda-vacia-icono">

                        <i class="fa-regular fa-calendar-xmark"></i>

                    </div>


                    <h3>
                        No tienes eventos todavía
                    </h3>


                    <p>
                        Comienza agregando tu primer evento a AgendaWeb.
                    </p>


                    <a
                        href="index.php"
                        class="btn-nuevo"
                    >

                        <i class="fa-solid fa-plus"></i>

                        Crear primer evento

                    </a>

                </section>


            <?php endif; ?>


        </div>


        <footer>

            <i class="fa-solid fa-heart"></i>

            AgendaWeb · Organiza tu tiempo

        </footer>


    </main>

</body>

</html>