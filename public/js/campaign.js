jQuery(function ($) {
    $("#entry-via-twitter,#entry-via-facebook").click(function(){
        var params = {
            "_token":$('meta[name="csrf-token"]').attr('content')
        };
        $.ajax({
                type: "POST",
                url: "/campaign/entry",
                dataType: "text",
                data: params,
                crossDomain:false
        });
    });
});