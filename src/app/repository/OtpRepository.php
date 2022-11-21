<?php

namespace LearnPhpMvc\repository;

class OtpRepository{
    protected \PDO $connection;


    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function addOtp($email,$otp)
    {
        $respons = array();
        $respons['status'] = '';
        try {
            $sql = "INSERT INTO `otp`(`email`, `otp`) VALUES ('$email','$otp')";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $respons['status'] = 'succes';
        } catch (\Throwable $th) {
            $respons['status'] = 'fail';
            $respons['massage'] = $th->getMessage();
        }

        return $respons;
    }

    public function findOtp($email, $otp)
    {
        $respons = array();
        $respons['status'] = "";
        $respons['respons_code'] = "";
        $respons['body'] = array();
        $sql = "SELECT `email`, `otp` FROM `otp` WHERE email = '$email' AND otp = '$otp'";
        $result = $this->connection->query($sql);

        if ($result->rowCount() > 0) {
            $respons['message'] = "oke";
            $respons['respons_code'] = 200;
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'email' => $row['email'],
                    'otp' => $row['otp'],
                    
                );
                array_push($respons['body'], $item);
            }
        } else {
            $respons['status'] = "not found";
            $respons['respons_code'] = 404;
            $respons['message'] = "Data tidak ditemukan";
        }

        return $respons;
    }

    public function deleteOtp($email)
    {
        $respons = array();
        $respons['status'] = '';
        try {
            $sql = "DELETE FROM `otp` WHERE email = '$email'";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $respons['status'] = 'succes';
        } catch (\Throwable $th) {
            $respons['status'] = 'fail';
            $respons['massage'] = $th->getMessage();
        }

        return $respons;
    }

    public function updateOtp($email,$otp)
    {
        $respons = array();
        $respons['status'] = '';
        try {
            $sql = "UPDATE `otp` SET `otp`='$otp' WHERE email = '$email'";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $respons['status'] = 'succes';
        } catch (\Throwable $th) {
            $respons['status'] = 'fail';
            $respons['massage'] = $th->getMessage();
        }

        return $respons;
    }

    public function findByEmail($email)
    {
        $respons = array();
        $respons['status'] = "";
        $respons['respons_code'] = "";
        $respons['body'] = array();
        $sql = "SELECT `email`, `otp` FROM `otp` WHERE email = '$email'";
        $result = $this->connection->query($sql);

        if ($result->rowCount() > 0) {
            $respons['message'] = "oke";
            $respons['respons_code'] = 200;
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'email' => $row['email'],
                    'otp' => $row['otp'],
                    
                );
                array_push($respons['body'], $item);
            }
        } else {
            $respons['status'] = "not found";
            $respons['respons_code'] = 404;
            $respons['message'] = "Data tidak ditemukan";
        }

        return $respons;
    }
}