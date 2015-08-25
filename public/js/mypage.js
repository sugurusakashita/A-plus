jQuery(function ($) {

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
            //ヒアドキュメント風に取得
            edit_form =　 (function(){/*
                <select name="entrance_year" class="form-control">
                    <option value="">選択してください</option>
                    <option value="その他">2011年度以前</option>
                    <option value="2012">2012年度(4年生)</option>
                    <option value="2013">2013年度(3年生)</option>
                    <option value="2014">2014年度(2年生)</option>
                    <option value="2015">2015年度(1年生)</option>
                </select>
            */}).toString().match(/[^]*\/\*([^]*)\*\/\}$/)[1];
        }

        if(name == "faculty"){
            //ヒアドキュメント風に取得
            edit_form =　 (function(){/*
            <select name="faculty" class="form-control" }}">
                <option value="">選択してください</option>
                <optgroup label="--------学部--------">
                    <option value="人間科学部">人間科学部</option>
                    <option value="スポーツ科学部">スポーツ科学部</option>
                </optgroup>
            </select>
            */}).toString().match(/[^]*\/\*([^]*)\*\/\}$/)[1];
        }

        if(name == "sex"){
            //ヒアドキュメント風に取得
            edit_form =　 (function(){/*
            <select name="sex" class="form-control" >
                <option value="男性">男性</option>
                <option value="女性">女性</option>
            </select>
            */}).toString().match(/[^]*\/\*([^]*)\*\/\}$/)[1];
        }



        prof_span.replaceWith(edit_form);
        $(this).replaceWith(after_button);

    });

    $(".profile-list").on("click",".complete-button",function(){
        console.log($(this).siblings(".edit-prof-field").val());
    });

    if(message){
        alertify.success(message);
    }

});