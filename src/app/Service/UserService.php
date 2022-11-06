<?php

namespace LearnPhpMvc\Service;
// require_once __DIR__."/../../../../vendor/autoload.php";


use LearnPhpMvc\Config\Database;
use LearnPhpMvc\repository\userRepository;



class userService{
    protected userRepository $repo;

    public function __construct(userRepository $repo)
    {
        $this->repo = $repo;
    }

    public function FindAll() : array
    {
        return $this->repo->FindAll();
    }


}

?>