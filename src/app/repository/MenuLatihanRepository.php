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

    public function findById($id)
    {
        $respons = array();
        try {

            $respons['status'] = '';
            $respons['body'] = array();
            $sql = "SELECT * FROM `menu_latihan` WHERE id_menu_latihan = '$id'";
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
            $sql = "SELECT gerakan_menu.id_rincian_latihan ,menu_latihan.id_menu_latihan,menu_latihan.nama_menu_latihan,menu_latihan.gambar AS `gambar-menu`, menu_latihan.part, menu_latihan.level, gerakan_menu.id_gerakan,
            gerakan.nama_gerakan, gerakan.gambar AS `gambar-gerakan`, gerakan.video, 
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
                        'id' => $row['id_rincian_latihan'],
                        'id_gerakan' =>$row['id_gerakan'],
                        'nama_gerakan' => $row['nama_gerakan'],
                        'gambar' => $row['gambar-gerakan'],
                        'repetisi' => $row['repetisi'],
                        'set_latihan' => $row['setlatihan'],
                        'video' => $row['video'],
                        'note' => $row['note'],
                    );
                    $header = array(
                        'id' =>$row['id_menu_latihan'],
                        'nama_menu_latihan' => $row['nama_menu_latihan'],
                        'part' => $row['part'],
                        'level' => $row['level'],
                        'gambar' => $row['gambar-menu']
                    );
                    array_push($respons['body']['isi'], $item);
                }
                array_push($respons['body']['header'], $header);
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

    public function addData($nama,$part,$level,$gambar)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "INSERT INTO `menu_latihan`(`nama_menu_latihan`, `part`, `level`, `gambar`) 
            VALUES 
            ('$nama','$part','$level','$gambar')";
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

    public function addRincian($repetisi,$set,$note,$id_gerakan,$id_menu_latihan)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "INSERT INTO `gerakan_menu`(`repetisi`, `setlatihan`, `note`, `id_gerakan`, `id_menu_latihan`) 
            VALUES ('$repetisi','$set','$note','$id_gerakan','$id_menu_latihan')";
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

    public function deleteDataRincian($id)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "DELETE FROM gerakan_menu WHERE `gerakan_menu`.`id_rincian_latihan` = $id";
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

    public function UpdateRincian($id, $note, $set, $repetisi, $idGerakan)
    {
        $respons = array();
        $respons['status'] = '';
        // $respons['respons_code'] = "";
        try {
            $sql = "UPDATE `gerakan_menu` SET 
            `repetisi`='$repetisi',
            `setlatihan`='$set',
            `note`='$note',
            `id_gerakan`='$idGerakan'
            WHERE id_rincian_latihan = $id";
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
