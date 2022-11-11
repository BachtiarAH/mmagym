<?php

namespace LearnPhpMvc\Service;

use LearnPhpMvc\repository\JadwalRepositry;

class JadwalService extends Service{
    protected JadwalRepositry $repo;

    public function __construct(JadwalRepositry $repo) {
        $this->repo = $repo;
    }

    public function findByUser($data)
    {
        if (isset($data->id_user)) {
            return $this->repo->findByUser($data->id_user);
        }else{
            return $this->FailResponse('format');
        }
    }
}