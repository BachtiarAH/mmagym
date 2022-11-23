<?php

namespace LearnPhpMvc\Service;

use LearnPhpMvc\repository\GerakanRepository;

class GerakanService extends Service{
    protected GerakanRepository $repo;

    public function __construct(GerakanRepository $repo) {
        $this->repo = $repo;
    }

    public function addData($file,$data)
    {
        if (isset($data['nama']) &&isset($file['video-gerakan'])&&isset($file['foto-gerakan'])&&isset($data['id_alat'])) {
            $nama = $data['nama'];
            $id_alat = $data['id_alat'];
            $idVideo = $this->googleDriveUpload($file,'video-gerakan','1KHsVlh1AwMGgpRdCi6W9wTzg52YhQVzW');
            $idfoto = $this->googleDriveUpload($file,'foto-gerakan','1JmaM2LER4bo1fQM3o226RS-yPI93NOuq');
            return $this->repo->addData($nama, $idVideo, $idfoto, $id_alat);
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