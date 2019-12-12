<?php
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";

define ("MB_2", 2097152); // Esto se puede y debe sacar al config

$titulo = "";
$nombre = "";
$etiqueta = "";

$errores = [];

if(count($_POST)>0) {

    if(isset($_POST['titulo']) && $_POST['titulo'] != "") {
        $titulo = $_POST['titulo'];
    } else {
        $errores[] = "Sin titulo";
    }

    if(isset($_POST['nombre']) && $_POST['nombre'] != "") {
        $nombre = $_POST['nombre'];
    } else {
        $errores[] = "Sin nombre";
    }

    if(isset($_POST['etiqueta']) && $_POST['etiqueta'] != "") {
        $etiqueta = $_POST['etiqueta'];
    } else {
        $errores[] = "Sin etiqueta";
    }

    if(count($_FILES)>0) {
        if($_FILES['imagen']['size'] < MB_2){
            if($_FILES['imagen']['type'] == "image/png" || $_FILES['imagen']['type'] == "image/jpeg"){
                // Gestionamos la información del fichero
                $fichero_tmp = $_FILES["imagen"]["tmp_name"];
                $nombre_real = basename($_FILES["imagen"]["name"]);
                $ruta_destino = $config['img_path']."/".$nombre_real;

                echo "Depuración<br>";
                echo "$fichero_tmp <br>$nombre_real <br>$ruta_destino <br>";

                /*
                Si existe lo machacamos. Tener en cuenta
                if (file_exists($ruta_destino)) {
                    // Procesar error
                }
                */

            } else {
                $errores[] = "Fichero no soportado";
            }
        } else {
            $errores[] = "Fichero gigante";
        }
    } else {
        $errores[] = "Sin imagen";
    }

    if(count($errores) == 0) {
        // Metemos en la base de datos el nombre real
        $id = TemaManager::insert($titulo, $nombre, $etiqueta, $nombre_real);
        if($id){
            if (move_uploaded_file($fichero_tmp, $ROOT.$ruta_destino)) {
                echo "<h1>TODO bien!!</h1>";
                echo "<h1><a href=\"listado_temas.php\">REDIRECCIÓN AUTOMÁTICA AL LISTADO</a></h1>";
            } else {
                $errores[] = "Error moviendo fichero";
                // Ojo!!!
                $borrado = TemaManager::delete($id);

                if(!$borrado) {
                    // Ha ocurrido un error extraño
                    // Debemos reportarlo y que un admin
                    // Deje la información correcta
                    // Hay un tema sin imagen
                    // También podríamos usar transacciones de base de datos
                }
            }
        } else {
            $errores[] = "Error en la insercción";
        }
    }
}

 ?>


<h1>Crear nuevo tema</h1>
<div class="">
  <div style="color:red;">
    <?php foreach ($errores as $key => $value) { ?>
      <div class=""><?=$value?></div>
    <?php } ?>
  </div>
  <form class="" action="crea_tema.php" method="post" enctype="multipart/form-data">
    <input type="text" name="titulo" placeholder="titulo" value="<?=$titulo?>"><br>
    <input type="text" name="nombre" placeholder="nombre" value="<?=$nombre?>"><br>
    <input type="text" name="etiqueta" placeholder="etiqueta" value="<?=$etiqueta?>"><br>
    <input type="file" name="imagen" accept="image/png, image/jpeg"><br>
    <input type="submit" value="Crear Tema" name="submit">
  </form>
</div>
