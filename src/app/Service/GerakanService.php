<?php

namespace LearnPhpMvc\Service;

use LearnPhpMvc\repository\GerakanRepository;

class GerakanService extends Service{
    protected GerakanRepository $repo;

    public function __construct(GerakanRepository $repo) {
        $this->repo = $repo;
    }

    public function addData($data)
    {
        if (isset($data->nama) &&isset($data->video)&&isset($data->gambar)&&isset($data->id_alat)) {
            return $this->repo->addData($data->nama,$data->video,$data->gambar,$data->id_alat);
        }else{
            return $this->FailResponse("format");
        }
    }

    public function findAll()
    {
        return $this->repo->findAll();
    }

    public function findById($data)
    {
        if (isset($data->id)) {
            return $this->repo->findById($data->id);
        } else {
            return $this->FailResponse("format");
        }
        
    }

    public function findByName($data)
    {
        if (isset($data->nama)) {
            return $this->repo->findByName($data->nama);
        } else {
            return $this->FailResponse("format");
        }
    }

    public function findByAlat($data)
    {
        if (isset($data->id_alat)) {
            return $this->repo->findByAlat($data->id_alat);
        } else {
            return $this->FailResponse('format');
        }
        
    }

    public function editData($data)
    {
        if (isset($data->nama) &&isset($data->video)&&isset($data->gambar)&&isset($data->id_alat)&&isset($data->id)) {
            return $this->repo->editData($data->id,$data->nama,$data->video,$data->gambar,$data->id_alat);
        } else {
            return $this->FailResponse('format');
        }
        
    }

    public function deleteData($data)
    {
        if (isset($data->id)) {
            return $this->repo->deleteData($data->id);
        }else{
            return $this->FailResponse('format');
        }
    }
}