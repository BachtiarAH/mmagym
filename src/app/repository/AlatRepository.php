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
                    'nama'=>$row['nama_alat']
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
                    'nama'=>$row['nama_alat']
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
}

?>