<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class APIController extends ResourceController
{
    protected $modelName = 'App\Models\Modeloanimales';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function insertar()
    {
        //1. Recibir los datos desde el cliente
        $nombre=$this->request->getPost("nombre");
		$edad=$this->request->getPost("edad");
		$tipoanimal=$this->request->getPost("tipoanimal");
		$descripcion=$this->request->getPost("descripcion");
		$comida=$this->request->getPost("comida");
        $foto=$this->request->getPost("foto");
        
        //2. organizar los datos que llegan de las vstas
        $datosEnvio=array(
			"nombre"=>$nombre,
			"edad"=>$edad,
			"tipoanimal"=>$tipoanimal,
			"descripcion"=>$descripcion,
			"comida"=>$comida,
			"foto"=>$foto
        );

        //3. Utilizar el atributo this->validate del controlador para validar datos

        if ($this->validate('animalesPOST')) {

            $this->model->insert($datosEnvio);
            return $this->respond($this->model->find($id));

        } else {
            $validation = \Config\Services::validation();

            return $this->respond($validation->getErrors());

        }
        
        


        //


    }

    // ...
}