# rays_logo
Generate images like the Tampa Bay Rays logo.

タンパベイ・レイズ風ロゴジェネレータ

メジャーリーグベースボールのタンパベイ・レイズのロゴに似た画像を生成するツールです。
PHP7+GDライブラリで実装しています。
実行にはフォント(.ttfファイル)をfontディレクトリに配置し、フォントのファイル名をindex.phpで指定する必要があります。
デフォルトではNoto Serif Japanese(https://fonts.google.com/noto/specimen/Noto+Serif+JP)のNotoSerifJP-ExtraBold.ttfを参照するようになっています。

ディレクトリ構成
./
├─public_html/
│  └─rays_logo/　スクリプト本体、マニュアル等を配置します。
└─rays_logo/　　　フォントのファイルを配置します。
