<?php

namespace LearnPhpMvc\Service;
// require_once __DIR__."/../../../../vendor/autoload.php";


use LearnPhpMvc\Config\Database;
use LearnPhpMvc\repository\userRepository;



class userService extends Service{
    protected userRepository $repo;

    public function __construct(userRepository $repo)
    {
        $this->repo = $repo;
    }

    public function FindAll() : array
    {
        return $this->repo->FindAll();
    }

    public function findByName($data)
    {
        if (isset($data->name)) {
            return $this->repo->findByName($data->name);
        } else {
            return $this->FailResponse("format");
        }
        
    }

    public function findById($data)
    {
        if (isset($data->id)) {
            return $this->repo->findById($data->id);
        } else {
            return $this->FailResponse("format");
        }
    }

    public function findByAkses($akses)
    {
        return $this->repo->findByAkses($akses);
    }

    public function addData($nama, $email, $password, $alamat, $akases)
    {
        return $this->repo->addData($nama, $email, $password, $alamat, $akases);
    }

    public function editData($data)
    {
        if (isset($data->id)&&isset($data->nama)&&isset($data->password)&&isset($data->email)&&isset($data->alamat)&&isset($data->akses)) {
            $id = $data->id;
            $nama = $data->nama;
            $password = $data->password;
            $email = $data->email;
            $alamat = $data->alamat;
            $akses = $data->akses;
            return $this->repo->EditData($id,$nama,$email,$password,$alamat,$akses);
        } else {
            return $this->FailResponse("format");
        }
    }

    public function deleteData($data)
    {
        if (isset($data->id)) {
            return $this->repo->deleteData($data->id);
        } else {
            return $this->FailResponse("format");
        }
    }

}

?>