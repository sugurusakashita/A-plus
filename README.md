![A+plus](http://www.shalm.red/Aplus_logo_trans@1x.png)

# A+plus
* work in progress...

## 構成
* app -> アプリケーション内容
* config -> 設定関連
* migrations -> データベースの構造定義
* seeds -> データベーステーブルの初期値
* start -> アプリケーションの初期化コード
* bootstrap -> bootstrap関連
* vendor -> Composerでインストールされたパッケージのコード群
* .env -> 環境の設定が出来る、DBのpassとかもここ


## .env構成(ローカル)

* envはgit管理していないので、各自ローカルに合わせてパスを入力してください。

## composerで何か入れたとき
* 例えば`composer require barryvdh/laravel-debugbar`
* `composer update`を叩く
