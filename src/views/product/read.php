<div class="container">
    <h3><?= $products['pdt_name'] ?></h3>
    <a href="index.php?action=carrinho">Carrinho</a>
    <img src="./src/assets/img/platinha.png" alt="Foto do produto" class="produto" />
    <p><strong>Preço: R$ </strong> <?= $products['pdt_unit_price'] ?> </p>
    <p><strong>Quantidade </strong> <?= $products['pdt_units'] ?> </p>
    <p><strong>Descrição </strong> <?= $products['pdt_description'] ?> </p>

    <form method="post" action="index.php?action=add_carrinho">
        <input type="hidden" name="id" value="<?= $products['pdt_id'] ?>">
        <input type="hidden" name="name" value="<?= $products['pdt_name'] ?>">
        <input type="hidden" name="unit_price" value="<?= $products['pdt_unit_price'] ?>">
        <input type="number" name="units" value="<?= $products['pdt_units'] ?>">
        <input type="hidden" name="user" value="<?= $products['pdt_user'] ?>">
        <button type="submit">Adicionar ao carrinho</button>
    </form>
</div>