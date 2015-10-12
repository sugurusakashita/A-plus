<div class="sidebar">
  <div class="access_ranking" style="margin-bottom: 15px;">
    <div class="list-group">
      <a class="list-group-element active">アクセスランキング</a>
    <?php
      $i = 1;
      //金、銀、銅
      $rank_colors = array("#E0CB42","#B3B3B3","#D69828");
      foreach ($access_ranking as $ranking) {
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
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- side-bar ad -->
  <ins class="adsbygoogle"
       style="display:block"
       data-ad-client="ca-pub-6701768269365502"
       data-ad-slot="1444343877"
       data-ad-format="auto"></ins>
  <script>
  (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
  <div class="follow-us">
    <div class="fb-page" data-href="https://www.facebook.com/waseda.Aplus" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/waseda.Aplus"><a href="https://www.facebook.com/waseda.Aplus">早稲田大学アプリ開発サークル A+plus</a></blockquote></div></div>
    <a class="twitter-timeline" href="https://twitter.com/waseda_Aplus" data-widget-id="640404274493587456" width="100%">@waseda_Aplusさんのツイート</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
  </div>

</div>
