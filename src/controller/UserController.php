<?php

require_once "./src/models/User.php";

class UserController {
    private $db;
    private User $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function create() {  
        $error = [];
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $diretorio = "./src/assets/uploads/users/";

                // Gera um nome baseado na data e hora + um identificador único
                $nomeArquivo = date("Ymd_His") . "_" . uniqid() . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

                // Validação do tipo de arquivo (somente imagens JPG, PNG, GIF)
                $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
                $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($extensao, $extensoesPermitidas)) {
                    die("Erro: Apenas arquivos de imagem são permitidos.");
                }

                $caminhoArquivo = "$diretorio$nomeArquivo";

                // Move o arquivo para o diretório de uploads
                move_uploaded_file($_FILES["image"]["tmp_name"], $caminhoArquivo);
                



                $this->user->setName($_POST['name'])
                    ->setEmail($_POST['email'])
                    ->setTel($_POST['tel'])
                    ->setPassword($_POST['password'])
                    ->setImage($caminhoArquivo);

                if ($this->user->create()) {
                    header("Location: index.php?action=login");
                    exit;
                } else {
                    $error['query'] = 'Error: Erro ao cadastrar usuário';
                }
            }
        } catch (PDOException $e) {
            $error['query'] = 'Error:  ' . $e->getMessage();
        }
        return [
            'view' => './src/views/user/create.php',
            'title' => 'Cadastre-se',
            'css' => './src/assets/styles/CadastroLogin.css',
            'js' => './src/assets/js/img.js',
            'error' => $error
        ];
    }

    public function edit() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                // $diretorio = "./src/assets/uploads/users/";

                // // Gera um nome baseado na data e hora + um identificador único
                // $nomeArquivo = date("Ymd_His") . "_" . uniqid() . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

                // // Validação do tipo de arquivo (somente imagens JPG, PNG, GIF)
                // $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
                // $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
                // if (!in_array($extensao, $extensoesPermitidas)) {
                //     die("Erro: Apenas arquivos de imagem são permitidos.");
                // }

                // $caminhoArquivo = "$diretorio$nomeArquivo";

                // Move o arquivo para o diretório de uploads
                move_uploaded_file($_FILES["image"]["tmp_name"], $_SESSION['user']['img']);


                $this->user->setName($_POST['name'])
                        ->setEmail($_POST['email'])
                        ->setTel($_POST['tel'])
                        ->setID($_SESSION['user']['id'])
                        ->setImage($_SESSION['user']['img']);


                    if ($this->user->edit()) {
                        header("Location: index.php?action=user");
                        exit;
                    }
            }
        } catch (PDOException $e) {
            error_log("Erro ao criar usuário: " . $e->getMessage());
        }
        return [
            'view' => './src/views/user/edit.php',
            'title' => 'Perfil',
            'css' => './src/assets/styles/editarDados.css',
            'js' => './src/assets/js/img.js'
        ];
    }

    public function login(): array {
        try {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $this->user->setEmail($_POST["email"])
                    ->setPassword($_POST["password"]);
                
                if ($this->user->login()) {
                    header("Location: index.php?action=vendas&login=true");
                    exit;
                }
            }
        } catch (PDOException $e) {
            error_log('Erro ao autenticar registro: ' . $e->getMessage());
        }
        return [
            'view' => './src/views/login.php',
            'title' => 'Entrar',
            'css' => './src/assets/styles/login.css'
        ];
    }
}