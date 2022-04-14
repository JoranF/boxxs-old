<?php
class db
{
    private $host = 'ec2-63-35-156-160.eu-west-1.compute.amazonaws.com';
    private $dbname = 'd57vhth3pq73b3';
    private $username = 'stjhlicyjplheu';
    private $password = 'e6ebde59e80e417eb392dd4a18a985dcecf40fe95a9e93e1277af4b824beeb1c';

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }


}
