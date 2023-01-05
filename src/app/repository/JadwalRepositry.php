<?php

namespace LearnPhpMvc\repository;

use PDOException;

class JadwalRepositry{
    protected \PDO $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function findByUser($idUser)
    {
        $respons = array();
        try {
            
            $respons['status'] = '';
            $respons['body'] = array();
            $sql = "SELECT jadwal_latihan.hari, usermma.nama, menu_latihan.nama_menu_latihan FROM `jadwal_latihan`
            JOIN menu_latihan on jadwal_latihan.id_menu_latihan = menu_latihan.id_menu_latihan
            JOIN usermma ON usermma.id = jadwal_latihan.id_user
            WHERE jadwal_latihan.id_user = $idUser";
            $result = $this->connection->query($sql);

            if ($result->rowCount() > 0) {
                $respons['status'] = "oke";
                while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                    $item = array(
                        'hari' => $row['hari'],
                        'nama' => $row['nama'],
                        'menu_Latihan' => $row['nama_menu_latihan'],
                    );
                    array_push($respons['body'], $item);
                }
            } else {
                $respons['status'] = "fail";
                $respons['massage'] = "data tidak ada";
            }
        } catch (PDOException $th) {
            $respons['status'] = 'fail';
            $respons['message'] = $th->getMessage();
        }

        return $respons;
    }

    public function addData($hari,$idUser,$idMenuLatihan)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "INSERT INTO `jadwal_latihan`( `hari`, `id_user`, `id_menu_latihan`) 
            VALUES (
                '$hari',
                '$idUser',
                '$idMenuLatihan')";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $respons['status'] = 'succes';
            $respons['massage'] = 'success';
            // $respons['respons_code'] = "200";
        } catch (\Throwable $th) {
            $respons['status'] = 'fail';
            // $respons['respons_code'] = "200";
            $respons['massage'] = $th->getMessage();
        }

        return $respons;
    }
}