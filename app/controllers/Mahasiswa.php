<?php
class Mahasiswa extends Controller{

    public function index()
    {
        $data['judul'] = 'mahasiswa';
        $data['mhs']=$this->model('Mahasiswa_model')->getAllData();

        $this->view("template/header",$data);
        $this->view("mahasiswa/index",$data);
        $this->view("template/footer",$data);
    }

}