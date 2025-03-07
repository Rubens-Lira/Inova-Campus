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
        <a href="index.php?action=product-create">Editar</a>
    </nav>
    <div class="profile">
        <img src="./src/assets/img/fotodeUsuario.jpg" alt="Usuário" class="perfil" />
        <p class="user-name"><a href="index.php?action=user"><?= $_SESSION['user']['name'] ?></a></p>
    </div>

    <h2 class="titulo">Editar Produto</h2>

    <form method="post">
        <label for="nome">Nome do Produto:</label>
        <input
            type="text"
            name="name"
            id="nome" placeholder="Digite o nome do produto"
            value="<?= $products['pdt_name'] ?? '' ?>" />

        <label for="valor">Valor:</label>
        <input
            type="number"
            name="price"
            id="valor" step="0.01" min="0" placeholder="Digite valor do produto"
            value="<?= $products['pdt_unit_price'] ?? 0 ?>" />

        <label for="quantidade">Quantidade:</label>
        <input
            type="text"
            name="units"
            id="quantidade"
            placeholder="Digite a quantidade do produto"
            value="<?= $products['pdt_units'] ?? 0 ?>" />

        <label for="description">Description:</label>
        <textarea name="description" id="description">
        <?= $products['pdt_description'] ?? '' ?>
        </textarea>
        <!-- <label for="imagem">Upload de Imagem:</label>
        <input type="file" id="imagem"> -->

        <div class="buttons">
            <a href="index.php?action=product-delete&id=<?= $products['pdt_id'] ?>" class="btn apagar">Apagar</a>
            <button type="submit" class="btn entrar">Atualizar</button>
        </div>
    </form>
    <div class="erros">
        <?php if (isset($error['query'])): ?>
            <span class="erro"><?= htmlspecialchars($error['query']) ?></span>
            <?php $error = [] ?>
        <?php endif ?>
    </div>
</div>