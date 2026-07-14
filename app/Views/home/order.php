<section class="section section-alt order-section" id="order">
  <div class="container">
    <div class="order-wrap">
      <div class="order-info reveal">
        <span class="chip"><?= icon('check-circle-bold-duotone', 'chip-ic') ?> <?= t('order.eyebrow') ?></span>
        <h2><?= t('order.title') ?></h2>
        <p><?= t('order.subtitle') ?></p>
        <ul>
          <li>
            <span class="icon-badge"><?= icon('clock-circle-bold-duotone') ?></span>
            <div><b><?= t('how.step2.title') ?></b><?= t('how.step2.desc') ?></div>
          </li>
          <li>
            <span class="icon-badge"><?= icon('baseline-whatsapp') ?></span>
            <div><b><?= t('how.step3.title') ?></b><?= t('how.step3.desc') ?></div>
          </li>
        </ul>
      </div>

      <div class="card order-card reveal">
        <form id="orderForm" action="<?= $baseUrl ?>/demande" method="post" novalidate>
          <div class="form-grid">
            <div class="form-group full">
              <label><?= t('order.label.name') ?></label>
              <input type="text" name="name" placeholder="<?= htmlspecialchars(t('order.ph.name')) ?>" required/>
            </div>

            <div class="form-group full">
              <label><?= t('order.label.phone') ?></label>
              <input type="tel" name="phone" placeholder="<?= htmlspecialchars(t('order.ph.phone')) ?>" required/>
            </div>

            <div class="form-group full">
              <label><?= t('order.label.type') ?></label>
              <div class="type-toggle">
                <label>
                  <input type="radio" name="trip_type" value="simple" checked/>
                  <span class="opt"><?= icon('point-on-map-bold-duotone') ?> <?= t('order.type.simple') ?></span>
                </label>
                <label>
                  <input type="radio" name="trip_type" value="double"/>
                  <span class="opt"><?= icon('routing-2-bold-duotone') ?> <?= t('order.type.double') ?></span>
                </label>
              </div>
            </div>

            <div class="form-group full field-block is-active" data-block="simple">
              <label><?= t('order.label.direction') ?></label>
              <div class="type-toggle">
                <label>
                  <input type="radio" name="direction" value="pickup" checked/>
                  <span class="opt"><?= icon('box-bold-duotone') ?> <?= t('order.direction.pickup') ?></span>
                </label>
                <label>
                  <input type="radio" name="direction" value="deliver"/>
                  <span class="opt"><?= icon('delivery-bold-duotone') ?> <?= t('order.direction.deliver') ?></span>
                </label>
              </div>
            </div>

            <div class="form-group full field-block is-active" data-block="simple">
              <label><?= t('order.label.address') ?></label>
              <input type="text" name="address" placeholder="<?= htmlspecialchars(t('order.ph.address')) ?>"/>
            </div>

            <div class="form-group field-block" data-block="double">
              <label><?= t('order.label.from') ?></label>
              <input type="text" name="from_address" placeholder="<?= htmlspecialchars(t('order.ph.from')) ?>"/>
            </div>
            <div class="form-group field-block" data-block="double">
              <label><?= t('order.label.to') ?></label>
              <input type="text" name="to_address" placeholder="<?= htmlspecialchars(t('order.ph.to')) ?>"/>
            </div>

            <div class="form-group">
              <label><?= t('order.label.goods') ?></label>
              <select name="goods_type">
                <option value="moving"><?= t('order.goods.moving') ?></option>
                <option value="furniture"><?= t('order.goods.furniture') ?></option>
                <option value="goods"><?= t('order.goods.goods') ?></option>
                <option value="parcel"><?= t('order.goods.parcel') ?></option>
                <option value="other"><?= t('order.goods.other') ?></option>
              </select>
            </div>
            <div class="form-group">
              <label><?= t('order.label.date') ?></label>
              <input type="date" name="preferred_date" id="preferredDate"/>
            </div>

            <div class="form-group full">
              <label><?= t('order.label.notes') ?></label>
              <textarea name="notes" placeholder="<?= htmlspecialchars(t('order.ph.notes')) ?>"></textarea>
            </div>
          </div>

          <div class="form-submit-row">
            <button type="submit" class="btn btn-primary btn-lg"><?= icon('delivery-bold-duotone') ?> <?= t('order.submit') ?></button>
            <small><?= t('order.privacy') ?></small>
          </div>
        </form>

        <div class="confirm-panel" id="confirmPanel">
          <span class="icon-badge solid" style="width:64px;height:64px;border-radius:18px;margin-bottom:20px;"><?= icon('check-circle-bold-duotone') ?></span>
          <h3><?= t('order.confirm.title') ?></h3>

          <div class="confirm-step">
            <span class="icon-badge"><?= icon('check-circle-bold-duotone') ?></span>
            <div><b><?= t('order.confirm.step1') ?></b><p><?= t('order.confirm.step1desc') ?></p></div>
          </div>
          <div class="confirm-step">
            <span class="icon-badge"><?= icon('clock-circle-bold-duotone') ?></span>
            <div><b><?= t('order.confirm.step2') ?></b><p><?= t('order.confirm.step2desc') ?></p></div>
          </div>

          <div class="confirm-actions">
            <a href="#" id="confirmWaLink" target="_blank" rel="noopener" class="btn btn-whatsapp btn-lg"><?= icon('baseline-whatsapp') ?> <?= t('order.confirm.cta') ?></a>
            <?php if (MESSENGER_USERNAME !== ''): ?>
            <a href="#" id="confirmMessengerLink" target="_blank" rel="noopener" class="btn btn-messenger"><?= icon('messenger') ?> <?= t('order.confirm.cta_messenger') ?></a>
            <?php endif; ?>
            <a href="<?= $baseUrl ?>/#top" class="btn btn-outline-dark"><?= t('order.confirm.back') ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
