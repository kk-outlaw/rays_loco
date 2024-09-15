<?php
//影を文字からどれだけずらすか
$gap = empty($_GET['gap']) ? 4 : intval($_GET['gap']);

//フォントサイズ
$font_size = empty($_GET['font_size']) ? 128 : intval($_GET['font_size']);
//テキストの角度
$text_angle = 0;
//フォントのパス：絶対パスで指定
$font_file_name = realpath('../../') . '/rays_logo/NotoSerifJP-ExtraBold.ttf';

//画像の左上からのマージン
$mergin_x = $font_size / 2;
$mergin_y = $font_size / 2;

//ロゴにするテキスト
$text = empty($_GET['text']) ? "TB" : mb_substr($_GET['text'], 0, 24);

//描画領域の座標を取得し、画像サイズの計算に使用する
$bounding_box = imagettfbbox(
    $font_size,
    $text_angle,
    $font_file_name,
    $text
    //PHP8.0では引数にarray $options = []が追加されている
);

//画像サイズ
$canvas_width = $mergin_x * 2 + $bounding_box[2] - $bounding_box[0];
$canvas_height = $mergin_y * 2 + $bounding_box[1] - $bounding_box[5];

//キャンバスとなる空のイメージ
$image = imagecreatetruecolor($canvas_width, $canvas_height);

//背景色: 0C3261
$background_color = imagecolorallocate($image, 12, 50, 97);
//文字色: FFFFFF
$foreground_color = imagecolorallocate($image, 255, 255, 255);
//影の色: 90BCE8
$shadow_color = imagecolorallocate($image, 144, 188, 232);

//画像を背景色で塗りつぶす
imagefilledrectangle($image, 0, 0, $canvas_width, $canvas_height, $background_color);

//影を先に書き込む
imagettftext(
    $image,
    $font_size,
    $text_angle,
    $mergin_x + $gap,
    $mergin_y + $gap + $font_size, //Y軸は文字の下が規準
    $shadow_color,
    $font_file_name,
    $text
    //PHP8.0ではoptions = []パラメータが最後に追加されている
);
  
//影の上に白い文字を書き込む
imagettftext(
    $image,
    $font_size,
    $text_angle,
    $mergin_x,
    $mergin_y + $font_size,
    $foreground_color,
    $font_file_name,
    $text
);

//画像を出力する前に明示的にレスポンスヘッダを出力する
header("Content-Type: image/png");
header('Content-Disposition: inline; filename="logo.png"');

//PNGイメージでストリーム出力
imagepng($image, null, -1, -1);

//後処理
imagedestroy($image);
?>