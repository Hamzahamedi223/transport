<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Lang;
use App\Models\OrderModel;

class AdminController extends Controller
{
    private const AUTH_COOKIE = 'zt_admin';

    public function loginForm(): void
    {
        if ($this->isAdmin()) {
            $this->redirect(BASE_URL . '/admin');
        }

        $this->render('admin/login', [
            'title' => 'Connexion admin — ' . APP_NAME,
            'error' => $_GET['error'] ?? null,
        ]);
    }

    public function login(): void
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $validUser = hash_equals($_ENV['ADMIN_USERNAME'] ?? '', $username);
        $validPass = password_verify($password, $_ENV['ADMIN_PASSWORD_HASH'] ?? '');

        if ($validUser && $validPass) {
            $_SESSION['admin'] = true;
            $this->setAdminCookie($username);
            $this->redirect(BASE_URL . '/admin');
        }

        $this->redirect(BASE_URL . '/admin/login?error=1');
    }

    public function logout(): void
    {
        unset($_SESSION['admin']);
        $this->clearAdminCookie();
        $this->redirect(BASE_URL . '/admin/login');
    }

    public function dashboard(): void
    {
        $this->requireAdmin();

        $status   = $_GET['status'] ?? '';
        $requests = OrderModel::all($status ?: null);
        $counts   = OrderModel::counts();

        foreach ($requests as &$row) {
            $row['wa_confirm_url'] = $this->buildClientWhatsappUrl($row);
        }
        unset($row);

        $this->render('admin/dashboard', [
            'title'    => 'Tableau de bord — ' . APP_NAME,
            'requests' => $requests,
            'counts'   => $counts,
            'status'   => $status,
        ]);
    }

    public function updateStatus(): void
    {
        $this->requireAdmin();

        $id     = (int) ($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? '';

        if ($id > 0) {
            OrderModel::updateStatus($id, $status);
        }

        $back = $_POST['back'] ?? (BASE_URL . '/admin');
        $this->redirect($back);
    }

    private function requireAdmin(): void
    {
        if (!$this->isAdmin()) {
            $this->redirect(BASE_URL . '/admin/login');
        }
    }

    private function isAdmin(): bool
    {
        if (!empty($_SESSION['admin'])) {
            return true;
        }

        $cookie = $_COOKIE[self::AUTH_COOKIE] ?? '';
        if ($cookie === '' || !str_contains($cookie, '.')) {
            return false;
        }

        [$payload, $signature] = explode('.', $cookie, 2);
        $expected = hash_hmac('sha256', $payload, $this->authSecret());
        if (!hash_equals($expected, $signature)) {
            return false;
        }

        $data = json_decode(base64_decode($payload, true) ?: '', true);
        if (!is_array($data)) {
            return false;
        }

        if (($data['exp'] ?? 0) < time()) {
            return false;
        }

        if (($data['user'] ?? '') !== ($_ENV['ADMIN_USERNAME'] ?? '')) {
            return false;
        }

        $_SESSION['admin'] = true;
        return true;
    }

    private function setAdminCookie(string $username): void
    {
        $expires = time() + (60 * 60 * 12);
        $payload = base64_encode(json_encode([
            'user' => $username,
            'exp'  => $expires,
        ]));
        $signature = hash_hmac('sha256', $payload, $this->authSecret());

        setcookie(self::AUTH_COOKIE, $payload . '.' . $signature, [
            'expires'  => $expires,
            'path'     => '/',
            'secure'   => $this->isHttps(),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    private function clearAdminCookie(): void
    {
        setcookie(self::AUTH_COOKIE, '', [
            'expires'  => time() - 3600,
            'path'     => '/',
            'secure'   => $this->isHttps(),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    private function authSecret(): string
    {
        return $_ENV['APP_KEY'] ?? $_ENV['ADMIN_PASSWORD_HASH'] ?? APP_NAME;
    }

    private function isHttps(): bool
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
    }

    private function buildClientWhatsappUrl(array $row): string
    {
        $lang = $row['lang'] ?: 'fr';

        $goodsLabels = [
            'moving'    => Lang::tIn($lang, 'order.goods.moving'),
            'furniture' => Lang::tIn($lang, 'order.goods.furniture'),
            'goods'     => Lang::tIn($lang, 'order.goods.goods'),
            'parcel'    => Lang::tIn($lang, 'order.goods.parcel'),
            'other'     => Lang::tIn($lang, 'order.goods.other'),
        ];

        $lines   = [];
        $lines[] = str_replace('{name}', $row['name'], Lang::tIn($lang, 'admin.confirm_intro'));
        $lines[] = '';

        if ($row['trip_type'] === 'simple') {
            $direction = $row['direction'] === 'deliver' ? Lang::tIn($lang, 'order.direction.deliver') : Lang::tIn($lang, 'order.direction.pickup');
            $lines[]   = '🚚 ' . $direction;
            if (!empty($row['address'])) {
                $lines[] = '📍 ' . $row['address'];
            }
        } else {
            $from    = $row['from_address'] ?: Lang::tIn($lang, 'order.value_missing');
            $to      = $row['to_address'] ?: Lang::tIn($lang, 'order.value_missing');
            $lines[] = '📍 ' . $from . ' → ' . $to;
        }

        $lines[] = '📦 ' . ($goodsLabels[$row['goods_type']] ?? $row['goods_type']);
        if (!empty($row['preferred_date'])) {
            $lines[] = '📅 ' . ltr_isolate($row['preferred_date']);
        }

        $lines[] = '';
        $lines[] = Lang::tIn($lang, 'admin.confirm_outro');

        $text = implode("\n", $lines);

        return 'https://wa.me/' . whatsapp_number($row['phone']) . '?text=' . rawurlencode($text);
    }
}
