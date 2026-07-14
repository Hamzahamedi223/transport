<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Lang;
use App\Models\OrderModel;

class OrderController extends Controller
{
    public function store(): void
    {
        $name  = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        if ($name === '' || $phone === '') {
            $this->json(['success' => false, 'error' => 'missing_fields']);
        }

        $tripType = ($_POST['trip_type'] ?? 'simple') === 'double' ? 'double' : 'simple';
        $goods    = $_POST['goods_type'] ?? 'other';
        $goodsAllowed = ['moving', 'furniture', 'goods', 'parcel', 'other'];
        if (!in_array($goods, $goodsAllowed, true)) {
            $goods = 'other';
        }

        $data = [
            'name'           => $name,
            'phone'          => $phone,
            'trip_type'      => $tripType,
            'direction'      => $tripType === 'simple' ? (($_POST['direction'] ?? 'pickup') === 'deliver' ? 'deliver' : 'pickup') : null,
            'address'        => $tripType === 'simple' ? trim($_POST['address'] ?? '') : '',
            'from_address'   => $tripType === 'double' ? trim($_POST['from_address'] ?? '') : '',
            'to_address'     => $tripType === 'double' ? trim($_POST['to_address'] ?? '') : '',
            'goods_type'     => $goods,
            'preferred_date' => trim($_POST['preferred_date'] ?? ''),
            'notes'          => trim($_POST['notes'] ?? ''),
            'lang'           => Lang::code(),
        ];

        $orderId = OrderModel::create($data);

        $text = $this->buildTicketText($data);

        $this->json([
            'success'       => true,
            'order_id'      => $orderId,
            'whatsapp_url'  => 'https://wa.me/' . WHATSAPP_NUMBER . '?text=' . rawurlencode($text),
            'messenger_url' => MESSENGER_USERNAME !== '' ? ('https://m.me/' . MESSENGER_USERNAME . '?text=' . rawurlencode($text)) : null,
        ]);
    }

    private function buildTicketText(array $data): string
    {
        $goodsLabels = [
            'moving'    => t('order.goods.moving'),
            'furniture' => t('order.goods.furniture'),
            'goods'     => t('order.goods.goods'),
            'parcel'    => t('order.goods.parcel'),
            'other'     => t('order.goods.other'),
        ];

        $lines   = [];
        $lines[] = '🎫 *' . t('whatsapp.ticket_title') . '*';
        $lines[] = '';
        $lines[] = '👤 ' . $data['name'];
        $lines[] = '📞 ' . ltr_isolate($data['phone']);

        if ($data['trip_type'] === 'simple') {
            $direction = $data['direction'] === 'deliver' ? t('order.direction.deliver') : t('order.direction.pickup');
            $lines[]   = '🚚 ' . $direction;
            if ($data['address'] !== '') {
                $lines[] = '📍 ' . $data['address'];
            }
        } else {
            $from    = $data['from_address'] !== '' ? $data['from_address'] : t('order.value_missing');
            $to      = $data['to_address'] !== '' ? $data['to_address'] : t('order.value_missing');
            $lines[] = '🚚 ' . t('order.type.double');
            $lines[] = '📍 ' . $from . ' → ' . $to;
        }

        $lines[] = '📦 ' . ($goodsLabels[$data['goods_type']] ?? $data['goods_type']);

        if ($data['preferred_date'] !== '') {
            $lines[] = '📅 ' . ltr_isolate($data['preferred_date']);
        }
        if ($data['notes'] !== '') {
            $lines[] = '📝 ' . $data['notes'];
        }

        return implode("\n", $lines);
    }
}
