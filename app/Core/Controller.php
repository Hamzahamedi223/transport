<?php
namespace App\Core;

class Controller
{
    protected function render(string $view, array $data = []): void
    {
        $VIEWS    = dirname(__DIR__) . '/Views';
        $viewPath = $VIEWS . '/' . $view . '.php';
        $baseUrl  = BASE_URL;
        extract($data);

        if (!file_exists($viewPath)) {
            http_response_code(404);
            $title = '404 — Page introuvable | ' . APP_NAME;
            include $VIEWS . '/layouts/header.php';
            include $VIEWS . '/errors/404.php';
            include $VIEWS . '/layouts/footer.php';
            return;
        }

        include $VIEWS . '/layouts/header.php';
        include $viewPath;
        include $VIEWS . '/layouts/footer.php';
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    protected function json(array $data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
