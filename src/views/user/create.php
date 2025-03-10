<div class="container">
  <header class="header">
    <h1>inova campus</h1>
  </header>
  <nav>
    <a href="index.php">Página Inicial</a>
    &#62;
    <a href="index.php?action=user-create">Cadastro</a>
  </nav>
  <h2>Falta pouco para começar a vender</h2>
  <form method="post" enctype="multipart/form-data">
    <label for="email">
      Email:
      <input type="email" id="email" name="email" placeholder="Digite seu email"
        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
      <?php if (!empty($error['email'])): ?>
        <span class="erro"><?= htmlspecialchars($error['email']) ?></span>
      <?php endif ?>
    </label>

    <label for="nome">
      Nome Completo:
      <input type="text" id="nome" name="name" placeholder="Digite seu nome"
        value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" />
      <?php if (!empty($error['name'])): ?>
        <span class="erro"><?= htmlspecialchars($error['name']) ?></span>
      <?php endif ?>
    </label>

    <label for="senha">
      Senha:
      <input type="password" id="senha" name="password" placeholder="Digite sua senha"
        value="<?= htmlspecialchars($_POST['password'] ?? '') ?>" />
      <?php if (!empty($error['password'])): ?>
        <span class="erro"><?= htmlspecialchars($error['password']) ?></span>
      <?php endif ?>
    </label>

    <label for="confirmaSenha">
      Confirme a senha:
      <input type="password" id="confirmaSenha" name="confirm" placeholder="Repita sua senha"
        value="<?= htmlspecialchars($_POST['confirm'] ?? '') ?>" />
      <?php if (!empty($error['confirm'])): ?>
        <span class="erro"><?= htmlspecialchars($error['confirm']) ?></span>
      <?php endif ?>
    </label>

    <label for="whatsapp">
      Número do WhatsApp:
      <input type="tel" id="whatsapp" name="tel" placeholder="Digite apenas números"
        value="<?= htmlspecialchars($_POST['tel'] ?? '') ?>" />
      <?php if (!empty($error['tel'])): ?>
        <span class="erro"><?= htmlspecialchars($error['tel']) ?></span>
      <?php endif ?>
    </label>

    <label id="drop-label" for="file-input">
      <p id="drop-text">Arraste uma imagem aqui ou clique para selecionar</p>
      <input type="file" id="file-input" name="image" accept="image/*" hidden />
      <img id="preview" src="" alt="Pré-visualização da imagem" style="display: none;" />
      <button id="remove-btn" type="button" style="display: none;">Remover imagem</button>
    </label>

    <button type="submit" class="btn">Cadastrar</button>
  </form>
  <div class="erros">
        <?php if (isset($error['query'])): ?>
            <span class="erro"><?= htmlspecialchars($error['query']) ?></span>
            <?php $error = [] ?>
        <?php endif ?>
    </div>
</div>