<div class="container">
  <header class="header">
    <h1>Inova Campus</h1>
  </header>
  <div class="user-info">
    <div class="user-container">
      <img src="<?= $_SESSION['user']['img'] ?>" alt="Usuário" class="user-img" />
      <span class="user"><a href="index.php?action=user"><?= $_SESSION['user']['name'] ?></a></span>
    </div>
    <a href="index.php?action=carrinho" class="carrinho"></a>
  </div>

  <section class="mais-vendidos">
    <h2>Mais vendidos da semana</h2>
    <?php foreach ($products as $p): ?>
      <div class="produto">
        <img src="<?= $p['pdt_img'] ?>" alt="Empada do Borges" />
        <div class="info">
          <h3><?= $p['pdt_name'] ?></h3>
          <p class="preco"><?= number_format($p['pdt_unit_price'], 2, ',', '.') ?></p>
          <form method="post" action="index.php?action=add_carrinho">
            <input type="hidden" name="id" value="<?= $p['pdt_id'] ?>">
            <input type="hidden" name="name" value="<?= $p['pdt_name'] ?>">
            <input type="hidden" name="image" value="<?= $p['pdt_img'] ?>">
            <input type="hidden" name="unit_price" value="<?= $p['pdt_unit_price'] ?>">
            <input type="hidden" name="user" value="<?= $p['pdt_user'] ?>">
            <input type="hidden" name="phone" value="<?= $p['usr_phone'] ?>">
            <button type="submit" class="btn">Adicionar ao carrinho</button>
          </form>
        </div>
      </div>
    <?php endforeach ?>
  </section>
  <section id="background">
    <article class="modal">
      <span id="x">
        X
      </span>
      <h1>Seja bem vindo ao Inova Campus, <?= $_SESSION['user']['name'] ?>!🚀</h1>
      <p>Que bom ter você por aqui! Um espaço feito para conectar nossa comunidade acadêmica com inovação, praticidade e segurança. Explore, compre, venda e faça parte dessa transformação!</p>
    </article>
  </section>
</div>
<script>
  const fechar = document.querySelector("#x")
  const back = document.querySelector("#background")
  const url = window.location.href
  const res = url.split("?")
  // const recaregou = sessionStorage.getItem("recarregou")

  if (res[1] !== undefined) {
    const param = res[1].split("&")

    if (param[1]) {
      abriModal()
    }
  }

  function abriModal() {
    back.classList.toggle("abrir")
  }

  fechar.addEventListener("click", abriModal)
</script>