<?php


namespace LearnPhpMvc\Domain;

use Cassandra\Date;
use DateTime;

class PencariMagang{
    
    private int $id;
    private string $username;
    private string $password;
    private string $email;
    private string $no_telp;
    private string $tanggalLahir;
    private int $id_sekolah;

    /**
     * @return int
     */
    public function getIdSekolah(): int
    {
        return $this->id_sekolah;
    }

    /**
     * @param int $id_sekolah
     */
    public function setIdSekolah(int $id_sekolah): void
    {
        $this->id_sekolah = $id_sekolah;
    }

    /**
     * @return bool
     */
    public function isStatusMagang(): bool
    {
        return $this->statusMagang;
    }

    /**
     * @param bool $statusMagang
     */
    public function setStatusMagang(bool $statusMagang): void
    {
        $this->statusMagang = $statusMagang;
    }
    private string $statusMagang;
    private string $agama;

    /**
     * @return DateTime
     */
    public function getTanggalLahir(): string
    {
        return $this->tanggalLahir;
    }

    /**
     * @param DateTime $tanggalLahir
     */
    public function setTanggalLahir(string $tanggalLahir): void
    {
        $this->tanggalLahir = $tanggalLahir;
    }
    private string $token;
    private string $cv;
    private string $resume;
    private string $status;
    private int $role;
    private string $create_at;
    private string $update_at;
    

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getNo_telp()
    {
        return $this->no_telp;
    }

    /**
     * Set the value of no_telp
     *
     * @return  self
     */ 
    public function setNo_telp($no_telp)
    {
        $this->no_telp = $no_telp;

        return $this;
    }

    /**
     * Get the value of agama
     */ 
    public function getAgama()
    {
        return $this->agama;
    }

    /**
     * Set the value of agama
     *
     * @return  self
     */ 
    public function setAgama($agama)
    {
        $this->agama = $agama;

        return $this;
    }

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of cv
     */ 
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set the value of cv
     *
     * @return  self
     */ 
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get the value of resume
     */ 
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set the value of resume
     *
     * @return  self
     */ 
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of create_at
     */ 
    public function getCreate_at()
    {
        return $this->create_at;
    }

    /**
     * Set the value of create_at
     *
     * @return  self
     */ 
    public function setCreate_at($create_at)
    {
        $this->create_at = $create_at;

        return $this;
    }

    /**
     * Get the value of update_at
     */ 
    public function getUpdate_at()
    {
        return $this->update_at;
    }

    /**
     * Set the value of update_at
     *
     * @return  self
     */ 
    public function setUpdate_at($update_at)
    {
        $this->update_at = $update_at;

        return $this;
    }
    
}