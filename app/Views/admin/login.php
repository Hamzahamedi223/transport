<div class="admin-auth">
  <div class="admin-auth-card">
    <span class="icon-badge solid" style="width:56px;height:56px;border-radius:16px;margin-bottom:18px;"><?= icon('delivery-bold-duotone') ?></span>
    <h1 style="font-size:24px;margin-bottom:6px;">Espace administrateur</h1>
    <p style="margin-bottom:26px;">Zaouali Transport — accès réservé</p>

    <?php if (!empty($error)): ?>
      <div class="admin-alert">Identifiants incorrects. Réessayez.</div>
    <?php endif; ?>

    <form method="post" action="<?= $baseUrl ?>/admin/login">
      <div class="form-group full">
        <label>Identifiant</label>
        <input type="text" name="username" autocomplete="username" required autofocus/>
      </div>
      <div class="form-group full">
        <label>Mot de passe</label>
        <input type="password" name="password" autocomplete="current-password" required/>
      </div>
      <button type="submit" class="btn btn-primary btn-block btn-lg">Se connecter</button>
    </form>

    <a href="<?= $baseUrl ?>/#top" class="admin-back-link">&larr; Retour au site</a>
  </div>
</div>
