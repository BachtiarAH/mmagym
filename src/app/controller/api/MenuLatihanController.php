<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\repository\MenuLatihanRepository;
use LearnPhpMvc\Service\MenuLatihanService;

class MenuLatihanController{
    protected MenuLatihanService $service;

    public function __construct() {
        $repo = new MenuLatihanRepository(Database::getConnection());
        $this->service = new MenuLatihanService($repo);
    }

    public function findAll()
    {
        echo json_encode($this->service->findAll());
    }

    public function findRincianMenuLatihan()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        echo json_encode($this->service->findRincianMenuLatihan($data));
    }
    
    public function findById()
    {
        echo json_encode($this->service->findById($_GET));
    }
    
    public function addData()
    {
        echo json_encode($this->service->addData($_POST,$_FILES));
    }

    public function addRician()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        echo json_encode($this->service->addRincian($request));
    }
    
    public function deleteDataRincian()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        echo json_encode($this->service->deleteDataRincian($request));
    }

    public function updateDataRincian()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        echo json_encode($this->service->EditDataRincian($request));
    }
}