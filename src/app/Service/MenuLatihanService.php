<?php

namespace LearnPhpMvc\Service;

use LearnPhpMvc\repository\MenuLatihanRepository;

class MenuLatihanService extends Service{
    protected MenuLatihanRepository $repo;

    public function __construct(MenuLatihanRepository $repo) {
        $this->repo = $repo;
    }

    public function findAll()
    {
        return $this->repo->findAll();
    }

    public function findRincianMenuLatihan($data)
    {
        if (isset($data->id_menu)) {
            return $this->repo->findRincianMenuLatihan($data->id_menu);
        } else {
            return $this->FailResponse('format');
        }
        
    }

    public function addData($post, $file)
    {
        if (isset($post['nama']) && isset($post['part']) && isset($post['level']) && isset($file['foto-menu'])) {
            $idFoto = $this->googleDriveUpload($file,'foto-menu','1cPTSAED5B2OVkXa1bf0Pug1XrMaEha1g');
            return $this->repo->addData($post['nama'],$post['part'],$post['level'],$idFoto);
        } else {
            return $this->FailResponse('format');
        }
        
    }
}