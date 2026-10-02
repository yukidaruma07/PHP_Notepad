<?php
session_start();

if (isset($_POST['githublogin'])) {
    $env = require __DIR__ . '/loginenv.php';
    $params = [
        'client_id' => $env['github_client_id'],
        'redirect_url' => 'http://localhost:25565/loginredirect.php',
        'scope' => 'read:user user:email',
        'state' => bin2hex(random_bytes(64))
    ];

    $build_url = 'http://github.com/login/oauth/authorize?' . http_build_query($params);

    $_SESSION['state'] = $params['state'];
    $_SESSION['type'] = "Github";
    header('Location: ' . $build_url);

    exit;
}
else {
    echo "ログインすることはできません。";
}