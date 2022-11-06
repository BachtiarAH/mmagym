<?php

namespace LearnPhpMvc\config;


    function getDbConfig():array{
        return [
            "database" =>[
                "test" =>[
                    "url" => "mysql:host=localhost:3306;dbname=mma_gym_tes",
                    "username"=>"root",
                    "password"=>""
                ],
                "prod"=>[
                    "url" => "mysql:host=localhost:3306;dbname=mma_gym",
                    "username"=>"root",
                    "password"=>""
                ]
            ]
        ];
    }   
