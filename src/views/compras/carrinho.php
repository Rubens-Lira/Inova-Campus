<h2>Seu Carrinho</h2>

<?php if (empty($_SESSION["carrinho"])): ?>
  <p>Seu carrinho está vazio.</p>
<?php else: ?>
  <ul>
    <?php foreach ($_SESSION["carrinho"] as $item): ?>
      <li>
        <?= $item['nome'] ?> - R$ <?= number_format($item['preco'], 2, ',', '.') ?>
        (Quantidade: <?= $item['quantidade'] ?>)
        Valor Total: R$ <?= number_format($item['valor_total'], 2, ',', '.') ?>
        <a href="index.php?action=rmCarrinho&id=<?= $item['id'] ?>">Remover</a>
      </li>
    <?php endforeach ?>
  </ul>
<?php endif; ?>
<a href="index.php?action=vendas">Comprar mais</a>

<!-- Botão para resetar o carrinho -->
<form method="post">
  <button type="submit" name="resetar_carrinho">Resetar Carrinho</button>
  <button type="submit" name="comprar_carrinho">Comprar tudo</button>
</form>