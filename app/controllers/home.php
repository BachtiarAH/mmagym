<?php

class Home extends Controller{
    public function index($nama = "Admin")
    {
        $data['nama'] = $nama;
        $data['judul'] = "index";

        $this->view("template/header",$data);
        $this->view("home/index",$data);
        $this->view("template/footer",$data);
    }

}