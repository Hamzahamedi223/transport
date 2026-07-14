<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Lang;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->render('home/index', [
            'title'       => t('meta.title'),
            'description' => t('meta.description'),
        ]);
    }

    public function switchLang(): void
    {
        $code = $_GET['code'] ?? 'fr';
        Lang::set($code);

        $back = $_GET['back'] ?? (BASE_URL . '/');
        if (!str_starts_with($back, '/') && !str_starts_with($back, BASE_URL)) {
            $back = BASE_URL . '/';
        }
        $this->redirect($back);
    }
}
