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
        &#62;
        <a href="index.php?action=product-create">Criar</a>
    </nav>
    <div class="profile">
        <img src="<?= $_SESSION['user']['img'] ?>" alt="Usuário" class="perfil" />
        <p class="user-name"><a href="index.php?action=user"><?= $_SESSION['user']['name'] ?></a></p>
    </div>

    <h2 class="titulo">Comece a empreender</h2>
    <p>Cadastre os seus produtos</p>

    <form method="post" enctype="multipart/form-data">
        <label for="nome">Nome do Produto:</label>
        <input
            type="text"
            name="name"
            id="nome" placeholder="Digite o nome do produto"
            value="<?= $_POST['name'] ?? '' ?>" />

        <label for="valor">Valor:</label>
        <input
            type="number"
            name="price"
            id="valor" step="0.01" min="0" placeholder="Digite valor do produto"
            value="<?= $_POST['price'] ?? 0 ?>" />

        <label id="drop-label" for="file-input">
            <p id="drop-text">Arraste uma imagem aqui ou clique para selecionar</p>
            <input type="file" id="file-input" name="image" accept="image/*" hidden />
            <img id="preview" src="" alt="Pré-visualização da imagem" style="display: none;" />
            <button id="remove-btn" type="button" style="display: none;">Remover imagem</button>
        </label>

        <button type=" submit">Cadastrar</button>
    </form>
    <div class="erros">
        <?php if (isset($error['query'])): ?>
            <span class="erro"><?= htmlspecialchars($error['query']) ?></span>
            <?php $error = [] ?>
        <?php endif ?>
    </div>
</div>