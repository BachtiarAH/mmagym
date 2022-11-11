<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\repository\JadwalRepositry;
use LearnPhpMvc\Service\JadwalService;

class JadwalController{
    protected JadwalService $service;

    public function __construct() {
        $repo = new JadwalRepositry(Database::getConnection());
        $this->service = new JadwalService($repo);
    }

    public function findByUser()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        echo json_encode($this->service->findByUser($data));
    }
}