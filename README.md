# wjinkaProj

## 構成
* app -> アプリケーション内容
* config -> 設定ファイル
* migrations -> データベースの構造定義
* seeds -> データベーステーブルの初期値
* start -> アプリケーションの初期化コード
* bootstrap
* vendor -> Composerでインストールされたパッケージのコード群
* .env -> 環境の設定が出来る、DBのpassとかもここ


## .env構成(ローカル)

* envはgit管理していないので、各自ローカルに合わせてパスを入力してください。

waseda_dbに関してはbitbucketログイン後、
https://bitbucket.org/wjinka/wjinka-portal/downloads
より。

APP_ENV=local
APP_DEBUG=true
APP_KEY="ランダムなString"

DB_HOST=localhost
DB_DATABASE=waseda_db
DB_USERNAME=root
DB_PASSWORD="mysqlのパス"

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null

## composerで何か入れたとき
* 例えば`composer require barryvdh/laravel-debugbar`
* `composer update`を打つ

