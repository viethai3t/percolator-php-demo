# percolator-php-demo
## step1: composerでelasticsearchライブラリーをインストールする。
composer install
## step2: commandで動きを確認する。
cd percolator-php-demo
1. インデックスと用意したデータを作成するために、以下のコマンドを叩く<br>
php index.php Percolator

2. percolatorでの検索の動きを確認する <br>
php index.php Percolator search

3. もし、インデックスを消したかったら、以下のコマンドを叩く<br>
php index.php Percolator delete

