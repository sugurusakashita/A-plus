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
  <div class="follow-us">
    <a class="twitter-timeline" href="https://twitter.com/waseda_Aplus" data-widget-id="640404274493587456">@waseda_Aplusさんのツイート</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    <div class="fb-like section-margin" data-width="100"></div>
  </div>

</div>
