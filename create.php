<?php
// 新規登録処理
if ($_POST['action'] == 'register' && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    // データ保存フォルダの確認と作成
    $dataFolder = __DIR__ . '/data/';
    if (!file_exists($dataFolder)) {
        mkdir($dataFolder, 0777, true);
    }

    // CSVファイルに新規ユーザーを追加
    $csvFile = $dataFolder . 'users.csv';
    $entry = [date('Y-m-d H:i:s'), $_POST['username'], $_POST['email'], $_POST['password']];
    $handle = fopen($csvFile, 'a');
    fputcsv($handle, $entry);
    fclose($handle);

    // セッションを開始し、ユーザー情報を保存
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['email'] = $_POST['email'];

    // クイズページにリダイレクト
    echo "<script>window.location = 'quiz.php';</script>";
}
