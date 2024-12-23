<?php
class Database {
    private $host = 'localhost:3308'; 
    private $username = 'root';     
    private $password = '';            
    private $dbname = 'f1_academy';    
    private $conn;

    // Membuat fungsi untuk melakukan koneksi ke database
    public function connect() {
        if ($this->conn === null) {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }
        return $this->conn;
    }
}
?>
