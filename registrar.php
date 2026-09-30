<?php

$archivo = "datos.json";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $eventos = [];

    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        $eventos = json_decode($contenido, true) ?? [];
    }

    $nuevoEvento = [
        "id" => time(),
        "titulo" => $_POST["titulo"] ?? "",
        "cliente" => $_POST["cliente"] ?? "",
        "fecha" => $_POST["fecha"] ?? "",
        "hora" => $_POST["hora"] ?? "",
        "categoria" => $_POST["categoria"] ?? "",
        "ubicacion" => $_POST["ubicacion"] ?? "",
        "descripcion" => $_POST["descripcion"] ?? ""
    ];

    $eventos[] = $nuevoEvento;

    file_put_contents(
        $archivo,
        json_encode($eventos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );

    header("Location: index.php?ok=1");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AgendaWeb</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <!-- Brillos del fondo -->
    <div class="glow glow-1"></div>
    <div class="glow glow-2"></div>

    <!-- =========================
         BARRA LATERAL
    ========================== -->
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">
                <i class="fa-regular fa-calendar"></i>
            </div>
            <div>
                <h2>Agenda<span>Web</span></h2>
                <p>Organiza tu tiempo</p>
            </div>
        </div>

        <nav class="menu">
            <a href="index.php" class="menu-item">
    <i class="fa-solid fa-house"></i>
    <span>Inicio</span>
</a>

<a href="agenda.php" class="menu-item">
    <i class="fa-solid fa-calendar-days"></i>
    <span>Mi Agenda</span>
</a>

<a href="notas.php" class="menu-item">
    <i class="fa-regular fa-note-sticky"></i>
    <span>Notas</span>
</a>

<a href="#" class="menu-item">
    <i class="fa-solid fa-gear"></i>
    <span>Configuración</span>
</a>
        </nav>

        <div class="sidebar-frase">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
            <p>
                Grandes cosas también se logran
                con una buena organización.
            </p>
            <i class="fa-regular fa-heart"></i>
        </div>
        <div class="sidebar-footer">
            <i class="fa-solid fa-pen-nib"></i>
            <span>AgendaWeb</span>
        </div>
    </aside>
    <!-- =========================
         CONTENIDO PRINCIPAL
    ========================== -->
    <main class="main">

        <!-- BARRA SUPERIOR -->
        <header class="topbar">
            <div class="buscador">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="text"
                    placeholder="Buscar eventos, notas...">
            </div>
            <div class="usuario">
                <button class="notificacion">
                    <i class="fa-regular fa-bell"></i>
                    <span></span>
                </button>
                <div class="avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                <strong>Mi Agenda</strong>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </header>

        <!-- =========================
             DASHBOARD
        ========================== -->
        <section class="dashboard">

            <!-- =====================
                 FORMULARIO
            ====================== -->
            <section class="evento-card">
                <div class="evento-header">
                    <div>
                        <div class="mini-titulo">
                            <i class="fa-regular fa-calendar"></i>
                            CREAR EVENTO
                        </div>
                        <h1>
                            Crear nuevo evento
                        </h1>
                        <p>
                            Agrega una cita a tu agenda y
                            mantén todo en orden.
                        </p>
                    </div>
                    <div class="evento-icon">
                        <i class="fa-regular fa-calendar-check"></i>
                    </div>
                </div>

                <!-- FORMULARIO -->
                <form class="formulario" method="POST" action="registrar.php">

                    <!-- TÍTULO -->
                    <div class="campo campo-full">
                        <label for="titulo">
                            <i class="fa-regular fa-calendar"></i>
                            Título del evento
                            <b>*</b>
                        </label>

                        <input
                            type="text"
                            id="titulo"
                            name="titulo"
                            placeholder="Ej. Reunión con cliente"
                            required>
                    </div>

                    <!-- CLIENTE -->
                    <div class="campo campo-full">
                        <label for="cliente">
                            <i class="fa-regular fa-user"></i>
                            Cliente
                        </label>
                        <input
                            type="text"
                            id="cliente"
                            name="cliente"
                            placeholder="Nombre del cliente">
                    </div>

                    <!-- FECHA Y HORA -->
                    <div class="form-grid">
                        <div class="campo">
                            <label for="fecha">
                                <i class="fa-regular fa-calendar"></i>
                                Fecha
                                <b>*</b>
                            </label>
                            <input
                                type="date"
                                id="fecha"
                                name="fecha"
                                required>
                        </div>

                        <div class="campo">
                            <label for="hora">
                                <i class="fa-regular fa-clock"></i>
                                Hora
                                <b>*</b>
                            </label>
                            <input
                                type="time"
                                id="hora"
                                name="hora"
                                required>
                        </div>
                    </div>

                    <!-- CATEGORÍA Y UBICACIÓN -->
                    <div class="form-grid">
                        <div class="campo">
                            <label for="categoria">
                                <i class="fa-solid fa-layer-group"></i>
                                Categoría
                            </label>

                            <select id="categoria" name="categoria">
                                <option>
                                    Selecciona una categoría
                                </option>
                                <option>
                                    Trabajo
                                </option>
                                <option>
                                    Cita
                                </option>
                                <option>
                                    Personal
                                </option>
                                <option>
                                    Evento
                                </option>
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
                                placeholder="¿Dónde será?">
                        </div>
                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div class="campo campo-full">
                        <label for="descripcion">
                            <i class="fa-regular fa-note-sticky"></i>
                            Descripción
                        </label>
                        <textarea
                            id="descripcion"
                            name="descripcion"
                            placeholder="Agrega detalles de tu evento..."></textarea>
                    </div>

                    <!-- BOTONES -->
                    <div class="acciones">
                        <div class="mensaje">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                            Pequeños pasos,
                            grandes resultados.
                        </div>

                        <div class="botones">
                            <button
                                type="reset"
                                class="btn btn-limpiar">
                                <i class="fa-solid fa-rotate-left"></i>
                                Limpiar
                            </button>
                            <button
                                type="submit"
                                class="btn btn-guardar">
                                <i class="fa-solid fa-plus"></i>
                                Guardar evento
                            </button>
                        </div>
                    </div>
                </form>
            </section>

            <!-- =========================
                 PANEL DE NOTAS
            ========================== -->
            <aside class="notas-panel">
                <div class="notas-header">
                    <div>
                        <div class="mini-titulo">
                            <i class="fa-regular fa-note-sticky"></i>
                            ORGANIZACIÓN
                        </div>
                        <h2>
                            Mis notas
                        </h2>
                        <p>
                            Ideas, recordatorios y cosas importantes.
                        </p>
                    </div>

                    <button class="btn-add">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <!-- NOTA 1 -->
                <article class="nota nota-morada">
                    <div class="nota-top">
                        <div class="nota-icon">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <button class="nota-menu">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                    </div>

                    <h3>
                        Reunión importante
                    </h3>
                    <p>
                        Recordar llevar los documentos
                        para la reunión del cliente.
                    </p>

                    <div class="nota-info">
                        <span>
                            <i class="fa-regular fa-calendar"></i>
                            Hoy
                        </span>
                        <span class="tag">
                            Importante
                        </span>
                    </div>

                    <div class="nota-acciones">
                        <button>
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button>
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </article>

                <!-- NOTA 2 -->
                <article class="nota nota-rosa">
                    <div class="nota-top">
                        <div class="nota-icon">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                        <button class="nota-menu">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                    </div>

                    <h3>
                        Ideas para proyecto
                    </h3>

                    <p>
                        Revisar nuevas ideas para mejorar
                        la presentación de AgendaWeb.
                    </p>

                    <div class="nota-info">
                        <span>
                            <i class="fa-regular fa-calendar"></i>
                            Mañana
                        </span>

                        <span class="tag">
                            Creatividad
                        </span>
                    </div>

                    <div class="nota-acciones">
                        <button>
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button>
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </article>

                <!-- NOTA 3 -->
                <article class="nota nota-azul">
                    <div class="nota-top">
                        <div class="nota-icon">
                            <i class="fa-regular fa-lightbulb"></i>
                        </div>
                        <button class="nota-menu">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                    </div>

                    <h3>
                        Pendientes
                    </h3>

                    <p>
                        Terminar presentación y revisar
                        los últimos detalles.
                    </p>

                    <div class="nota-info">
                        <span>
                            <i class="fa-regular fa-calendar"></i>
                            Viernes
                        </span>
                        <span class="tag">
                            Trabajo
                        </span>
                    </div>

                    <div class="nota-acciones">
                        <button>
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button>
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </article>

                <!-- NOTA 4 -->
                <article class="nota nota-gris">
                    <div class="nota-top">
                        <div class="nota-icon">
                            <i class="fa-regular fa-circle-check"></i>
                        </div>
                        <button class="nota-menu">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                    </div>

                    <h3>
                        Recordatorio personal
                    </h3>

                    <p>
                        Llamar y confirmar la cena
                        del sábado.
                    </p>

                    <div class="nota-info">
                        <span>
                            <i class="fa-regular fa-calendar"></i>
                            Sábado
                        </span>
                        <span class="tag">
                            Personal
                        </span>
                    </div>

                    <div class="nota-acciones">
                        <button>
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button>
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </article>

                <!-- BOTÓN NUEVA NOTA -->
                <button class="nueva-nota">
                    <i class="fa-solid fa-plus"></i>
                    Crear nueva nota
                </button>
            </aside>
        </section>

        <!-- FOOTER -->
        <footer>
            <i class="fa-regular fa-heart"></i>
            Tu tiempo, en buenas manos.
        </footer>
    </main>
</body>
</html>