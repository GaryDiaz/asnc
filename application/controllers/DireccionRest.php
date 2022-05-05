<?php

/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */

defined('BASEPATH') or exit('No direct script access allowed');

use ASNC\Libraries\RestController;
use Application\Model\Mensaje;

require_once APPPATH . "/libraries/RestController.php";
require_once APPPATH . "/libraries/Format.php";
require_once APPPATH . "/models/Mensaje.php";

/**
 * APIRest
 * es el controlador que atiende las consultas que se realizan desde el frontend
 * y devuelve las respuestas dentro de un objeto json para que sea manejada a 
 * gusto del desarrollador frontend
 *
 * @author Gary Díaz
 */
class DireccionRest extends RestController {

    public function __construct($config = 'rest') {
        parent::__construct($config);
    }

    /**
     * Lista todos de los Estados de la Base de la Datos
     * * */
    public function estados_get() {
        try {
            $this->load->model('dao/DireccionDAO');
            $datos = $this->DireccionDAO->getEstados();
            if ($datos) {
                $data = new Mensaje("Lista de Estados");
                $data->setDatos($datos, 'lista');
                $this->response($data, RestController::HTTP_OK);
            } else {
                $this->response(new Mensaje("No se encontraron estados"), RestController::HTTP_NOT_FOUND);
            }
        } catch (Exception $exc) {
            $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Encuentra el estado con el id especificado
     * @param type $id
     */
    public function estado_get($id) {
        try {
            $this->load->model('dao/DireccionDAO');
            $estado = $this->DireccionDAO->getEstado($id);
            if ($estado) {
                $data = new Mensaje("Estado con id: " . $id . ' encontrado');
                $data->setDato($estado, 'singular');
                $this->response($data, RestController::HTTP_OK);
            } else {
                $this->response(new Mensaje("No se encontró ningún estado con id: " . $id), RestController::HTTP_NOT_FOUND);
            }
        } catch (Exception $exc) {
            $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Lista los municipios del estado con el id especificado
     * @param type $idEstado
     */
    public function municipios_get($idEstado) {
        try {
            $this->load->model('dao/DireccionDAO');
            $municipios = $this->DireccionDAO->getMunicipios($idEstado);
            $estado = $this->DireccionDAO->getEstado($idEstado);
            if ($municipios) {
                $data = new Mensaje("Lista de Municipios del Estado: " . $estado->descedo);
                $data->setDatos($municipios, 'mixto', $estado);
                $this->response($data, RestController::HTTP_OK);
            } else {
                $this->response(new Mensaje("No se encontró ningún municipio del estado con id: " . $idEstado), RestController::HTTP_NOT_FOUND);
            }
        } catch (Exception $exc) {
            $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Busca el municipio con el id especificado
     * @param type $id
     */
    public function municipio_get($id) {
        try {
            $this->load->model('dao/DireccionDAO');
            $municipio = $this->DireccionDAO->getMunicipio($id);
            if ($municipio) {
                $data = new Mensaje("Municipio encontrado");
                $data->setDato($municipio, 'singular');
                $this->response($data, RestController::HTTP_OK);
            } else {
                $this->response(new Mensaje("No se encontró ningún municipio id: " . $id), RestController::HTTP_NOT_FOUND);
            }
        } catch (Exception $exc) {
            $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
        }
    }

    public function parroquias_get($idEstado) {
        try {
            $this->load->model('dao/DireccionDAO');
            $parroquias = $this->DireccionDAO->getParroquias($idEstado);
            $estado = $this->DireccionDAO->getEstado($idEstado);
            if ($parroquias) {
                $data = new Mensaje("Lista de Parroquias del Estado: " . $estado->descedo);
                $data->setDatos($parroquias, 'mixto', $estado);
                $this->response($data, RestController::HTTP_OK);
            } else {
                $this->response(new Mensaje("No se encontró ninguna parroquia del estado con id: " . $idEstado), RestController::HTTP_NOT_FOUND);
            }
        } catch (Exception $exc) {
            $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
        }
    }

    public function parroquia_get($id) {
        try {
            $this->load->model('dao/DireccionDAO');
            $parroquia = $this->DireccionDAO->getParroquia($id);
            if ($parroquia) {
                $data = new Mensaje("Parroquia encontrada");
                $data->setDato($parroquia, 'singular');
                $this->response($data, RestController::HTTP_OK);
            } else {
                $this->response(new Mensaje("No se encontró ninguna parroquia id: " . $id), RestController::HTTP_NOT_FOUND);
            }
        } catch (Exception $exc) {
            $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
        }
    }
}
