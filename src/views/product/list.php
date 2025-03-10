<div class="container">
    <header class="header">
        <h1>inova campus</h1>
    </header>
    <nav class="nav-container">
        <a href="index.php?action=vendas">Página inicial</a>
        &#62;
        <a href="index.php?action=user">Perfil</a>
        &#62;
        <a href="index.php?action=product-list">Produtos</a>
    </nav>
    <div class="profile">
        <img src="<?= $_SESSION['user']['img'] ?>" alt="Usuário" class="perfil" />
        <p class="user-name"><a href="index.php?action=user"><?= $_SESSION['user']['name'] ?></a></p>
    </div>
    <h2 class="titulo">Editar Produtos</h2>
    <p class="legenda">Meus Produtos:</p>


    <div class="grid-products">
        <?php foreach ($products as $p): ?>
            <div class="card">
                <div class="produtos">
                    <img src="<?= $p['pdt_img'] ?>" alt="Foto do produto" class="produto" />
                    <p class="preço"><?= $p['pdt_unit_price'] ?></p>
                    <p class="nomeP"><?= $p['pdt_name'] ?></p>
                </div>
                <a href="index.php?action=product-edit&id=<?= $p['pdt_id'] ?>" class="editar">Editar</a>
            </div>
        <?php endforeach ?>
    </div>
    <a href="index.php?action=product-create" class="adicionarP">Adicionar Produtos</a>
</div>