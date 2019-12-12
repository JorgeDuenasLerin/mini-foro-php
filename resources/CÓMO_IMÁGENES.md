# Almacenamiento de imágenes

El objetivo de este tutorial es ver cómo podemos almacenar imágenes subidas por los usuarios en un proyecto web.

## Requisitos

- La localización de las imágenes será configurable.
- En la base de datos se guardará la URL, el sistema operativo será el encargado de manejar los ficheros.

## Configuración

Creamos una nueva entrada en el fichero de confiuguración
```
  ...
  'img_path' => '/resources/images', <- Localización en disco de las imágenes
  'img_in_url' => '/images',         <- Si la URL comienza por esto es una imagen subida
  ...
```

También hemos modificado la base de datos para que los temas tengan un campo img, junto esta modificación hemos introducido dos imágenes en el contenido de las tablas para sacar esta información.

## Recuperando la información

Ahora tenemos dos tipos de imágenes, las que habitan en el public y son parte del diseño web y las que han subido los usuarios. Deberemos diferenciar esto antes de servir los ficheros.

Cuando un usuario sube ficheros tenemos un posible vector de ataque, es por ello que estos directorios suelen estar protegidos contra ejecución y están en un directorio diferente al resto de la aplicación. (Evitamos sobrescribir fichero sensibles)

NOTA: En producción si usamos un servidor real podremos configurar un directorio web en donde se guarden estas imágenes y nosotros nos podremos despreocupar de esta gestión.

El nuevo código del enrutador es el siguiente
```
if(startsWith($_SERVER["REQUEST_URI"], $config['img_in_url'])) {
    // Imagen subida por el usuario

    // Solo aceptamos PNG
    header('Content-Type: image/png');

    // Quitamos subir de directorio
    $file_path = str_replace("..","",$_SERVER["REQUEST_URI"]);
    // Quitamos el prefijo de la petición
    $file_path = str_replace($config['img_in_url'],"",$_SERVER["REQUEST_URI"]);
    // Cargamos el fichero y lo enviamos
    readfile($ROOT.$config['img_path'].$file_path);

} else {
    return false;    // servir la petición tal cual es.
}
```

A la hora de que el objeto nos devuelva la información tenemos que tener en cuenta el config
```
  ... en Tema.php
  public function getImg()
  {
      global $config;
      return $config['img_in_url'] . "/". $this->img;
  }
```

En los templates solo tenemos que acceder a esta propiedad
```
<td>
  <img class="small-img" src="<?=$tema->getImg()?>" alt="">
</td>
```

## Resumén de obtener información

- Tocar el router para si estamos en imagen subida obtener el fichero
  - Detectar que comienza por 'img_in_url'
  - Cargar el fichero que está en esa ruta cambiando 'img_in_url' por 'img_path'
- Añadir a mano en la base de datos las rutas a los ficheros
  - Desde 'img_path'
- Añadir el campo a la getImg al objeto que tiene la imagen
  - Tener en cuenta que hay que pegar la ruta desde la url

El mayor posible conflicto es el cambio de URL al sistema de ficheros
- router -> Detecta si estamos ante una imagen subida y carga el fichero
- base de datos -> Almacena ruta relativa al directorio de imágenes
- objetos -> Devuelven ruta web (configuración más lo almacenado)


## Siguiente

Guardar información

## Siguientes pasos

Cuando en el proyecto se almacenan muchas imágenes es posible hacer un clasificación de ficheros basadas en la fecha actual.
```
\2019\01\<nombre_usuario>\<nombre_imagen>.png
```
