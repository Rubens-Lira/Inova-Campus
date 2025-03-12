<?php
class Database
{
    private $db_host = "127.0.0.1:3306";
    private $db_nome = "INOVA_CAMPUS";
    private $db_user = "root";
    private $db_senha = "root";
    private $conn = null;

    public function getConnection(): PDO
    {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->db_host};dbname={$this->db_nome};charset=utf8mb4",
                $this->db_user,
                $this->db_senha
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Falha na conexão: " . $e->getMessage());
        }
        return $this->conn;
    }
}

$conn = new Database();

$conn->getConnection();