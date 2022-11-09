<?php

namespace LearnPhpMvc\Service;

use LearnPhpMvc\repository\AlatRepository;
use LearnPhpMvc\repository\userRepository;

class AlatService extends Service
{
    protected AlatRepository $repo;

    public function __construct(AlatRepository $repo)
    {
        $this->repo = $repo;
    }

    public function findAll(): array
    {
        return $this->repo->FindAll();
    }

    public function findByName(string $name)
    {
        return $this->repo->findByName($name);
    }

    public function addData($data)
    {
        if (isset($data->nama)&&isset($data->gambar)) {
            return $this->repo->addData($data->nama,$data->gambar);
        } else {
            return $this->FailResponse("format");
        }
    }

    public function editData($data)
    {
        if (isset($data->nama)&&isset($data->gambar)&&isset($data->id)) {
            return $this->repo->editData($data->id,$data->nama,$data->gambar);
        } else {
            return $this->FailResponse("format");
        }
    }
    
    public function deleteData($data)
    {
        if (isset($data->id)) {
            return $this->repo->deletData($data->id);
        } else {
            return $this->FailResponse("format");
        }
    }

}
