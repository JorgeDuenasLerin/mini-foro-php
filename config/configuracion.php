<?php

$config = [
  'site' => 'Proyecto',
  'title' => 'Estructura de proyecto web',
  'content' => 'Estructura de proyecto web',
  'content_text' => 'Información sacada del config',
  'db_engine' => 'sqlite',
  'db_file' => 'resources/test.sqlite3',
  'img_path' => '/resources/images',
  'img_in_url' => '/images',
];

spl_autoload_register(function ($name){
  global $ROOT;
  $class_file = "$ROOT/src/$name.php";
  require($class_file);
});


function startsWith ($string, $startString) {
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}
