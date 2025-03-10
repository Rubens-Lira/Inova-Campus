<header>
  <h1>INOVA CAMPUS</h1>
</header>

<main>
  <h2>Meu Carrinho</h2>

  <?php if (empty($_SESSION["carrinho"])): ?>
    <p>Seu carrinho está vazio.</p>
  <?php else: ?>
    <div id="cart">
      <?php foreach ($_SESSION["carrinho"] as $item): ?>
        <div class="cart-item">
          <div class="item-details">
            <img src="<?= htmlspecialchars($item['imagem']) ?>" alt="<?= htmlspecialchars($item['nome']) ?>">
            <div class="item-info">
              <h3><?= htmlspecialchars($item['nome']) ?></h3>
              <p>R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
            </div>
          </div>
          <div class="quantity">
            <form method="post" action="index.php?action=rm_carrinho">
              <input type="hidden" name="id" value="<?= $item['id'] ?>">
              <input type="hidden" name="name" value="<?= $item['nome'] ?>">
              <input type="hidden" name="image" value="<?= $item['imagem'] ?>">
              <input type="hidden" name="unit_price" value="<?= $item['preco'] ?>">
              <input type="hidden" name="user" value="<?= $item['vendedor'] ?>">
              <button type="submit" class="btn">-</button>
            </form>
            <span class="count"><?= $item['quantidade'] ?></span>
            <form method="post" action="index.php?action=add_carrinho">
              <input type="hidden" name="id" value="<?= $item['id'] ?>">
              <input type="hidden" name="name" value="<?= $item['nome'] ?>">
              <input type="hidden" name="image" value="<?= $item['imagem'] ?>">
              <input type="hidden" name="unit_price" value="<?= $item['preco'] ?>">
              <input type="hidden" name="user" value="<?= $item['vendedor'] ?>">
              <button type="submit" class="btn">+</button>
            </form>
          </div>
          <p>Valor Total: R$ <?= number_format($item['valor_total'], 2, ',', '.') ?></p>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="total">
      <h3>Total: R$ <?= number_format(array_sum(array_column($_SESSION["carrinho"], 'valor_total')), 2, ',', '.') ?></h3>
    </div>
  <?php endif; ?>

  <div class="whatsapp-container">
    <button id="whatsapp-button">Encaminhar para o WhatsApp</button>
  </div>
</main>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const whatsappButton = document.getElementById("whatsapp-button");

    whatsappButton.addEventListener("click", () => {
      let message = "Pedido:\n";
      <?php if (!empty($_SESSION["carrinho"])): ?>
        <?php foreach ($_SESSION["carrinho"] as $item): ?>
          message += "<?= htmlspecialchars($item['nome']) ?>: <?= $item['quantidade'] ?>x - R$ <?= number_format($item['valor_total'], 2, ',', '.') ?>\n";
        <?php endforeach; ?>
        message += "\nTotal: R$ <?= number_format(array_sum(array_column($_SESSION["carrinho"], 'valor_total')), 2, ',', '.') ?>";
      <?php endif; ?>

      const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
      window.open(whatsappUrl, "_blank");
    });

    <?php if (isset($_SESSION['usuario'])): ?>
      // Dispara a ação de redirecionar para o WhatsApp após o login
      whatsappButton.click();
    <?php endif; ?>
  });
</script>
