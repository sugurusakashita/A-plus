jQuery(function ($) {

    $(".raty_stars").raty({
        score:function(){
            return $(this).attr('data-star');
        },
        readOnly:true
    });

    $(".edit-button").click(function(){
        var prof_span = $(this).siblings(".profile-value");
        var name = $(this).parent().attr("class");
        var type = "text";
        if(name == "email"){
            type = "email";
        }

        var edit_form = "<input type="+type+" name="+name+" class='form-group edit-prof-field' value="+prof_span.text()+">";
        var after_button = '<button type="submit" class="btn btn-sm btn-danger btn-xs complete-button right-float">完了</button>';

        if(name == "entrance_year"){
            edit_form ='<select name="entrance_year" class="form-control"><option value="">選択してください</option><option value="その他">2011年度以前</option><option value="2012">2012年度(4年生)</option><option value="2013">2013年度(3年生)</option><option value="2014">2014年度(2年生)</option><option value="2015">2015年度(1年生)</option></select>';
        }

        if(name == "faculty"){
            edit_form =　'<select name="faculty" class="form-control" }}"><option value="">選択してください</option><optgroup label="--------学部--------"><option value="人間科学部">人間科学部</option><option value="スポーツ科学部">スポーツ科学部</option></optgroup></select>';
        }

        if(name == "sex"){
            edit_form = '<select name="sex" class="form-control" ><option value="">選択してください</option><option value="男性">男性</option><option value="女性">女性</option></select>';
        }



        prof_span.replaceWith(edit_form);
        $(this).replaceWith(after_button);
    });

    $(".profile-list").on("click",".complete-button",function(){
        console.log($(this).siblings(".edit-prof-field").val());
    });

    $("#year").change(function(){
        var year = $("#year").val();
        var term = $("#term").val();
        // console.log(year,term);
        var params = {
            "year": year,
            "term": term,
            "_token":$('meta[name="csrf-token"]').attr('content')
        };
        $.ajax({
            type: "GET",
            url: "../../mypage/class-t-t",
            dataType: "Json",
            data: params,
            crossDomain: false,
            success: function(data, dataType){

                if (data['success']) {
                    var period = [1,2,3,4,5,6];
                    var week = ["月","火","水","木","金","土"];
                    console.log($('td[data-week="木"][data-period=1]'))

                    for (var i = 0; i < week.length ; i++) {
                        for (var j = 0 ; j < period.length ; j++) {

                            var replace_tag = '<td data-week="'+ week[i] +'" data-period='+ period[j] +'><br></td>';
                            $('td[data-week="' + week[i] + '"][data-period=' + period[j] + ']').replaceWith(replace_tag);

                        };    
                    };

                    for (var i = 0 ; i < data["time_table"].length ; i++) {
                        var week = data['time_table'][i]['class_week'];
                        var period = data['time_table'][i]['class_period'];
                        var class_name = data['time_table'][i]['class_name'];
                        var room_name = data['time_table'][i]['room_name'];

                        $('td[data-week="' + week + '"][data-period=' + period + ']').replaceWith('<td data-week="'+ week +'" data-period='+ period +'>'+ class_name +'<br>'+ room_name +'</td>');
                    };
                }else{
                    alertify.error(data['message']);
                };
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                console.log(errorThrown.status);
            }
        });
    });

    $("#term").change(function(){
        var year = $("#year").val();
        var term = $("#term").val();
        // console.log(year,term);
        var params = {
            "year": year,
            "term": term,
            "_token":$('meta[name="csrf-token"]').attr('content')
        };
        $.ajax({
            type: "GET",
            url: "../../mypage/class-t-t",
            dataType: "Json",
            data: params,
            crossDomain: false,
            success: function(data, dataType){
                var period = [1,2,3,4,5,6];
                var week = ["月","火","水","木","金","土"];
                console.log($('td[data-week="木"][data-period=1]'))

                for (var i = 0; i < week.length ; i++) {
                    for (var j = 0 ; j < period.length ; j++) {

                        var replace_tag = '<td data-week="'+ week[i] +'" data-period='+ period[j] +'><br></td>';
                        $('td[data-week="' + week[i] + '"][data-period=' + period[j] + ']').replaceWith(replace_tag);

                    };                    
                };

                for (var i = 0 ; i < data["time_table"].length ; i++) {
                    var week = data['time_table'][i]['class_week'];
                    var period = data['time_table'][i]['class_period'];
                    var class_name = data['time_table'][i]['class_name'];
                    var room_name = data['time_table'][i]['room_name'];
                    
                    $('td[data-week="' + week + '"][data-period=' + period + ']').replaceWith('<td data-week="'+ week +'" data-period='+ period +'>'+ class_name +'<br>'+ room_name +'</td>');
                };
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                console.log(errorThrown.status)  
            }
        });
    });

    if(message){
        alertify.success(message);
    }

});