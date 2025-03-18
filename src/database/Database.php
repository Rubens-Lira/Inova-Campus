<?php
class Database
{
    private $db_host = "127.0.0.1";
    private $db_port = "5432"; // Porta padrão do PostgreSQL
    private $db_nome = "Inova_campus";
    private $db_user = "postgres"; // Usuário padrão do PostgreSQL
    private $db_senha = "root"; // Defina sua senha
    private $conn = null;

    public function getConnection(): PDO
    {
        try {
            $this->conn = new PDO(
                "pgsql:host={$this->db_host};port={$this->db_port};dbname={$this->db_nome}",
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

// Criando instância e conectando
$conn = new Database();
$conn->getConnection();
?>
