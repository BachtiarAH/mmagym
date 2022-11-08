<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\repository\userRepository;
use LearnPhpMvc\Service\userService;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class UserController
{
    public userService $service;

    /**
     * @param userService $service
     */
    public function __construct()
    {
        $repo = new userRepository(Database::getConnection());
        $this->service = new userService($repo);
    }

    function findAll(){
        $arr = $this->service->FindAll();
        echo json_encode($arr);
    }

    public function findByName()
    {
        $json = file_get_contents('php://input');
        $arr = json_decode($json);
        echo json_encode($this->service->findByName($arr));
    }

    public function findByid()
    {
        $json = file_get_contents('php://input');
        $arr = json_decode($json);
        echo json_encode($this->service->findById($arr));
    }

    public function findByAkases()
    {
        $json = file_get_contents('php://input');
        $data = array();
        // mengubah json ke array
        $arr = json_decode($json);
        if (isset($arr->akses)) {
            $data = $this->service->findByAkses((int)$arr->akses);
        } else {
            $data = $this->service->FailResponse("format");
        }
        $data = json_encode($data);
        echo $data;
    }

    public function addData()
    {
        $json = file_get_contents('php://input');
        $data = array();
        $arr = json_decode($json);
        if (isset($arr->nama)&&isset($arr->password)&&isset($arr->email)&&isset($arr->alamat)&&isset($arr->akses)) {
            $nama = $arr->nama;
            $email = $arr->email;
            $password = $arr->password;
            $alamat = $arr->alamat;
            $akses = $arr->akses;
            $data = $this->service->addData($nama, $email, $password, $alamat, $akses);
        }else {
            $data = $this->service->FailResponse("format");
        }

        echo json_encode($data);
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