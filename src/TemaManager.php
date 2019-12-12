<?php


/*

Clase que gestiona la base de datos en relación a los temas

*/
class TemaManager implements IDWESEntidadManager{

    public static function getAll(){
        $db = DWESBaseDatos::obtenerInstancia();

        $db -> ejecuta("SELECT t.id, t.titulo, t.nombre, t.etiqueta, t.creado, t.img
                            FROM Tema t");

        return array_map(function($fila){
          return new Tema($fila['id'], $fila['titulo'], $fila['nombre'], $fila['etiqueta'], $fila['creado'], $fila['img']);
        }, $db -> obtenDatos());
    }

    public static function getById($id){
        $db = DWESBaseDatos::obtenerInstancia();

        $db -> ejecuta("SELECT t.id, t.titulo, t.nombre, t.etiqueta, t.creado, t.img
                            FROM Tema t WHERE id = ?", $id);

        if($db -> executed ){ // Se pudo ejecutar
            $datos = $db -> obtenDatos();
            if(count($datos)>0) { // Hay datos
                $file = $datos[0];
                return new Tema($fila['id'], $fila['titulo'], $fila['nombre'], $fila['etiqueta'], $fila['creado'], $fila['img']);
            }
        }
        return null;
    }

    public static function insert(...$campos){
        if(count($campos) == 4){ // Este 5 debe de ser una constante
            $titulo = $campos[0];
            $nombre = $campos[1];
            $etiqueta = $campos[2];
            $img = $campos[3];

            $db = DWESBaseDatos::obtenerInstancia();
            $db -> ejecuta("INSERT INTO Tema (titulo, nombre, etiqueta, img) VALUES (?, ?, ?, ?)", $titulo, $nombre, $etiqueta, $img);
            if ($db -> getExecuted() ){
                return $db -> getLastId();
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public static function update($id, ...$campos){
        // Sin implementar
    }

    public static function delete($id){
        $db = DWESBaseDatos::obtenerInstancia();
        $db -> ejecuta("DELETE FROM Tema WHERE ?");
    }

    public static function obtenerTemasConCountRespuestas(){
        $db = DWESBaseDatos::obtenerInstancia();

        $db -> ejecuta("SELECT t.id, t.titulo, t.nombre, t.etiqueta, t.creado, t.img, COUNT(*) as respuestas
                            FROM Tema t
                            LEFT JOIN Respuesta r ON (t.id = r.id_tema)
                            GROUP BY t.id, t.titulo, t.nombre, t.etiqueta, t.creado
                            ");

        return array_map(function($fila){
          return [
                    new Tema($fila['id'], $fila['titulo'], $fila['nombre'], $fila['etiqueta'], $fila['creado'], $fila['img']),
                    $fila['respuestas']
                ];
        }, $db -> obtenDatos());
    }


}
