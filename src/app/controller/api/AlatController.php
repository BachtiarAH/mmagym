<?php

namespace LearnPhpMvc\controller\api;

use Exception;
use Google\Client;
use Google\Service;
use Google\Service\Drive as ServiceDrive;
use Google\Service\Drive\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\DriveActivity\Drive as DriveActivityDrive;
use Google_Client;
use Google_Service;
use LearnPhpMvc\Config\Database;
use LearnPhpMvc\config\GoogleClient;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\repository\AlatRepository;
// use LearnPhpMvc\repository\userRepository;
use LearnPhpMvc\Service\AlatService;
// use LearnPhpMvc\Service\userService;

class AlatController
{
    public AlatService $service;

    public function __construct()
    {
        $repo = new AlatRepository(Database::getConnection());
        $this->service = new AlatService($repo);
    }

    public function findAll()
    {
        $arr = $this->service->findAll();
        echo json_encode($arr);
    }

    public function findByName()
    {
        $json = file_get_contents('php://input');
        $data = array();
        // mengubah json ke array
        $arr = json_decode($json);
        if (isset($arr->name)) {
            $data = $this->service->findByName($arr->name);
        } else {
            $data = $this->service->FailResponse("format");
        }
        $data = json_encode($data);
        echo $data;
    }

    public function tesFile()
    {
        $body = file_get_contents('php://input');
        var_dump($body);
        var_dump($_FILES);
    }

    public function addData()
    {
        // $json = file_get_contents('php://input');
        // $filepath = $_FILES['gambar-alat'];
        // var_dump($filepath);
        // $data = json_decode($json);
        echo json_encode($this->service->addData($_FILES,$_POST));
    }

    public function editData()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        echo json_encode($this->service->editData($data));
    }

    public function editNameData()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        echo json_encode($this->service->edtNameData($data));
    }

    public function deleteData()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        echo json_encode($this->service->deleteData($data));
    }
}
