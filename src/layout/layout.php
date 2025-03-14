<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/assets/styles/global/style.css">
    <link rel="stylesheet" href="<?= $css ?>">
    <script defer src="<?= $js ?>"></script>
    <title><?= $title ?></title>
</head>
<body>
    <?php
        if (!empty($view)) {
            include $view;
        } else {
            echo "<p>View não encontrada.</p>";
        }
    ?>
</body>
</html>