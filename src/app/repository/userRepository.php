<?php

namespace LearnPhpMvc\repository;

class userRepository
{
    protected \PDO $connection;


    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function FindAll(): array
    {
        $respons = array();
        $respons['body'] = array();
        $sql = "SELECT * FROM `usermma`";
        $result = $this->connection->query($sql);

        if ($result->rowCount() > 0) {
            $respons['status'] = "oke";

            $coun = 0;

            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['id'],
                    'nama' => $row['nama'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'alamat' => $row['Alamat'],
                    'akses' => $row['akses'],
                );
                $coun++;
                // var_dump($item);
                array_push($respons['body'], $item);
            }
        } else {
            echo "tidak ada";
            $respons['status'] = "fail";
        }

        return $respons;
    }

    public function findByName(string $name): array
    {
        $respons = array();
        $respons['status'] = "";
        $respons['respons_code'] = "";
        $respons['body'] = array();
        $sql = "SELECT * FROM `usermma` WHERE nama LIKE '%$name%';";
        $result = $this->connection->query($sql);

        if ($result->rowCount() > 0) {
            $respons['status'] = "oke";
            $respons['respons_code'] = 200;
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['id'],
                    'nama' => $row['nama'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'alamat' => $row['Alamat'],
                    'akses' => $row['akses']
                );
                array_push($respons['body'], $item);
            }
        } else {
            $respons['status'] = "not found";
            $respons['respons_code'] = 404;
            $respons['massage'] = "Data tidak ditemukan";
        }

        return $respons;
    }

    public function findById(int $Id): array
    {
        $respons = array();
        $respons['status'] = "";
        $respons['respons_code'] = "";
        $respons['body'] = array();
        $sql = "SELECT * FROM `usermma` WHERE id = $Id;";
        $result = $this->connection->query($sql);

        if ($result->rowCount() > 0) {
            $respons['status'] = "oke";
            $respons['respons_code'] = 200;
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['id'],
                    'nama' => $row['nama'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'alamat' => $row['Alamat'],
                    'akses' => $row['akses']
                );
                array_push($respons['body'], $item);
            }
        } else {
            $respons['status'] = "not found";
            $respons['respons_code'] = 404;
            $respons['massage'] = "Data tidak ditemukan";
        }

        return $respons;
    }

    public function findByAkses($akses): array
    {
        $respons = array();
        $respons['status'] = "";
        $respons['respons_code'] = "";
        $respons['body'] = array();
        $sql = "SELECT * FROM `usermma` WHERE akses = $akses";
        $result = $this->connection->query($sql);

        if ($result->rowCount() > 0) {
            $respons['status'] = "oke";
            $respons['respons_code'] = 200;
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['id'],
                    'nama' => $row['nama'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'alamat' => $row['Alamat'],
                    'akses' => $row['akses']
                );
                array_push($respons['body'], $item);
            }
        } else {
            $respons['status'] = "not found";
            $respons['respons_code'] = 404;
            $respons['massage'] = "Data tidak ditemukan";
        }

        return $respons;
    }

    public function addData($nama, $email, $password, $alamat, $akases)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "INSERT INTO `usermma` (`id`, `nama`, `password`, `email`, `Alamat`, `akses`)
                                VALUES (
                                    NULL, 
                                    '$nama', 
                                    '$password', 
                                    '$email', 
                                    '$alamat', 
                                    '$akases')";
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

    public function EditData($id,$nama, $email, $password, $alamat, $akases)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "UPDATE `usermma` 
                    SET 
                    `nama` = '$nama', 
                    `password` = '$password', 
                    `email` = '$email', 
                    `Alamat` = '$alamat',
                    `akses` = '$akases' 
                    WHERE `usermma`.`id` = $id";
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
            $sql = "DELETE FROM `usermma` WHERE id = $id";
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
