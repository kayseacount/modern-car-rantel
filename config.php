<?php
declare(strict_types=1);
session_start();

const DB_HOST = '127.0.0.1';
const DB_NAME = 'modern_car_rent';
const DB_USER = 'root';
const DB_PASS = ''; // Change this if your MySQL root account has a password.

function db(): PDO {
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
}
function h(?string $value): string { return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8'); }
function redirect(string $path): never { header('Location: ' . $path); exit; }
function current_user(): ?array { return $_SESSION['user'] ?? null; }
function require_login(): array {
    $u = current_user();
    if (!$u) redirect('login.php');
    return $u;
}
function require_role(string $role): array {
    $u = require_login();
    if ($u['role'] !== $role) redirect($u['role'] === 'admin' ? 'admin.php' : 'dashboard.php');
    return $u;
}
function csrf_token(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}
function verify_csrf(): void {
    $token = $_POST['csrf'] ?? '';
    if (!hash_equals($_SESSION['csrf'] ?? '', $token)) {
        http_response_code(419); exit('Invalid security token. Refresh and try again.');
    }
}
function flash(string $message, string $type='success'): void { $_SESSION['flash'] = [$message, $type]; }
function show_flash(): void {
    if (!empty($_SESSION['flash'])) {
        [$message, $type] = $_SESSION['flash']; unset($_SESSION['flash']);
        echo '<div class="alert alert-' . h($type) . ' alert-dismissible fade show">' . h($message) .
             '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
    }
}
function money(float|int|string $amount): string { return '$' . number_format((float)$amount, 2); }
function booking_days(string $start, string $end): int {
    $a = new DateTimeImmutable($start); $b = new DateTimeImmutable($end);
    return max(1, (int)$a->diff($b)->format('%a'));
}
