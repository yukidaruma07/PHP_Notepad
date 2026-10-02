<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>メモ帳</title>
    <style>
        .form {
            margin-top: 50px;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            height: 200px;
            background: #2a2a2c;
            border-radius: 10px;
        }

        .input {
            margin-left: auto;
            margin-right: auto;
            width: 75%;
            display: flex;
        }

        .label {
            font-family: "Noto Sans JP Black", serif;
            color: white;
            margin-left: auto;
            margin-right: auto;
            width: 75%;
            display: flex;
        }

        .button {
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
            display: flex;
        }
    </style>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/menu.css">
</head>

<body>
<nav class="menu_nav">
    <ul class="menu_ul">
        <li class="menu_li"><a href="index.php">ホーム</a></li>
        <li class="menu_li"><a href="">ログイン</a></li>
    </ul>
</nav>

<form method="post" action="loginpost.php" class="form">
    <label class="label">メールアドレス</label>
    <input class="input" type="text" name="loginemail" readonly>

    <label class="label">パスワード</label>
    <input class="input" type="password" name="loginpassword" readonly>

    <button class="button">ログイン</button>

    <button class="button" name="githublogin">Githubでログイン</button>
</form>

</body>
