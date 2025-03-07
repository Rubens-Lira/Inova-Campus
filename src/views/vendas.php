<div class="container">
  <header class="header">
    <h1>Inova Campus</h1>
  </header>
  <div class="user-info">
    <div class="user-container">
      <img
        src="./src/assets/img/fotodeUsuario.jpg"
        alt="Usuário"
        class="user-img"
      />
      <span class="user"><a href="index.php?action=user"><?= $_SESSION['user']['name'] ?></a></span>
    </div>
  
    <div>
      <button class="logout"><a href="index.php?logout.php">Sair da conta</a></button>
    </div>
  </div>
  
  <section class="categorias">
    <h2>Categorias</h2>
    <div class="row">
      <div class="icons">
        <div class="categoria item">
          <img src="./src/assets/img/lanche.png" alt="Lanches" />
          <p>Lanches</p>
        </div>
        <div class="categoria item">
          <img src="./src/assets/img/artesanato.jpg" alt="Artesanato" />
          <p>Artesanato</p>
        </div>
        <div class="categoria item">
          <img src="./src/assets/img/platinha.png" alt="Plantinhas" />
          <p>Plantinhas</p>
        </div>
        <div class="categoria item">
          <img src="./src/assets/img/cupcake.png" alt="Doces" />
          <p>Doces</p>
        </div>
    </div>
    </div>
  </section>
  
  <section class="mais-vendidos">
    <h2>Mais vendidos da semana</h2>
    <?php foreach ($products as $p): ?>
      <div class="produto">
        <img src="./src/assets/img/empada.jpg" alt="Empada do Borges" />
        <div class="info">
          <h3><?= $p['pdt_name'] ?></h3>
          <p class="preco"><?= $p['pdt_unit_price'] ?></p>
          <button class="btn"><a href="index.php?action=product-read&id=<?= $p['pdt_id'] ?>">Comprar</a></button>
        </div>
      </div>
    <?php endforeach ?>
  </section>
  <section id="backgound">
      <article class="modal">
        <span id="x">
          X
        </span>
        <h1>Seja bem vindo ao Inova Campus, <?= $_SESSION['user']['name'] ?>!🚀</h1>
        <p>Aqui, inovação e qualidade caminham juntas para garantir produtos que fazem a diferença no seu dia a dia!</p>
      </article>
  </section>
</div>
<script>
  const fechar = document.querySelector("#x")
  const back = document.querySelector("#backgound")
  fechar.addEventListener("click", () => {
    back.style.height = 0
  })
</script>