<?php
session_start();

$env = require __DIR__ . '/loginenv.php';
if ($_SESSION['type'] == 'Github') {
    $curl = curl_init('https://github.com/login/oauth/access_token');
    curl_setopt_array($curl, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query([
            'client_id' => $env['github_client_id'],
            'client_secret' => $env['github_client_secret'],
            'code' => $_GET['code']
        ]),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Accept: application/json'
        ]
    ]);
    $response = curl_exec($curl);
    $json = json_decode($response, true);
    $accessToken = $json['access_token'];
    //var_dump($json);

    $curl = curl_init('https://api.github.com/user');
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $accessToken,
            'Accept: application/json',
            'User-Agent: test',
        ]
    ]);
    $response = curl_exec($curl);
    $json = json_decode($response, true);
    //var_dump($json);
    $_SESSION['username'] = $json['login'];

    if (!isset($json['login'])) {
        echo "問題が発生しました。やり直してください。";
    }
    else {
        header('Location: index.php');
        exit;
    }

}
else {
    echo "未対応のログイン方式です。";
}