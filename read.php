<?php
// ログイン処理
session_start();

// データ保存フォルダとCSVファイルの確認
$dataFolder = __DIR__ . '/data/';
$csvFile = $dataFolder . 'users.csv';

if ($_POST['action'] == 'login' && !empty($_POST['email']) && !empty($_POST['password'])) {
    if (($handle = fopen($csvFile, 'r')) !== FALSE) {
        // CSVファイルを読み込み、ユーザー情報を確認
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($data[2] == $_POST['email'] && $data[3] == $_POST['password']) {
                // ログイン成功時、セッションにユーザー情報を保存
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $data[1];
                $_SESSION['email'] = $_POST['email'];
                echo "<script>window.location = 'quiz.php';</script>";
                fclose($handle);
                return;
            }
        }
        fclose($handle);
    }
    echo "ログイン失敗：無効なユーザー名またはパスワード。";
}
