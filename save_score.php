<?php
// スコア保存処理
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // データ保存フォルダの確認と作成
    $dataFolder = __DIR__ . '/data/';
    if (!file_exists($dataFolder)) {
        mkdir($dataFolder, 0777, true);
    }

    // スコアをCSVファイルに保存
    $csvFile = $dataFolder . 'scores.csv';
    $entry = [date('Y-m-d H:i:s'), $_POST['username'], $_POST['score']];
    $handle = fopen($csvFile, 'a');
    fputcsv($handle, $entry);
    fclose($handle);
}
