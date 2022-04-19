<?php
class db
{
    private $host = 'ec2-99-80-170-190.eu-west-1.compute.amazonaws.com';
    private $dbname = 'dc2q52d0687vil';
    private $username = 'gbxkpsyxfobcir';
    private $password = 'b0d5ce4712533b5a212ca9e03a282d1b469a555785d6c5b8e826e59523f3c07e';

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
