<?php

namespace LearnPhpMvc\controller\api;

use DateTime;
use LearnPhpMvc\Config\Database;
use LearnPhpMvc\repository\RiwayatRepository;
use LearnPhpMvc\Service\RiwayatService;

class RiwayatController{
    protected RiwayatService $service;

    public function __construct() {
        $var = new RiwayatRepository(Database::getConnection());
        $this->service = new RiwayatService($var);
    }

    public function findRiwayatGerakanByUser()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        echo json_encode($this->service->findRiwayatGerakanByUser($data));
    }
}