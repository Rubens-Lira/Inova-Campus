<?php
session_start();
?>
<!-- teste -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meu Carrinho</title>

  <!-- CSS Global -->
  <link rel="stylesheet" href="../../assets/styles/global/style.css">

  <!-- CSS Específico do Carrinho -->
  <link rel="stylesheet" href="../../assets/styles/Carrinho.css">
</head>

<body>
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
              <a href="index.php?action=rmCarrinho&id=<?= $item['id'] ?>">-</a>
              <span class="count"><?= $item['quantidade'] ?></span>
              <a href="index.php?action=addCarrinho&id=<?= $item['id'] ?>">+</a>
            </div>
            <p>Valor Total: R$ <?= number_format($item['valor_total'], 2, ',', '.') ?></p>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="total">
        <h3>Total: R$ <?= number_format(array_sum(array_column($_SESSION["carrinho"], 'valor_total')), 2, ',', '.') ?>
        </h3>
      </div>
    <?php endif; ?>

    <div class="whatsapp-container">
      <button id="whatsapp-button">Encaminhar para o WhatsApp</button>
    </div>

    <form method="post">
      <button type="submit" name="resetar_carrinho">Resetar Carrinho</button>
      <button type="submit" name="comprar_carrinho">Comprar tudo</button>
    </form>
  </main>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
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
    });
  </script>

</body>

</html>