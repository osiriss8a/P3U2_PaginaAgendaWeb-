<?php
// Indexado: cada valor tiene una POSICIÓN (empieza en 0)
$categorias = ['trabajo', 'personal', 'estudio', 'ocio'];
echo $categorias[0] . '<br>';        // ?
echo count($categorias) . '<br>';   // ?

// Asociativo: cada valor tiene una CLAVE con nombre
$evento = ['titulo' => 'Examen de Cálculo', 'fecha' => '2026-10-08'];
echo $evento['titulo'];   

/*
$categorias[0]: obtiene el primer elemento, que es trabajo.
count($categorias): cuenta cuántos elementos hay: 4.
$evento['titulo']: busca la clave titulo, cuyo valor es Examen de Cálculo.
*/ 