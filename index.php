<?php
session_start();

$env = require __DIR__ . '/loginenv.php';
$pdo = new PDO(
        "mysql:host={$env['db_host']};dbname={$env['db_name']};charset=utf8mb4",
        $env['db_user'],
        $env['db_password']
);
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['inputkey'] != "") {
    $inputKey = $_POST['inputkey'];

    $stmt = $pdo->prepare("INSERT INTO notepad (textData, createdDate, updateDate, username) VALUES (:textData, CURRENT_TIMESTAMP , CURRENT_TIMESTAMP, :name);");
    $stmt->execute([':textData'=> $inputKey, ':name' => $_SESSION['username']]);

    $_POST['inputkey'] = "";

    header('Location: index.php');
    exit;
}
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

    $stmt = $pdo->prepare("SELECT id,textData,createdDate FROM `notepad` where username = :name;");
    $stmt->execute([':name' => $_SESSION['username']]);

    $dbData = $stmt->fetchAll();
?>

<div style="margin: 50px;">
    <table style="margin-left: auto; margin-right: auto;">
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

    <form style="display: flex;" action="" method="post">
        <input style="margin-left: auto;" name="inputkey" type="text">
        <button style="margin-right: auto;">作成</button>
    </form>

</div>

</body>
