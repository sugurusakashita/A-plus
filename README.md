![A+plus](https://ei-plus.com/image/top/top-main.gif)

# A+plus
* released on Sep. 12th

## 構成
* app -> アプリケーション内容
* config -> 設定関連
* migrations -> データベースの構造定義
* seeds -> データベーステーブルの初期値
* bootstrap -> bootstrap関連
* vendor -> Composerでインストールされたパッケージのコード群
* .env -> 環境の設定が出来る、DBのpassとかもここ


## .env構成(ローカル)

* envはgit管理していないので、各自ローカルに合わせてパスを入力してください。


## インストール方法(for A+plus member)

* Laravel5.0が動く環境をつくりましょう。
* http://readouble.com/laravel/5/0/0/ja/installation.html (公式)

* お好みの階層でgit cloneします
* project root直下でcomposer installでproject rootにvendorファイルを作ります
* .env.sampleファイルがあるので、コピーして.envにリネームします
* project root直下で、php artisan key:generate でキーを作ります
* .envにローカルのDB情報を書いておきます(host,username,pass,DBname)
* /storageと/vendorディレクトリにサーバーの書き込み権限を与えます
* 例) project rootにて  chmod -R 777 storage/ 
* /public 以下にアクセスで表示。バーチャルホストなどで、ルートにアクセスしたら/publicにアクセスするように変更しましょう




