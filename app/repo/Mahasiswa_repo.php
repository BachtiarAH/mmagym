<?php

require_once ('Query.php');


class Mahasiswa_repo extends Query{
    public function getAllMahasiswa()
    {
        $query = "SELECT * FROM mahasiswa";
        return $this->get_query($query);
    }
}