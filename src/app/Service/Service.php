<?php

namespace LearnPhpMvc\Service;

class Service{

    public function FailResponse(string $type) :array
    {
        $respons = array();
        
        if ($type == "format") {
            $respons ['status'] = "fail";
            $respons['message'] = "format json salah";
        }

        return $respons;
    }

}

?>