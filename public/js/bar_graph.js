function barGraph(data){

    //総和
    var sum = 0;
    for(var i = 0;i < data.length;i++){
        sum += data[i]["value"];
    }
    
    //valueにパーセントの値を入れる
    for(var i = 0;i < data.length;i++){
        //roundで小数点を丸めてパーセント化
        data[i]["percent"] = Math.round(data[i]["value"] / sum * 100);
    }

    // 棒グラフ
    var barHeight = 50;
    var w = 600;
    var h = data.length * barHeight;
    var svg = d3.select("#attendance_bar_graph").append("svg").attr("width", w).attr("height", h);
    // グラフの追加
    svg.selectAll("rect").data(data).enter().append("rect")
  .attr("height", "35")
  //width 220がmaxらしい。比率を合わせる。
  .attr("width", function(d) { return d["percent"] * 2.2; })
  .attr("x", 100)
  .attr("y", function(d, i) { return i * barHeight; });
    // ラベルの表示
    svg.selectAll("text").data(data).enter().append("text")
  .attr("x", 0)
  .attr("y", function(d, i) { return i * barHeight + barHeight / 2; })
  .text(function(d) { return d["legend"]; });

    //パーセントの表示
    svg.selectAll("p").data(data).enter().append("text")
    //100pxが始点。(d["percent"] * 2.2　+ 100)pxが終点。
  .attr("x", function(d){ return d["percent"] * 1.1 + 85 })
  .attr("y", function(d, i) { return i * barHeight + barHeight / 2 - 1; })
  .text(function(d) { return d["percent"] + "\%"; });

    // 棒グラフのスタイル
    svg.selectAll("rect").data(data)
  .attr("fill",
        function(d) {
      // return "rgb(0, " + Math.min(255, d["value"]) + ", " + Math.min(255, d["value"] * 2) + ")";
      return d["color"];
        });
}

barGraph(attendance_data);

