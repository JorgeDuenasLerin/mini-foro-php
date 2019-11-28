<?php

//include("$ROOT/src/DWESBaseDatos.php");

$db = DWESBaseDatos::obtenerInstancia();
$db->inicializa($config['db_file'], null, null, $config['db_engine']);



function listadoTemas ($titulo = '', $pagina = 1) {
    global $db;
    $db -> ejecuta("SELECT t.id, t.titulo, t.nombre, t.etiqueta, t.creado, COUNT(*) as respuestas
                    FROM Tema t
                    LEFT JOIN Respuesta r ON (t.id = r.id_tema)
                    GROUP BY t.id, t.titulo, t.nombre, t.etiqueta, t.creado
                    ");
    return $db -> obtenDatos();
}

 ?>
