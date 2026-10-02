<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>メモ帳</title>
    <style></style>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/menu.css">
</head>

<body>
<nav class="menu_nav">
    <ul class="menu_ul">
        <li class="menu_li"><a href="index.php">ホーム</a></li>

        <?php
            if (!isset($_SESSION['type'])) {
                echo "<li class='menu_li'><a href='login.php'>ログイン</a></li>";
            }
            else {
                echo "<li class='menu_li'><a href='logout.php'>ログアウト</a></li>";
            }
        ?>
    </ul>
    <ul class="menu_ul" style="margin-left: auto; margin-right: 10px;">
        <li class="menu_li">
            ログイン状態：
            <?php
                if (!isset($_SESSION['type'])) {
                    echo "未ログイン";
                }
                else {
                    echo "ログイン済み(" . $_SESSION['type'] . ")";
                }
            ?>
        </li>
    </ul>
</nav>

</body>
