(function($)
{
    $(document).ready(function()
    {
        $("#submit-chulanmenu").click(function()
        {
            
            var _obj = $(this), _appendTo =  $("#menu-to-edit");
            var data = $("form#nav-menu-meta").serialize();
                data = JSON.stringify(data);
            $.ajax(
            {
                type: 'POST',
                url: WILOKE.ajaxurl,
                data: {action: 'chulan_add_menu', 'menu': 2, data: data},
                beforeSend: function()
                {
                    _obj.next().fadeIn();
                },
                success: function(res)
                {
                    console.log(res);
                    _obj.next().hide();
                    _appendTo.append(res);
                    var getNth = _appendTo.length;
                    _appendTo.eq(getNth-1).find(".field-description.description, .field-link-target, .field-css-classes, .field-xfn").addClass("hidden-field");
                    _appendTo.eq(getNth-1).find(".menus-move-up, .menus-move-down, .menus-move-left, .menus-move-right, .menus-move-top").show();

                    $(".pirates-chulan-menu").prop('checked', false);
                }
            })

            return false;
        })
    })
})(jQuery)