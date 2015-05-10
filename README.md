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

## composerで何か入れたとき
* 例えば`composer require barryvdh/laravel-debugbar`
* `composer update`を打つ
