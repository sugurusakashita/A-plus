
//擬似クラス化
var pieClass = (function(){

  // original source from http://webdesign-dackel.com/
  var arc   = d3.svg.arc().innerRadius(40);

  // アニメーション終了の判定フラグ
  var isAnimated = false;

  //コンストラクタモドキ
  var pieClass = function(arg){
    // サイズを設定　ウィンドウサイズによって可変する
    this.size = {
      width : 100,
      height: 100
    };

    // d3用の変数
    //リサイズイベントの設定に使用します
    this.win = d3.select(window);
    this.svg = d3.select(arg);
    this.pie = d3.layout.pie().sort(null).value(function(d){ return d.value; });
  }

  //プロトタイプ
  var p = pieClass.prototype;

  // グラフの描画
  // 描画処理に徹して、サイズに関する情報はupdate()内で調整する。
  p.render = function render(data){

    // グループの作成
    var g = this.svg.selectAll(".arc")
      .data(this.pie(data))
      .enter()
      .append("g")
        .attr("class", "arc");

    // 円弧の作成
    g.append("path")
      .attr("stroke", "white")
      .attr("fill", function(d){ return d.data.color; });

    // データの表示
    var maxValue = d3.max(data,function(d){ return d.value; });

    g.append("text")
      .attr("dy", ".35em")
      .attr("font-this.size", function(d){ return d.value / maxValue * 20; }) //最大のサイズを20に
      .style("text-anchor", "middle")
      .text(function(d){ return d.data.legend+"  "+d.data.value+"%"; });
  }


  // グラフのサイズを更新
  p.update = function update(){

    // 自身のサイズを取得する
    this.size.width = parseInt(this.svg.style("width"));
    this.size.height = parseInt(this.svg.style("height")); //←取得はしていますが、使用していません...

    // 円グラフの外径を更新
    arc.outerRadius(this.size.width / 2);

    // 取得したサイズを元に拡大・縮小させる
    this.svg
      .attr("width", this.size.width)
      .attr("height", this.size.width);

    // それぞれのグループの位置を調整
    var g = this.svg.selectAll(".arc")
      .attr("transform", "translate(" + (this.size.width / 2) + "," + (this.size.width / 2) + ")");

    // パスのサイズを調整
    // アニメーションが終了していない場合はサイズを設定しないように
    if( isAnimated ){
      g.selectAll("path").attr("d", this.arc);
    }

    // テキストの位置を再調整
    g.selectAll("text").attr("transform", function(d){ return "translate(" + arc.centroid(d) + ")"; });
  }


  // グラフのアニメーション設定
  p.animate = function animate(data){
    var g = this.svg.selectAll(".arc"),
        length = data.length,
        i = 0;

    g.selectAll("path")
      .transition()
      .ease("cubic-out")
      .delay(500)
      .duration(1000)
      .attrTween("d", function(d){
        var interpolate = d3.interpolate(
          {startAngle: 0, endAngle: 0},
          {startAngle: d.startAngle, endAngle: d.endAngle}
        );
        return function(t){
          return arc(interpolate(t));
        };
      })
      .each("end", function(transition, callback){
        i++;
        isAnimated = i === length; //最後の要素の時だけtrue
      });
  }
  
  return pieClass;
})();




