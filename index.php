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

<?php
    if (!isset($_SESSION['type'])) {
        exit;
    }

$env = require __DIR__ . '/loginenv.php';
$pdo = new PDO(
        "mysql:host={$env['db_host']};dbname={$env['db_name']};charset=utf8mb4",
        $env['db_user'],
        $env['db_password']
);

$stmt = $pdo->prepare("SELECT id,textData,createdDate FROM `notepad`;");
$stmt->execute();

$dbData = $stmt->fetchAll();
?>

<table>
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">メモ内容</th>
            <th scope="col">作成時間</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($dbData as $data) {
                echo "<tr>";
                echo "<th scope='row'>" . $data['id'] . "</th>";
                echo "<th>" . $data['textData'] . "</th>";
                echo "<th>" . $data['createdDate'] . "</th>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>


</body>
