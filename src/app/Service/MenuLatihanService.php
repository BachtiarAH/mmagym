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

    public function findById($get)
    {
        if (isset($get['id'])) {
            return $this->repo->findById($get['id']);
        } else {
            return $this->FailResponse('format');
        }
        
    }

    public function addRincian($post)
    {
        if (isset($post->repetisi) && isset($post->set) && isset($post->note) && isset($post->id_gerakan) && isset($post->id_menu_latihan)) {
            return $this->repo->addRincian($post->repetisi, $post->set, $post->note, $post->id_gerakan, $post->id_menu_latihan);
        } else {
            return $this->FailResponse('format');
        }
        
    }

    public function deleteDataRincian($data)
    {
        if (isset($data->id)) {
            return $this->repo->deleteDataRincian($data->id);
        } else {
            return $this->FailResponse('format');
        }
        
    }

    public function EditDataRincian($data)
    {
        if (isset($data->id) && isset($data->repetisi) && isset($data->note) && isset($data->set) && isset($data->id_gerakan) ) {
            return $this->repo->UpdateRincian($data->id,$data->note,$data->set,$data->repetisi,$data->id_gerakan);
        } else {
            return $this->FailResponse('format');
        }
        
    }
}