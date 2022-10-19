<?php

require_once('../app/repo/Mahasiswa_repo.php');

class Mahasiswa_model {
    private $id;
    private $nama;
    private $nim;
    private $jurusan;

    public function getAllData()
    {
        $dataMahasiswa = new Mahasiswa_repo();
        return $dataMahasiswa->getAllMahasiswa();
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNama(){
		return $this->nama;
	}

	public function setNama($nama){
		$this->nama = $nama;
	}

	public function getNim(){
		return $this->nim;
	}

	public function setNim($nim){
		$this->nim = $nim;
	}

	public function getJurusan(){
		return $this->jurusan;
	}

	public function setJurusan($jurusan){
		$this->jurusan = $jurusan;
	}
}