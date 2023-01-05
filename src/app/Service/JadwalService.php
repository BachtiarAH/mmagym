<?php

namespace LearnPhpMvc\Service;

use LearnPhpMvc\repository\JadwalRepositry;
use PHPUnit\Framework\Constraint\IsEqual;

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

    public function addData($data)
    {
        if (isset($data->hari) && isset($data->idUser) && isset($data->idMenu) ) {
            $hari = $data->hari;
            if ($hari == "minggu" || $hari == "senin" || $hari == "selasa" || $hari == "rabu" || $hari == "kamis" || $hari == "jumat" || $hari == "sabtu") {
                return $this->repo->addData($hari,$data->idUser,$data->idMenu);
            }else {
                return ["status"=> "fail","Message"=>"penulisan hari salah"];
            }
        } else {
            return $this->FailResponse("format");
        }
        
    }        
    
    public function getJadwalByIdUser(array $get)
    {
        $respon = ["status"=>"","message"=>"","jadwal"=>[]];
        if ( !empty($get["id"])) {
            $id = $get["id"];
            $jadwal = [
                "minggu"=>null,
                "senin"=>null,
                "selasa"=>null,
                "rabu"=>null,
                "kamis"=>null,
                "jumat"=>null,
                "sabtu"=>null,
            ];

            $repoResult = $this->repo->findByUser($id);
            // var_dump($repoResult);
            for ($i=0; $i < count($repoResult["body"]) ; $i++) {
                $hari = $repoResult["body"][$i]["hari"];
                $menuLatihan = $repoResult["body"][$i]["menu_Latihan"];
                if ($hari == "minggu") {
                    $jadwal["minggu"] = $menuLatihan;
                }

                if ($hari == "senin") {
                    $jadwal["senin"] = $menuLatihan;
                }

                if ($hari == "selasa") {
                    $jadwal["selasa"] = $menuLatihan;
                }

                if ($hari == "rabu") {
                    $jadwal["rabu"] = $menuLatihan;
                }

                if ($hari == "kamis") {
                    $jadwal["kamis"] = $menuLatihan;
                }

                if ($hari == "jumat") {
                    $jadwal["jumat"] = $menuLatihan;
                }

                if ($hari == "sabtu") {
                    $jadwal["sabtu"] = $menuLatihan;
                }
            }

            $respon["status"] = "succes";
            $respon["jadwal"] = $jadwal;
            return $respon;

        } else {
            $respon["status"] = "fail";
            $respon["message"] = "format salah";
            return $respon;
        }
        
    }
}