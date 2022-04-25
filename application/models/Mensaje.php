<?php
namespace Application\Model;

/**
 * Mensaje
 * 
 * Es una clase que permite crear un objeto complejo que contiene, mensajes,
 * objetos simples y arrays para que sean enviado al front-end para su posterior
 * interpretación
 *
 * @author Gary Diaz <garyking1982@gmail.com>
 */
class Mensaje {
    
    /**
     *
     * @var bool 
     */
    public $ok;

    /**
     *
     * @var string 
     */
    public $titulo;

    /**
     *
     * @var string 
     */
    public $descripcion;

    /**
     *
     * @var string 
     */
    public $tipoRespuesta;

    public $dato;

    /**
     *
     * @var array 
     */
    public $datos;

    public function __construct(string $descripcion, string $titulo = "ASNC", bool $ok = false) {
        $this->ok = $ok;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
    }

    public function isOk(): bool {
        return $this->ok;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function getTipoRespuesta(): string {
        return $this->tipoRespuesta;
    }

    public function getDato(): type {
        return $this->dato;
    }

    public function getDatos(): array {
        return $this->datos;
    }

    public function setOk(bool $ok) {
        $this->ok = $ok;
    }

    public function setTitulo(string $titulo) {
        $this->titulo = $titulo;
    }

    public function setDescripcion(string $descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setTipoRespuesta(string $tipoRespuesta) {
        $this->tipoRespuesta = $tipoRespuesta;
    }

    public function setDato($dato, $tipoRespuesta=' ') {
        $this->dato = $dato;
        $this->ok=true;
        if($tipoRespuesta){
            $this->tipoRespuesta=$tipoRespuesta;
        }
    }

    /**
     * 
     * @param array $datos
     * @param $dato
     */
    public function setDatos(array $datos, $tipoRespuesta=" ", $dato=null) {
        $this->datos = $datos;
        $this->ok=true;
        if ($dato){
            $this->dato=$dato;
        }
        if($tipoRespuesta){
            $this->tipoRespuesta=$tipoRespuesta;
        }
    }
    
    /**
     * 
     * @param string $descripcion
     * @param string $titulo
     * @param $tipoRespuesta
     */
    public function setMensaje(string $descripcion, string $titulo="ASNC", $tipoRespuesta=null) {
        $this->descripcion = $descripcion;
        $this->titulo = $titulo;
        $this->tipoRespuesta = $tipoRespuesta;
    }
}
