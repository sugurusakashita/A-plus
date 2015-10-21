# How to Test by PHPUnit

## 事始め

カレントディレクトリがアプリケーションルートの時
`./vendor/bin/phpunit`でテストコードを全て実行できる。

成功例は以下。

```
PHPUnit 4.8.8 by Sebastian Bergmann and contributors.

.

Time: 490 ms, Memory: 13.50Mb

OK (1 test, 1 assertion)
```

失敗例は以下

```
PHPUnit 4.8.8 by Sebastian Bergmann and contributors.

F

Time: 465 ms, Memory: 13.75Mb

There was 1 failure:

1) ExampleTest::testBasicExample
Failed asserting that 200 matches expected 201.

/Users/OzawaLab5th/Desktop/tmp/A-plus/tests/ExampleTest.php:14

FAILURES!
Tests: 1, Assertions: 1, Failures: 1.
```


## 事始め解説

`./tests/TestCase.php`はLaravelにおけるテストコードのRootClassみたいなもので、全てのテストコードはこのクラスを継承する。
いじってはならない。

`./tests/ExampleTest.php`が先ほど実行したテストである。

```
class ExampleTest extends TestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
    }

}
```

「`/`をGETした時のレスポンスコードが200と等しい時」テストは通る。

```
        $response = $this->call('GET', '/');

        $this->assertEquals(201, $response->getStatusCode());

```
や

```
        $response = $this->call('GET', '/echo');

        $this->assertEquals(200, $response->getStatusCode());

```
はテストは通らない。

## その他
### アサーション
`assertEquals`などをアサーションと呼び、沢山の種類が存在する。
必要に応じて使い分ける。
[PHPUnit マニュアル &#8211; 付録A アサーション](https://phpunit.de/manual/current/ja/appendixes.assertions.html)

### 継続的インテグレーション
今の環境だとTravis CIみたいなのを使うのがよくあるパターン

`git push`→Travis CIが勝手に動いてPHPUnitを実行してくれる→テストが通らなければエラーが吐かれる→実装がおかしい！！！みたいな感じ
pushするたびに動くから継続的？なのかな

導入するならこの辺参考
[Travis CIでPHPUnitをとにかく動かす最小構成](http://kanonji.info/blog/2013/08/26/travis-ci%E3%81%A7phpunit%E3%82%92%E3%81%A8%E3%81%AB%E3%81%8B%E3%81%8F%E5%8B%95%E3%81%8B%E3%81%99%E6%9C%80%E5%B0%8F%E6%A7%8B%E6%88%90/)
[Building a PHP project](http://docs.travis-ci.com/user/languages/php/)
