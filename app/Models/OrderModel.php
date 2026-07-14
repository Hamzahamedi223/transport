<?php
namespace App\Models;

use App\Core\Database;

class OrderModel
{
    public static function create(array $data): int
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'INSERT INTO demandes
                (name, phone, trip_type, direction, address, from_address, to_address, goods_type, preferred_date, notes, lang, created_at)
             VALUES
                (:name, :phone, :trip_type, :direction, :address, :from_address, :to_address, :goods_type, :preferred_date, :notes, :lang, NOW())'
                . ' RETURNING id'
        );

        $stmt->execute([
            'name'           => $data['name'],
            'phone'          => $data['phone'],
            'trip_type'      => $data['trip_type'],
            'direction'      => $data['direction'] ?: null,
            'address'        => $data['address'] ?: null,
            'from_address'   => $data['from_address'] ?: null,
            'to_address'     => $data['to_address'] ?: null,
            'goods_type'     => $data['goods_type'],
            'preferred_date' => $data['preferred_date'] ?: null,
            'notes'          => $data['notes'] ?: null,
            'lang'           => $data['lang'],
        ]);

        return (int) $stmt->fetchColumn();
    }

    public static function all(?string $status = null): array
    {
        $pdo = Database::getConnection();

        if ($status !== null && $status !== '') {
            $stmt = $pdo->prepare('SELECT * FROM demandes WHERE status = ? ORDER BY created_at DESC');
            $stmt->execute([$status]);
        } else {
            $stmt = $pdo->query('SELECT * FROM demandes ORDER BY created_at DESC');
        }

        return $stmt->fetchAll();
    }

    public static function counts(): array
    {
        $pdo  = Database::getConnection();
        $rows = $pdo->query('SELECT status, COUNT(*) as c FROM demandes GROUP BY status')->fetchAll();

        $counts = ['new' => 0, 'contacted' => 0, 'confirmed' => 0, 'done' => 0];
        foreach ($rows as $row) {
            $counts[$row['status']] = (int) $row['c'];
        }
        $counts['all'] = array_sum($counts);

        return $counts;
    }

    public static function updateStatus(int $id, string $status): void
    {
        $allowed = ['new', 'contacted', 'confirmed', 'done'];
        if (!in_array($status, $allowed, true)) {
            return;
        }

        $pdo  = Database::getConnection();
        $stmt = $pdo->prepare('UPDATE demandes SET status = ? WHERE id = ?');
        $stmt->execute([$status, $id]);
    }
}
