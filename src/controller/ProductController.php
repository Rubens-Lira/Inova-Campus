<?php

require_once './src/models/Product.php';

class ProductController {
    private $db;
    private Product $product;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db);
    }

    public function create() {
        $error = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $diretorio = "./src/assets/uploads/products/";

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

            $this->product->setName($_POST['name'])
                ->setPrice($_POST['price'])
                ->setimage($caminhoArquivo)
                ->setUser($_SESSION['user']['id']);

            try {
                if ($this->product->create()) {
                    header('Location: index.php?action=product-list');
                    exit;
                } else {
                    $error['query'] = 'Error: Erro ao cadastrar produto';
                }
            } catch (PDOException $e) {
                $error['query'] = 'Error:  ' . $e->getMessage();
            }
        }

        return[
            'view' => './src/views/product/create.php',
            'title' => 'Criar produto',
            'error' => $error,
            'css' => './src/assets/styles/CadastroProdutos.css',
            'js' => './src/assets/js/img.js'
        ];
    }

    public function read($id) {
        $products = $this->product->read($id);
        return[
            'view' => './src/views/product/read.php',
            'title' => 'Produto',
            'data' => $products
        ];
    }

    public function list($offset = 0) {
        $products = $this->product->list($offset);
        return[
            'view' => './src/views/product/list.php',
            'title' => 'Meus produtos',
            'data' => $products,
            'css' => './src/assets/styles/verProdutos.css'
        ];
    }

    public function listAll($offset = 0) {
        $products = $this->product->listAll($offset);
        return[
            'view' => './src/views/vendas.php',
            'title' => 'Meus produtos',
            'data' => $products,
            'css' => './src/assets/styles/vendasPagInicial.css'
        ];
    }

    public function edit($id) {
        $error = [];
        $product = $this->product->read($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $route = $this->product->getImageRoute($id);
            $img = $route['pdt_img'];
            move_uploaded_file($_FILES["image"]["tmp_name"], $img);

            $this->product->setName($_POST['name'])
                ->setPrice($_POST['price'])
                ->setimage($img)
                ->setId($id);

            try {
                if ($this->product->edit()) {
                    header('Location: index.php?action=product-list');
                    exit;
                } else {
                    $error['query'] = 'Error:  ao editar produto';
                }
            } catch (PDOException $e) {
                $error['query'] = 'Error:  ' . $e->getMessage();
            }
        }

        return[
            'view' => './src/views/product/edit.php',
            'title' => 'Editar produto',
            'error' => $error,
            'data' => $product,
            'css' => './src/assets/styles/editarProdutos.css',
            'js' => './src/assets/js/img.js'
        ];
    }

    public function delete($id) {
        $this->product->setId($id)
            ->delete();

        header("Location: index.php?action=product-list");
        exit;
    }
}