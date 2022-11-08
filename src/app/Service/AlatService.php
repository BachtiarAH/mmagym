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


}
