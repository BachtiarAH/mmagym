<?php 
class About extends Controller{
    public function index()
    {
        $data['judul'] = "index";

        $this->view("template/header",$data);
        $this->view("about/index",$data);
        $this->view("template/footer",$data);

    }

    public function page()
    {
        $data['judul'] = "page";
        $this->view("template/header",$data);
        $this->view("about/page",$data);
        $this->view("template/footer",$data);
    }

}