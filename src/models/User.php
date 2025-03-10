<?php 

require_once './src/database/Database.php';

class User {
    private $conn;
    private string $tabela = "inv_users"; 
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $tel;
    private string $image;

    public function __construct($db) {
        $this->setConn($db); 
    }

    public function check(): array | false {
        $tabela = $this->getTabela();
        $query = "SELECT * FROM {$tabela} WHERE usr_email = :email LIMIT 1";

        try {
            $stmt = $this->conn->prepare($query);
            $email = $this->getEmail();
            $stmt->execute(['email' => $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
        } catch (PDOException $e) {
            error_log('Erro ao verificar usuário no método ' . __METHOD__ . ': ' . $e->getMessage());
        }
        return false;
    }

    public function create() {
        $tabela = $this->getTabela();

        if ($this->check()) {
            return false;
        }

        $query = "INSERT INTO {$tabela} (usr_name, usr_email, usr_password, usr_phone, usr_img)
            VALUES (:name, :email, :password, :tel, :image)";
        $stmt = $this->conn->prepare($query);
        $hash = password_hash($this->getPassword(), PASSWORD_DEFAULT);

        $data = [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $hash, 
            'tel' => $this->getTel(),
            'image' => $this->getImage()
        ];
        try {
            return $stmt->execute($data);
        } catch (PDOException $e) {
            // $_POST['error'] = $e->getMessage();
            error_log('Erro ao criar registro na tabela ' . $tabela . ': ' . $e->getMessage());
            return false;
        }
    }
    
    public function edit() {
        $tabela = $this->getTabela();

        $query = "UPDATE {$tabela} SET usr_name = :name, usr_email = :email, usr_phone = :tel, usr_img = :img
            WHERE usr_id = :id";
        $stmt = $this->conn->prepare($query);

        $data = [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'tel' => $this->getTel(),
            'img' => $this->getImage(),
            'id' => $this->getId(),
        ];

        return $stmt->execute($data) ? $_SESSION['user'] = $data : false;
    }

    public function login(): bool {
        $user = $this->check();

        if (!$user) {
            return false;
        }

        if (password_verify($this->getPassword(), $user['usr_password'])) {
            $user = [
                'id' => $user['usr_id'],
                'email' => $user['usr_email'],
                'name' => $user['usr_name'],
                'tel' => $user['usr_phone'],
                'img' => $user['usr_img']
            ];
            $_SESSION['user'] = $user;
    
            return true;
        }
        return false;
    }

    public function getConn(): mixed {
        return $this->conn;
    }

    public function setConn($conn): self {
        $this->conn = $conn;
        return $this;
    }

    public function getTabela(): string {
        return $this->tabela;
    }

    public function setTabela(string $tabela): self {
        $this->tabela = $tabela;
        return $this;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = strip_tags($name);
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = strip_tags($email);
        return $this;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $senha): self {
        $this->password = strip_tags($senha);
        return $this;
    }

    public function getTel(): string {
        return $this->tel;
    }

    public function setTel(string $tel): self {
        $this->tel = strip_tags($tel);
        return $this;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function setImage(string $image): self {
        $this->image = $image;
        return $this;
    }
}