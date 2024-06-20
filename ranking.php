<?php
// スコアの読み込みとソート
$scores = [];
$dataFolder = __DIR__ . '/data/';
$csvFile = $dataFolder . 'scores.csv';

if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $scores[] = $data;
    }
    fclose($handle);
}

// スコアを降順にソート
usort($scores, function ($a, $b) {
    return $b[2] - $a[2];
});
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>バカチン★PHPクイズ</title>
    <link rel="stylesheet" href="style.css">
    <!-- Googleフォント読込 -->
    <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
</head>

<body>
    <!-- ページのタイトル -->
    <h1>バカチン<span>★</span>PHPクイズ</h1>

    <!-- ランキングコンテナ -->
    <div class="ranking-container">
        <h2>歴代ランキング</h2>
        <table>
            <thead>
                <tr>
                    <th>日時</th>
                    <th>ユーザー名</th>
                    <th>スコア</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($scores as $score) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($score[0]); ?></td>
                        <td><?php echo htmlspecialchars($score[1]); ?></td>
                        <td><?php echo htmlspecialchars($score[2]); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="ranking-link">ホームに戻る</a>
    </div>
</body>

</html>