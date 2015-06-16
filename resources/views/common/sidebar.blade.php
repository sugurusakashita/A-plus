<div class="sidebar">
  <div class="access_ranking" style="margin-bottom: 15px;">
    <div class="list-group">
      <a class="list-group-element active">アクセスランキング</a>
    <?php
      $i = 1;
      foreach ($data['access_ranking'] as $ranking) {
        // aタグにしてあるから工夫次第でリンク張れる
        // 今はtokenないからぶっ壊れてる
        echo "<a class='list-group-element' href=" . "./search?q=" . $ranking->class_name."'><span class='badge success'>". $i ."</span>　" . $ranking->class_name."</a>";
        $i++;
      }
    ?>
    </div>
  </div>

  <div class="search_word_ranking">
    <div class="list-group">
      <a class="list-group-element active">人気検索ワードランキング</a>
    <?php
      $i = 1;
      foreach ($data['search_ranking'] as $ranking) {
        echo "<a class='list-group-element'><span class='badge success'>". $i ."</span>　".$ranking->word."</a>";
        $i++;
      }
    ?>
    </div>
  </div>
</div>
