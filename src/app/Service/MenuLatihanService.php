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
}