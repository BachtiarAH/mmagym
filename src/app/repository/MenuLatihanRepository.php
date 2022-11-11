<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Config\Database;
use PDOException;

class MenuLatihanRepository
{
    protected \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function findAll()
    {
        $respons = array();
        try {
            
            $respons['status'] = '';
            $respons['body'] = array();
            $sql = "SELECT * FROM `menu_latihan`";
            $result = $this->connection->query($sql);

            if ($result->rowCount() > 0) {
                $respons['status'] = "oke";
                while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                    $item = array(
                        
                        'id' => $row['id_menu_latihan'],
                        'nama' => $row['nama_menu_latihan'],
                        'part' => $row['part'],
                        'level' => $row['level'],
                        'gambar' => $row['gambar'],
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

    public function findRincianMenuLatihan($id_menu_Latihan)
    {
        $respons = array();
        try {
            
            $respons['status'] = '';
            $respons['body'] = array();
            $respons['body']['header'] = array();
            $respons['body']['isi'] = array();
            $sql = "SELECT menu_latihan.nama_menu_latihan, menu_latihan.part, menu_latihan.level, 
            gerakan.nama_gerakan, gerakan.gambar, gerakan.video, 
            gerakan_menu.note, gerakan_menu.setlatihan, gerakan_menu.repetisi 
            FROM `gerakan_menu`
            JOIN menu_latihan on menu_latihan.id_menu_latihan = gerakan_menu.id_menu_latihan
            JOIN gerakan on gerakan.id_gerakan = gerakan_menu.id_gerakan
            WHERE gerakan_menu.id_menu_latihan = $id_menu_Latihan;";
            $result = $this->connection->query($sql);

            if ($result->rowCount() > 0) {
                $respons['status'] = "oke";
                while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                    $item = array(
                        'nama_gerakan' => $row['nama_gerakan'],
                        'gambar' => $row['gambar'],
                        'repetisi' => $row['repetisi'],
                        'set_latihan' => $row['setlatihan'],
                        'video' => $row['video'],
                        'note' => $row['note'],
                    );
                    $header = array(
                        'nama_menu_latihan'=>$row['nama_menu_latihan'],
                        'part'=>$row['part'],
                        'level'=>$row['level']
                    );
                    array_push($respons['body']['isi'], $item);
                }
                array_push($respons['body']['header'],$header);
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

