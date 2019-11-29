<?php


/*

Clase que gestiona la base de datos en relación a los temas

*/
class TemaManager implements IDWESEntidadManager{

    public static function getAll(){
        $db = DWESBaseDatos::obtenerInstancia();

        $db -> ejecuta("SELECT t.id, t.titulo, t.nombre, t.etiqueta, t.creado
                            FROM Tema t");

        return array_map(function($fila){
          return new Tema($fila['id'], $fila['titulo'], $fila['nombre'], $fila['etiqueta'], $fila['creado']);
        }, $db -> obtenDatos());
    }

    public static function getById($id){
        $db = DWESBaseDatos::obtenerInstancia();

        $db -> ejecuta("SELECT t.id, t.titulo, t.nombre, t.etiqueta, t.creado
                            FROM Tema t WHERE id = ?");

        if($db -> executed ){ // Se pudo ejecutar
            $datos = $db -> obtenDatos($id);
            if(count($datos)>0) { // Hay datos
                $file = $datos[0];
                return new Tema($fila['id'], $fila['titulo'], $fila['nombre'], $fila['etiqueta'], $fila['creado']);
            }
        }
        return null;
    }

    public static function insert(...$campos){
        // Sin implementar
    }

    public static function update($id, ...$campos){
        // Sin implementar
    }

    public static function delete($id){
        // Sin implementar
    }

    public static function obtenerTemasConCountRespuestas(){
        $db = DWESBaseDatos::obtenerInstancia();

        $db -> ejecuta("SELECT t.id, t.titulo, t.nombre, t.etiqueta, t.creado, COUNT(*) as respuestas
                            FROM Tema t
                            LEFT JOIN Respuesta r ON (t.id = r.id_tema)
                            GROUP BY t.id, t.titulo, t.nombre, t.etiqueta, t.creado
                            ");

        return array_map(function($fila){
          return [
                    new Tema($fila['id'], $fila['titulo'], $fila['nombre'], $fila['etiqueta'], $fila['creado']),
                    $fila['respuestas']
                ];
        }, $db -> obtenDatos());
    }


}
