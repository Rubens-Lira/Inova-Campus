<header>
  <h1>INOVA CAMPUS</h1>
</header>
<main>
  <div class="welcome-card">
    <button class="close-btn">✖</button>
    <h2>Bem-vindo, <?= htmlspecialchars($_SESSION['user']['name']) ?>! 🎉</h2>
    <p>
      Que bom ter você por aqui! Este é o momento perfeito para deixar seu perfil com a sua cara:
      Adicione uma foto de perfil e personalize suas preferências.
    </p>
    <a href="./usuario.php" class="update-btn">Atualize seu perfil</a>
  </div>
</main>