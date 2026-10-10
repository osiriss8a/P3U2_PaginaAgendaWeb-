

<?php

// Limpia el texto antes de mostrarlo en HTML.
function e(?string $texto): string
{
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

// Convierte la fecha al formato día/mes/año.
function formatearFecha(string $fecha): string
{
    return date('d/m/Y', strtotime($fecha));
}

// Convierte la clave de la categoría en un nombre legible.
function nombreCategoria(string $clave): string
{
    $nombres = [
        'trabajo' => 'Trabajo',
        'personal' => 'Personal',
        'estudio' => 'Estudio',
        'ocio' => 'Ocio / Deporte',
    ];

    return $nombres[$clave] ?? $clave;
}

// Arreglo con los tres eventos de ejemplo.
$eventos = [
    [
        'id' => 1,
        'titulo' => 'Reunión de academia',
        'fecha' => '2026-10-08',
        'hora' => '10:30:00',
        'categoria' => 'trabajo',
        'descripcion' => 'Revisar calificaciones del 1er parcial.'
    ],
    [
        'id' => 2,
        'titulo' => 'Gimnasio',
        'fecha' => '2026-10-09',
        'hora' => '07:00:00',
        'categoria' => 'ocio',
        'descripcion' => null
    ],
    [
        'id' => 3,
        'titulo' => 'Entregar P4 de Aplicaciones Web',
        'fecha' => '2026-10-12',
        'hora' => null,
        'categoria' => 'estudio',
        'descripcion' => 'Subir el repositorio y publicar en DomCloud.'
    ]
];

// Función que construye la tarjeta de un evento.
function mostrarEvento(array $ev): string
{
    $html = '<article class="card">';

    $html .= '<span class="card__badge">'
           . e(nombreCategoria($ev['categoria']))
           . '</span>';

    $html .= '<h2 class="card__title">'
           . e($ev['titulo'])
           . '</h2>';

    $cuando = formatearFecha($ev['fecha']);

    // Agrega la hora si existe.
    if ($ev['hora']) {
        $cuando .= ' · ' . substr($ev['hora'], 0, 5);
    }

    $html .= '<p class="card__meta"><time datetime="'
           . e($ev['fecha']) . '">'
           . e($cuando)
           . '</time></p>';

    // Agrega la descripción si existe.
    if ($ev['descripcion']) {
        $html .= '<p class="card__text">'
               . e($ev['descripcion'])
               . '</p>';
    }

    $id = (int) $ev['id'];

    $html .= '<div class="card__actions">'
           . '<a href="editar.php?id=' . $id
           . '" class="btn-secondary btn-sm">Editar</a>'
           . '<form method="post" action="borrar.php" class="form-inline">'
           . '<input type="hidden" name="id" value="' . $id . '">'
           . '<button type="submit" class="btn-danger btn-sm">Borrar</button>'
           . '</form></div>';

    return $html . '</article>';
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de eventos</title>
</head>
<body>

    <h1>Mis eventos</h1>

    <!-- Muestra el aviso cuando la URL contiene ?ok=1. -->
    <?php if (isset($_GET['ok']) && $_GET['ok'] === '1'): ?>
        <div class="alert alert--ok" role="status">
            Evento guardado correctamente.
        </div>
    <?php endif; ?>

    <!-- Muestra la cantidad de eventos. -->
    <p><?= count($eventos) ?> eventos registrados</p>

    <!-- Si no hay eventos, muestra el estado vacío. -->
    <?php if (empty($eventos)): ?>

        <div class="empty-state">
            <h2>No tienes eventos registrados</h2>
            <p>Cuando agregues un evento, aparecerá aquí.</p>
        </div>

    <?php else: ?>

        <!-- Si hay eventos, genera las tarjetas automáticamente. -->
        <section class="card-list" aria-label="Lista de eventos">

            <?php foreach ($eventos as $ev): ?>
                <?= mostrarEvento($ev) ?>
            <?php endforeach; ?>

        </section>

    <?php endif; ?>

</body>
</html>

