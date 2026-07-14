<?php
$goodsLabels = [
    'moving'    => 'Déménagement complet',
    'furniture' => 'Meubles / électroménager',
    'goods'     => 'Marchandises pro',
    'parcel'    => 'Colis / envoi',
    'other'     => 'Autre',
];
$statusLabels = [
    'new'       => 'Nouvelle',
    'contacted' => 'Contactée',
    'confirmed' => 'Confirmée',
    'done'      => 'Terminée',
];
$langFlags = ['fr' => 'FR', 'ar' => 'AR'];
?>
<div class="admin-shell">
  <div class="admin-topbar">
    <div class="container admin-topbar-inner">
      <a href="<?= $baseUrl ?>/#top" class="navbar-brand" style="color:var(--c-navy-800);">
        <span class="mark"><?= icon('delivery-bold-duotone') ?></span>
        <span>Zaouali Transport<small>Tableau de bord</small></span>
      </a>
      <a href="<?= $baseUrl ?>/admin/logout" class="btn btn-outline-dark">Déconnexion</a>
    </div>
  </div>

  <div class="container admin-body">
    <div class="admin-filters">
      <a href="<?= $baseUrl ?>/admin" class="admin-filter <?= $status === '' ? 'is-active' : '' ?>">Toutes <span><?= $counts['all'] ?></span></a>
      <a href="<?= $baseUrl ?>/admin?status=new" class="admin-filter <?= $status === 'new' ? 'is-active' : '' ?>">Nouvelles <span><?= $counts['new'] ?></span></a>
      <a href="<?= $baseUrl ?>/admin?status=contacted" class="admin-filter <?= $status === 'contacted' ? 'is-active' : '' ?>">Contactées <span><?= $counts['contacted'] ?></span></a>
      <a href="<?= $baseUrl ?>/admin?status=confirmed" class="admin-filter <?= $status === 'confirmed' ? 'is-active' : '' ?>">Confirmées <span><?= $counts['confirmed'] ?></span></a>
      <a href="<?= $baseUrl ?>/admin?status=done" class="admin-filter <?= $status === 'done' ? 'is-active' : '' ?>">Terminées <span><?= $counts['done'] ?></span></a>
    </div>

    <?php if (empty($requests)): ?>
      <div class="admin-empty">
        <span class="icon-badge" style="width:52px;height:52px;border-radius:14px;margin-bottom:14px;"><?= icon('check-circle-bold-duotone') ?></span>
        <p>Aucune demande pour le moment.</p>
      </div>
    <?php endif; ?>

    <div class="admin-list">
      <?php foreach ($requests as $r): ?>
      <div class="admin-card admin-status-<?= htmlspecialchars($r['status']) ?>">
        <div class="admin-card-head">
          <div>
            <b><?= htmlspecialchars($r['name']) ?></b>
            <span class="admin-lang-flag"><?= $langFlags[$r['lang']] ?? strtoupper($r['lang']) ?></span>
            <div class="admin-phone"><?= icon('phone-calling-rounded-bold-duotone') ?> <a href="tel:+<?= whatsapp_number($r['phone']) ?>"><?= htmlspecialchars($r['phone']) ?></a></div>
          </div>
          <div class="admin-card-meta">
            <span class="admin-status-badge"><?= $statusLabels[$r['status']] ?? $r['status'] ?></span>
            <span class="admin-date"><?= date('d/m/Y H:i', strtotime($r['created_at'])) ?></span>
          </div>
        </div>

        <div class="admin-card-body">
          <?php if ($r['trip_type'] === 'simple'): ?>
            <div class="admin-detail">
              <?= icon('point-on-map-bold-duotone') ?>
              <span><?= $r['direction'] === 'deliver' ? 'Livrer chez le client' : 'Récupérer chez le client' ?><?= !empty($r['address']) ? ' — ' . htmlspecialchars($r['address']) : '' ?></span>
            </div>
          <?php else: ?>
            <div class="admin-detail">
              <?= icon('routing-2-bold-duotone') ?>
              <span><?= htmlspecialchars($r['from_address'] ?: '?') ?> &rarr; <?= htmlspecialchars($r['to_address'] ?: '?') ?></span>
            </div>
          <?php endif; ?>

          <div class="admin-detail">
            <?= icon('box-bold-duotone') ?>
            <span><?= $goodsLabels[$r['goods_type']] ?? $r['goods_type'] ?></span>
          </div>

          <?php if (!empty($r['preferred_date'])): ?>
          <div class="admin-detail">
            <?= icon('calendar-bold-duotone') ?>
            <span><?= date('d/m/Y', strtotime($r['preferred_date'])) ?></span>
          </div>
          <?php endif; ?>

          <?php if (!empty($r['notes'])): ?>
          <div class="admin-note"><?= nl2br(htmlspecialchars($r['notes'])) ?></div>
          <?php endif; ?>
        </div>

        <div class="admin-card-actions">
          <a href="<?= $r['wa_confirm_url'] ?>" target="_blank" rel="noopener" class="btn btn-whatsapp">
            <?= icon('baseline-whatsapp') ?> Confirmer sur WhatsApp
          </a>

          <form method="post" action="<?= $baseUrl ?>/admin/status" class="admin-status-form">
            <input type="hidden" name="id" value="<?= $r['id'] ?>"/>
            <input type="hidden" name="back" value="<?= htmlspecialchars($baseUrl . '/admin' . ($status ? '?status=' . urlencode($status) : '')) ?>"/>
            <select name="status" onchange="this.form.submit()">
              <?php foreach ($statusLabels as $val => $label): ?>
                <option value="<?= $val ?>" <?= $r['status'] === $val ? 'selected' : '' ?>><?= $label ?></option>
              <?php endforeach; ?>
            </select>
          </form>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
