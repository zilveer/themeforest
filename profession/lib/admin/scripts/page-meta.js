(function ($) {

    var utility = {
        //Checks if element as desired attribute
        HasAttr: function ($elm, attr) {
            return typeof $elm.attr(attr) != 'undefined';
        },
        GetAttr: function ($elm, attr, def){
            return this.HasAttr($elm, attr) ? $elm.attr(attr) : def;
        }
    };

    function HandleTemplateMeta() {
        var $metaContainer = $('#px-main'),
            $sections = $metaContainer.children(),
            pageSettings   = {
                'default': '.intro-config,.sidebar-config',
                'template-page.php': '.intro-config,.sidebar-config',
                'template-home.php': '',
            };

        $('#page_template').change(function () {
            var $select = $(this),
                $selected = $select.find('option:selected'),
                val = $selected.val();

            if (!pageSettings.hasOwnProperty(val)) {
                $sections.slideUp('fast');
                return;
            }
            
            var $items = $sections.filter(pageSettings[$selected.val()]);

            $sections.not($items).slideUp('fast');
            $items.slideDown('fast');
        }).change();//Trigger
    }

    $(document).ready(function () {

        HandleTemplateMeta();
    });

})(jQuery);