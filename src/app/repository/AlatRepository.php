<?php
namespace LearnPhpMvc\repository;


class AlatRepository{
    protected \PDO $connecetion;

    public function __construct($connectionconn) {
        $this->connecetion = $connectionconn;
    }

    public function FindAll() :array
    {
        $respos = array();
        $respons['status']= "";
        $respons['respons_code']="";
        $respos['body'] = array();
        $sql = "SELECT * FROM `alat`";
        $result = $this->connecetion->query($sql);

        if ($result->rowCount()>0) {
            $respos['status'] = "oke";
            while ($row=$result->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'id'=>$row['id_alat'],
                    'nama'=>$row['nama_alat'],
                    'gambar'=>$row['gambar']
                );
                array_push($respos['body'],$item);
            }
        }else {
            $respons['status'] = "oke";
            $respons['respons_code'] = 404;
            $respons['massage'] = "Data tidak ditemukan";
        }

        return $respos;
    }

    public function findByName(string $name) : array
    {
        $respons = array();
        $respons['status']= "";
        $respons['respons_code']="";
        $respons['body'] = array();
        $sql = "SELECT * FROM `alat` WHERE nama_alat LIKE '%$name%'";
        $result = $this->connecetion->query($sql);

        if ($result->rowCount()>0) {
            $respons['status'] = "oke";
            $respons['respons_code'] = 200;
            while ($row=$result->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'id'=>$row['id_alat'],
                    'nama'=>$row['nama_alat'],
                    'gambar'=>$row['gambar']
                );
                array_push($respons['body'],$item);
            }
        }else {
            $respons['status'] = "not found";
            $respons['respons_code'] = 404;
            $respons['massage'] = "Data tidak ditemukan";
        }

        return $respons;
    }

    public function addData($nama,$gambar)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "INSERT INTO `alat`(`id_alat`, `nama_alat`, `gambar`) VALUES (NULL,'$nama','$gambar')";
            $stmt = $this->connecetion->prepare($sql);
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


    public function editData($id,$nama, $gambar)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "UPDATE `alat` SET `nama_alat`='$nama',`gambar`='$gambar' WHERE id_alat = $id";
            $stmt = $this->connecetion->prepare($sql);
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

    public function editNameData($id,$nama)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "UPDATE `alat` SET `nama_alat` = '$nama' WHERE `alat`.`id_alat` = $id;";
            $stmt = $this->connecetion->prepare($sql);
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

    public function deletData($id)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "DELETE FROM `alat` WHERE alat.id_alat = $id";
            $stmt = $this->connecetion->prepare($sql);
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

?>