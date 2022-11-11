<?php

namespace LearnPhpMvc\repository;

use PDOException;

class RiwayatRepository{
    protected \PDO $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function findRiwayatGerakanByUser($id_user)
    {
        $respons = array();
        try {
            
            $respons['status'] = '';
            $respons['body'] = array();
            $sql = "SELECT gerakan.nama_gerakan, riwayat.tanggal_waktu FROM `riwayat`
            JOIN gerakan ON gerakan.id_gerakan = riwayat.id_gerakan
            WHERE riwayat.id = $id_user";
            $result = $this->connection->query($sql);

            if ($result->rowCount() > 0) {
                $respons['status'] = "oke";
                while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                    $item = array(
                        
                        'tanggal' => $row['tanggal_waktu'],
                        'gerakan' => $row['nama_gerakan'],
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