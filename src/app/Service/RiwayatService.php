<?php

namespace LearnPhpMvc\Service;

use LearnPhpMvc\repository\RiwayatRepository;

class RiwayatService extends Service{
    protected RiwayatRepository $repo;

    public function __construct($repo) {
        $this->repo = $repo;
    }

    public function findRiwayatGerakanByUser($data)
    {
        if (isset($data->id_user)) {
            return $this->repo->findRiwayatGerakanByUser($data->id_user);
        } else {
            return $this->FailResponse('format');
        }
        
    }
}