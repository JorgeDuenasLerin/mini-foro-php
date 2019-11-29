<?php

//include("$ROOT/src/DWESBaseDatos.php");

$db = DWESBaseDatos::obtenerInstancia();
$db->inicializa($config['db_file'], null, null, $config['db_engine']);

 ?>
