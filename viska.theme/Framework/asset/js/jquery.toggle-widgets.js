(function($)
{
    $(document).ready(function()
    {
        $("input[name='save-widgets']").click(function()
        {
            var _self = $("form#awe_form");
            var data =  _self.serialize();
            _self.find(":checkbox").each(function(){
                if($(this).is(":not(:checked)"))
                    data += '&'+encodeURIComponent($(this).attr("name"))+'=0';
            });
            $.ajax(
            {
                type: "POST",
                url: ajaxurl,
                data: {action: 'toggle-widget', data: data},
                beforeSend: function()
                {
                    $("#save-alert").css({display: 'block', opacity: 1});
                },
                success: function(res)
                {
                    var parse = JSON.parse(res);

                    if (parse.talk)
                    {
                        $("#save-alert i").removeClass("dashicons-update").addClass("dashicons-yes");
                        setTimeout(function() 
                        {
                            $("#save-alert").css({"opacity":"0","display":"none"});
                            $("#save-alert i").removeClass("dashicons-yes").addClass("dashicons-update");
                            // location.reload(); 
                        }, 2000);
                    }else{
                        $("#save-alert i").removeClass("dashicons-update").addClass("dashicons-no");
                        setTimeout(function() 
                        {
                            $("#save-alert").css({"opacity":"0","display":"none"});
                            $("#save-alert i").removeClass("dashicons-no").addClass("dashicons-update");
                            // location.reload(); 
                        }, 2000);
                        
                    }

                }
            });
            return false;
        })

        $("input[name='reset-widgets']").click(function()
        {
            var sconfirm = confirm("if you click on oke, everything will be set in defaults. Are you sure?");

            if (sconfirm)
            {
                $.ajax(
                {
                    type: "POST",
                    url: ajaxurl,
                    data: {action: 'reset-widgets'},
                    beforeSend: function()
                    {
                        $("#save-alert").css({display: 'block', opacity: 1});
                    },
                    success: function(res)
                    {
                        var parse = JSON.parse(res);

                        if (parse.talk)
                        {
                            $("#save-alert i").removeClass("dashicons-update").addClass("dashicons-yes");
                            setTimeout(function()
                            {
                                $("#save-alert").css({"opacity":"0","display":"none"});
                                $("#save-alert i").removeClass("dashicons-yes").addClass("dashicons-update");
                                // location.reload();
                            }, 2000);
                        }else{
                            $("#save-alert i").removeClass("dashicons-update").addClass("dashicons-no");
                            setTimeout(function()
                            {
                                $("#save-alert").css({"opacity":"0","display":"none"});
                                $("#save-alert i").removeClass("dashicons-no").addClass("dashicons-update");
                                // location.reload();
                            }, 2000);

                        }

                    }
                });
            }
            return false;
        })

    })
})(jQuery)