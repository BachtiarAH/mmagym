<?php

namespace LearnPhpMvc\repository;

class userRepository{
    protected \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function FindAll() : array
    {
        $respons = array() ;
        $respons['body'] = array();
        $sql = "SELECT * FROM `usermma`";
        $result = $this->connection->query($sql);

        if ($result->rowCount()>0) {
            echo "ada";
            $respons['status'] = "oke";

            $coun = 0;

            while ($row=$result->fetch(\PDO::FETCH_ASSOC)){
//                extract(e$row);
                // var_dump($row);
                
                $item = array(
                    'id'=>$row['id'],
                    'nama'=>$row['nama'],
                    'password'=>$row['password'],
                    'email'=>$row['email'],
                    'alamat'=>$row['Alamat'],
                    'akses'=>$row['akses'],
                    'coun'=>$coun
                );
                $coun++;
                // var_dump($item);
                array_push($respons['body'],$item);
            }


        } else {
            echo "tidak ada";
            $respons['status'] = "fail";
        }

        return $respons;
        
    }

    
}

?>