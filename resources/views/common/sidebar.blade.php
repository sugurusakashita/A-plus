<div class="sidebar">
  <div>
    <a href="/campaign/index/1"><img class="sidebar-logo" src="/image/campaign/event1-sm.png"></a>
  </div>
  <div class="access_ranking" style="margin-bottom: 15px;">
    <div class="list-group">
      <a class="list-group-element active">アクセスランキング</a>
    <?php
      $i = 1;
      //金、銀、銅
      $rank_colors = array("#E0CB42","#B3B3B3","#D69828");
      foreach ($data['access_ranking'] as $ranking) {
        echo "<a class='list-group-element' href=/classes/index/".$ranking->class_id.">";
        if($i < 4){
          echo "<span class='icon-trophy sidebar-icon' style='color:".$rank_colors[$i-1]."'></span>　";
        }else{
           echo "<span class='badge success'>".$i."</span>　";
        }
        echo $ranking->class_name."</a>";
        $i++;
      }
    ?>
    </div>
  </div>

</div>
