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
            $sql = "SELECT * FROM `jadwal_latihan` WHERE jadwal_latihan.id_user = $idUser";
            $result = $this->connection->query($sql);

            if ($result->rowCount() > 0) {
                $respons['status'] = "oke";
                while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                    $item = array(
                        
                        'id' => $row['id_jadwal'],
                        'hari' => $row['hari'],
                        'id_user' => $row['id_user'],
                        'id_menu_Latihan' => $row['id_menu_latihan'],
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
}