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

    public function addRiwayat($tanggal, $idUser, $idGerakan)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "INSERT INTO `riwayat`(`tanggal_waktu`, `id`, `id_gerakan`) VALUES ('$tanggal','$idUser','$idGerakan')";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $respons['status'] = 'succes';
            $respons['massage'] = "riwayat ditambahkan";
            // $respons['respons_code'] = "200";
        } catch (\Throwable $th) {
            $respons['status'] = 'fail';
            // $respons['respons_code'] = "200";
            $respons['massage'] = $th->getMessage();
        }

        return $respons;
    }
}