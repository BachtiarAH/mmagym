<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\repository\GerakanRepository;
use LearnPhpMvc\Service\GerakanService;

class GerakanController{
    protected GerakanService $service;

    public function __construct() {
        $repo = new GerakanRepository(Database::getConnection());
        $this->service = new GerakanService($repo);
    }

    public function addData()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        echo json_encode($this->service->addData($data));
    }

    public function findAll()
    {
        echo json_encode($this->service->findAll());
    }

    public function findById()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        echo json_encode($this->service->findById($data));
    }

    public function findByName()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        echo json_encode($this->service->findByName($data));
    }

    public function findByAlat()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        echo json_encode($this->service->findByAlat($data));
    }

    public function editData()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        echo json_encode($this->service->editData($data));
    }

    public function deleteData()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        echo json_encode($this->service->deleteData($data));
    }
}