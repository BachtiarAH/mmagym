<?php
namespace LearnPhpMvc\Model;

class Application
{
    private $id; //int
    private $nama; //String
    private $password; //String
    private $email; //String
    private $alamat; //String
    private $akses; //int

    

    /**
     * Get the value of akses
     */ 
    public function getAkses()
    {
        return $this->akses;
    }

    /**
     * Get the value of alamat
     */ 
    public function getAlamat()
    {
        return $this->alamat;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of nama
     */ 
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}
