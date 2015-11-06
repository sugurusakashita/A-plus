//擬似クラス化
var barClass = (function(){
  var barClass = function(selector,data){
    this.selector = selector;
    this.data = data;
  }

  //プロトタイプ
  var p = barClass.prototype;

  p.barGraph = function barGraph(){
      //総和
    var sum = 0,
        max_id = 0,
        max_percent = 0;

    data = this.data;

      for(var i = 0;i < data.length;i++){
          sum += data[i]["value"];

          //最大のパーセントとそのIDを取得
          if(data[i]["value"] > max_percent){
            max_percent = data[i]["value"];
            max_id = i;
          }
      }

      //shema.css/col7 だとrectの最大width 280px
      data[max_id]["pix"] = 200;

      //valueにパーセントの値を入れる
      for(var j = 0; j < data.length; j++){
          if(j != max_id){
            //最大のバーを100%とした時のその他のピクセルを計算
            data[j]["pix"] =  data[max_id]["pix"] / (data[max_id]["value"] / data[j]["value"]);
          }
          //roundで小数点を丸めてパーセント化
          data[j]["percent"] = Math.round(data[j]["value"] / sum * 100);
      }
      // 棒グラフ
      var barHeight = 50;
      var w = '100%';
      var h = data.length * barHeight;
      var svg = d3.select(this.selector).append("svg").attr("width", w).attr("height", h);
      // グラフの追加
      var bar_chart = svg.selectAll("rect").data(data).enter().append("rect")
    .attr("height", "35")
    //width 280がmaxらしい。(shema.css/col7)比率を合わせる。
    .attr("width", 0)
    .attr("x", 100)
    .attr("y", function(d, i) { return i * barHeight; });
      // ラベルの表示
      svg.selectAll("text").data(data).enter().append("text")
    .attr("x", 0)
    .attr("y", function(d, i) { return i * barHeight + barHeight / 2; })
    .text(function(d) { return d["legend"]; });

      //パーセントの表示
      svg.selectAll("p").data(data).enter().append("text")
    .attr("x", function(d, i){ return d["pix"] / 2 + 80; })
    .attr("y", function(d, i) { return i * barHeight + barHeight / 2 - 1; })
    .text(function(d) { return d["percent"] + '%'; });

      // 棒グラフのスタイル
      svg.selectAll("rect").data(data)
    .attr("fill",
          function(d) {
            return d["color"];
          });

     //棒グラフアニメーション
     bar_chart.transition().delay(600).duration(1500)
    .attr("width",function(d, i){ return d["pix"]; });
  }

  p.tab_changed = function tab_changed(){
    data = this.data;

    var bar_chart = d3.select(this.selector).selectAll("rect").data(data).attr("width", 0);

    bar_chart.transition().delay(600).duration(1500)
    .attr("width",function(d, i){ return d["pix"]; });
  }

  return barClass;
})();



