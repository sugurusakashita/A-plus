function barGraph(data){

    //総和
    var sum = 0;
   var max_id = 0,
        max_percent = 0;
    for(var i = 0;i < data.length;i++){
        sum += data[i]["value"];

        //最大のパーセントとそのIDを取得
        if(data[i]["value"] > max_percent){
          max_percent = data[i]["value"];
          max_id = i;
        }        
    }
    //shema.css/col7 だとrectの最大width 280px
    data[max_id]["pix"] = 280;
      
 
    //valueにパーセントの値を入れる
    for(var i = 0;i < data.length;i++){
        

        if(i != max_id){
          //最大のバーを100%とした時のその他のピクセルを計算
          data[i]["pix"] =  data[max_id]["pix"] / (data[max_id]["value"] / data[i]["value"]);
        }
        //roundで小数点を丸めてパーセント化
        data[i]["percent"] = Math.round(data[i]["value"] / sum * 100);

 
    }
    

    // 棒グラフ
    var barHeight = 50;
    var w = 600;
    var h = data.length * barHeight;
    var svg = d3.select("#attendance_bar_graph").append("svg").attr("width", w).attr("height", h);
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
    
  .attr("x", function(d, i){ return d["pix"] / 2 + 85 })
  .attr("y", function(d, i) { return i * barHeight + barHeight / 2 - 1; })
  .text(function(d) { return d["percent"] + "\%"; });

    // 棒グラフのスタイル
    svg.selectAll("rect").data(data)
  .attr("fill",
        function(d) {
      // return "rgb(0, " + Math.min(255, d["value"]) + ", " + Math.min(255, d["value"] * 2) + ")";
      return d["color"];
        });

   //棒グラフアニメーション
   bar_chart.transition().delay(1000).duration(1000)
  .attr("width",function(d, i){ return d["pix"]; });
}

barGraph(attendance_data);

