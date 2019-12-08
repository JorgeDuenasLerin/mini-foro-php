<?php


/*

Clase que representa un tema
\- Es independiente de la base de datos

*/
class Tema {
  private $id;
  private $titulo;
  private $nombre;
  private $etiqueta;
  private $creado;
  private $img;

  function __construct($id, $titulo, $nombre, $etiqueta, $creado, $img){
    $this -> id = $id;
    $this -> titulo = $titulo;
    $this -> nombre = $nombre;
    $this -> etiqueta = $etiqueta;
    $this -> creado = $creado;
    $this -> img = $img;
  }


    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Titulo
     *
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of Titulo
     *
     * @param mixed $titulo
     *
     * @return self
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of Nombre
     *
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of Nombre
     *
     * @param mixed $nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of Etiqueta
     *
     * @return mixed
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set the value of Etiqueta
     *
     * @param mixed $etiqueta
     *
     * @return self
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get the value of Creado
     *
     * @return mixed
     */
    public function getCreado()
    {
        return $this->creado;
    }

    /**
     * Set the value of Creado
     *
     * @param mixed $creado
     *
     * @return self
     */
    public function setCreado($creado)
    {
        $this->creado = $creado;

        return $this;
    }



    /**
     * Get the value of Img
     *
     * @return mixed
     */
    public function getImg()
    {
        global $config;
        return $config['img_in_url'] . "/". $this->img;
    }

    /**
     * Set the value of Img
     *
     * @param mixed $img
     *
     * @return self
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

}
