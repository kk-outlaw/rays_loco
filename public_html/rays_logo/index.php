<?php
$text = empty($_GET['text']) ? "TB" : mb_substr($_GET['text'], 0, 24);
$gap = empty($_GET['gap']) ? 4 : intval($_GET['gap']);
$font_size = empty($_GET['font_size']) ? 128 : intval($_GET['font_size']);

$has_parameters = !empty($_GET['text']) && !empty($_GET['gap']) && !empty($_GET['font_size']);

$tweet_button = '<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a>';
$tweet_script = '<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>';

    echo <<<HEADER
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>タンパベイ・レイズ風ロゴジェネレータ</title>
  <link rel="icon" href="icon.png">
  <style>
    div.form_grid {
      display: grid;
      grid: 32px 32px 32px 32px / 300px 400px;
    }
  </style>
  {$tweet_script}
</head>
HEADER;

echo '<body>';
echo '<h3>タンパベイ・レイズ風ロゴジェネレータ</h3><br>';
echo <<<INPUT_FORM
<form id="options" method="GET" action="index.php" target="_self">
  <div class="form_grid">
    <div>ロゴにしたい文字列(24文字まで)</div>
    <div><input type="text" name="text" value="$text" maxlength="24" minlength="1" size="48"></div>
    <div>影のずれ(2ケタまでの数字)</div>
    <div><input type="text" name="gap" value="$gap" maxlength="2" minlength="1" size="4" pattern="[1-9][0-9]?"></div>
    <div>フォントの大きさ(3ケタまでの数字)</div>
    <div><input type="text" name="font_size" value="$font_size" maxlength="3" minlength="1" size="6" pattern="[1-9][0-9]?[0-9]?"></div>
    <div></div>
    <div><input type="submit" text="送信"></div>
  </div>
</form>
INPUT_FORM;

echo '<hr>';
echo '<a href="about.html">このサイトについて</a>';
echo '<hr>';

if($has_parameters) {
    $img_url = sprintf("rays_logo.php?text=%s&gap=%s&font_size=%s", $text, $gap, $font_size);
    echo "<img src=\"$img_url\">";
    echo '<br>';
    echo $tweet_button;
}

echo '</body>';
?>