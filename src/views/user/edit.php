<div class="container">
  <header class="header">
    <h1>inova campus</h1>
  </header>
  <nav>
    <a href="index.php?action=vendas" class="back-link">Página inicial</a>
    &#62;
    <a href="index.php?action=user" class="back-link">Perfil</a>
    &#62;
    <a href="index.php?action=user-edit" class="back-link">Editar</a>
  </nav>
  <div class="profile">
    <img src="<?= $_SESSION['user']['img'] ?>" alt="Usuário" class="perfil" />
    <p class="user-name"><a href="index.php?action=user"><?= $_SESSION['user']['name'] ?></a></p>
  </div>
  <h3>Editar informações básicas</h3>
  <form method="post" enctype="multipart/form-data">
    <label for="email">
      Email:
      <input type="email" id="email" name="email" placeholder="Digite seu email"
        value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" />
      <?php if (!empty($error['email'])): ?>
        <span class="erro"><?= htmlspecialchars($error['email']) ?></span>
      <?php endif ?>
    </label>

    <label for="nome">
      Nome Completo:
      <input type="text" id="nome" name="name" placeholder="Digite seu nome"
        value="<?= htmlspecialchars($_SESSION['user']['name']) ?>" />
      <?php if (!empty($error['name'])): ?>
        <span class="erro"><?= htmlspecialchars($error['name']) ?></span>
      <?php endif ?>
    </label>

    <label for="whatsapp">
      Número do WhatsApp:
      <input type="tel" id="whatsapp" name="tel" placeholder="Digite apenas números"
        value="<?= htmlspecialchars($_SESSION['user']['tel']) ?>" />
      <?php if (!empty($error['tel'])): ?>
        <span class="erro"><?= htmlspecialchars($error['tel']) ?></span>
      <?php endif ?>
    </label>

    <label id="drop-label" for="file-input">
      <p id="drop-text" style="display: none;">Arraste uma imagem aqui ou clique para selecionar</p>
      <input type="file" id="file-input" name="image" accept="image/*" hidden />
      <img id="preview" src="<?= $_SESSION['user']['img'] ?>" alt="Pré-visualização da imagem"/>
      <button id="remove-btn" type="button"">Remover imagem</button>
    </label>

    <div class="buttons">
      <button type="reset" class="btn cancel">Descartar Alterações</button>
      <button type="submit" class="btn save">Atualizar Alterações</button>
    </div>
  </form>
</div>