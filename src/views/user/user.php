<div class="container">
    <header class="header">
        <h1>inova campus</h1>
    </header>
    <nav class="nav-container">
        <a href="index.php?action=vendas" class="back-link">Página inicial</a>
        &#62;
        <a href="index.php?action=user" class="back-link">Perfil</a>
    </nav>
    <div class="profile">
        <img src="<?= $_SESSION['user']['img'] ?>" alt="Usuário" class="avatar">
        <span class="edit-icon"></span>
        <p class="user-name"><?= $_SESSION['user']['name'] ?><span class="edit-icon"></span></p>
    </div>

    <h3><a href="index.php?action=user-edit">Informações Básicas <span class="edit-icon">✏️</span></a></h3>

    <div class="info-box">
        <p><strong>E-mail:</strong> <?= $_SESSION['user']['email'] ?></p>
        <!-- <p><strong>Senha:</strong> ********</p> -->
        <p><strong>Número do Whatsapp:</strong> <?= $_SESSION['user']['tel'] ?></p>
    </div>

    <hr>
    <h3>Informações do Vendedor</h3>
    <ul>
        <!-- <li><a href="#">Número de vendas e avaliações</a></li> -->
        <li><a href="index.php?action=product-list&offset=0">Veja seus produtos</a></li>

    </ul>
    <a href="index.php?action=logout" class="logout-btn">Sair da conta</a>
</div>