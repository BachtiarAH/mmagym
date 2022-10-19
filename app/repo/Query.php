<?php
class Query{
    //field
    protected $database_name = DATABASENAME;
    protected $host = DATABASEHOST;
    protected $user = DATABASEUSER;
    protected $pass = DATABASEPASSWORD;
    private $dsn;
    private $dbh;

    public function __construct()
    {
        $this->dsn = "mysql:host=$this->host;dbname=$this->database_name";
        $this->dbh = new PDO($this->dsn, $this->user, $this->pass);
    }



    public function get_query($query)
    {
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $th) {
            echo $th->getMessage();
        }
        
    }
}