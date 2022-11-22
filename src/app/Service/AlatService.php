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

    public function addData($postFile,$postVariabel)
    {
        if (isset($postFile['foto-alat'])&&isset($postVariabel['nama'])) {
            $idfoto = $this->googleDriveUpload($postFile,'foto-alat','1lPJlSqxBpdjDW3dYdr0PtRs-kPzt51K6');
            return $this->repo->addData($postVariabel['nama'],$idfoto);
        } else {
            return $this->FailResponse("format");
        }
    }

    public function editData($postFile,$postVariabel)
    {
        if (isset($postVariabel['nama'])&&isset($postFile['foto-alat'])) {
            $id = $postVariabel['id'];
            $nama = $postVariabel['nama'];
            $resultAlatRepo = $this->repo->findById($id);
            $idGambar = $resultAlatRepo['body'][0]['gambar'];
            $gambar = $this->googleDriveReplaceFile($idGambar,'foto-alat',$postFile,'1lPJlSqxBpdjDW3dYdr0PtRs-kPzt51K6');
            return $this->repo->editData($id,$nama,$gambar);
        } else {
            return $this->FailResponse("format");
        }
    }

    public function edtNameData($data)
    {
        if (isset($data->nama)&&isset($data->id)) {
            return $this->repo->editNameData($data->id,$data->nama,);
        } else {
            return $this->FailResponse("format");
        }
        
    }
    
    public function deleteData($data)
    {
        if (isset($data->id)) {
            $repoResult = $this->repo->findById($data->id);
            $gambar = $repoResult['body'][0]['gambar'];
            $this->googleDriveDelete($gambar);
            return $this->repo->deletData($data->id);
        } else {
            return $this->FailResponse("format");
        }
    }

}
