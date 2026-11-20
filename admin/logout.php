<?php
/**
 * Ottoman Palace Restaurant - Admin logout
 */

declare(strict_types=1);

require_once __DIR__ . '/auth.php';

start_admin_session();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Method Not Allowed');
}

$submittedToken = isset($_POST['csrf_token']) && is_string($_POST['csrf_token'])
    ? $_POST['csrf_token']
    : null;

if (!verify_admin_csrf_token($submittedToken)) {
    http_response_code(403);
    exit('Invalid request.');
}

destroy_admin_session();

header('Location: login.php');
exit;
