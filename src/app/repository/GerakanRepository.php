<?php

namespace LearnPhpMvc\repository;

class GerakanRepository
{
    protected \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function findAll()
    {
        $respons = array();
        $respons['status'] = '';
        $respons['body'] = array();
        $sql = "SELECT `id_gerakan`, `nama_gerakan`, `video`, gerakan.gambar, alat.nama_alat FROM `gerakan` 
        JOIN alat ON alat.id_alat = gerakan.id_alat
        WHERE 1";
        $result = $this->connection->query($sql);

        if ($result->rowCount() > 0) {
            $respons['status'] = "oke";
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['id_gerakan'],
                    'gerakan' => $row['nama_gerakan'],
                    'video' => $row['video'],
                    'gambar' => $row['gambar'],
                    'alat' => $row['nama_alat'],
                );
                array_push($respons['body'], $item);
            }
        } else {
            echo "tidak ada";
            $respons['status'] = "fail";
        }

        return $respons;
    }

    public function addData($nama, $video, $gambar, $id_alat)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "INSERT INTO `gerakan`(`id_gerakan`, `nama_gerakan`, `video`, `gambar`, `id_alat`)
                         VALUES 
                         (NULL,
                         '$nama',
                         '$video',
                         '$gambar',
                         '$id_alat')";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $respons['status'] = 'succes';
            // $respons['respons_code'] = "200";
        } catch (\Throwable $th) {
            $respons['status'] = 'fail';
            // $respons['respons_code'] = "200";
            $respons['massage'] = $th->getMessage();
        }

        return $respons;
    }

    public function findById($id)
    {
        $respons = array();
        $respons['status'] = '';
        $respons['body'] = array();
        $sql = "SELECT * FROM `gerakan` WHERE gerakan.id_gerakan = $id";
        $result = $this->connection->query($sql);

        if ($result->rowCount() > 0) {
            $respons['status'] = "oke";
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['id_gerakan'],
                    'nama' => $row['nama_gerakan'],
                    'video' => $row['video'],
                    'gambar' => $row['gambar'],
                    'id_alat' => $row['id_alat'],
                );
                array_push($respons['body'], $item);
            }
        } else {
            $respons['status'] = "fail";
            $respons['massage'] = 'not found';
        }

        return $respons;
    }

    public function findByName($name)
    {
        $respons = array();
        $respons['status'] = '';
        $respons['body'] = array();
        $sql = "SELECT * FROM `gerakan` WHERE gerakan.nama_gerakan LIKE '%$name%'";
        $result = $this->connection->query($sql);

        if ($result->rowCount() > 0) {
            $respons['status'] = "oke";
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['id_gerakan'],
                    'nama' => $row['nama_gerakan'],
                    'video' => $row['video'],
                    'gambar' => $row['gambar'],
                    'id_alat' => $row['id_alat'],
                );
                array_push($respons['body'], $item);
            }
        } else {
            $respons['status'] = "fail";
            $respons['massage'] = 'not found';
        }

        return $respons;
    }

    public function findByAlat($id_alat)
    {
        $respons = array();
        $respons['status'] = '';
        $respons['body'] = array();
        $sql = "SELECT * FROM `gerakan` WHERE id_alat = $id_alat";
        $result = $this->connection->query($sql);

        if ($result->rowCount() > 0) {
            $respons['status'] = "oke";
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['id_gerakan'],
                    'nama' => $row['nama_gerakan'],
                    'video' => $row['video'],
                    'gambar' => $row['gambar'],
                    'id_alat' => $row['id_alat'],
                );
                array_push($respons['body'], $item);
            }
        } else {
            $respons['status'] = "fail";
            $respons['massage'] = 'not found';
        }

        return $respons;
    }

    public function editData($id, $nama, $video, $gambar, $id_alat)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "UPDATE `gerakan` SET 
                        `nama_gerakan`='$nama',
                        `video`='$video',
                        `gambar`='$gambar',
                        `id_alat`='$id_alat' WHERE id_gerakan = $id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $respons['status'] = 'succes';
            // $respons['respons_code'] = "200";
        } catch (\Throwable $th) {
            $respons['status'] = 'fail';
            // $respons['respons_code'] = "200";
            $respons['massage'] = $th->getMessage();
        }

        return $respons;
    }

    public function deleteData($id)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "DELETE FROM `gerakan` WHERE id_gerakan = $id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $respons['status'] = 'succes';
            // $respons['respons_code'] = "200";
        } catch (\Throwable $th) {
            $respons['status'] = 'fail';
            // $respons['respons_code'] = "200";
            $respons['massage'] = $th->getMessage();
        }

        return $respons;
    }
}
