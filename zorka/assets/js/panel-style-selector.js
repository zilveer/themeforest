(function($) {
    "use strict";
    var G5PlusPanelStyleSelector = {
        htmlTag : {
            wrapper: '#panel-style-selector'
        },
        vars : {
            isLoading: false
        },
        initialize: function() {
            G5PlusPanelStyleSelector.build();
        },
        build : function () {

            $.ajax({
                type   : 'POST',
                data   : 'action=panel_selector',
                url    : zorka_ajax_url,
                success: function (html) {
                    $('body').append(html);
                    G5PlusPanelStyleSelector.events();
                },
                error  : function (html) {

                }
            });
        },
        events : function() {
            $('.panel-selector-open',G5PlusPanelStyleSelector.htmlTag.wrapper).click(function(){
                $('.panel-wrapper',G5PlusPanelStyleSelector.htmlTag.wrapper).toggleClass('in');
            });
            $('.panel-selector-open',G5PlusPanelStyleSelector.htmlTag.wrapper).hover(function(){
                $('i',this).addClass('fa-spin');
            } , function(){
                $('i',this).removeClass('fa-spin');
            });

            G5PlusPanelStyleSelector.layout();
            G5PlusPanelStyleSelector.background();
            G5PlusPanelStyleSelector.reset();
            G5PlusPanelStyleSelector.primary_color();
        },
        layout : function() {

            if ($('body').hasClass('boxed')) {
                $('a[data-value="boxed"]',G5PlusPanelStyleSelector.htmlTag.wrapper).addClass('active');
            } else {
                $('a[data-value="wide"]',G5PlusPanelStyleSelector.htmlTag.wrapper).addClass('active');
            }

            $('a[data-type="layout"]', G5PlusPanelStyleSelector.htmlTag.wrapper).click(function(event){
                event.preventDefault();

                $('a[data-type="layout"]',G5PlusPanelStyleSelector.htmlTag.wrapper).removeClass('active');
                $(this).addClass('active');

                var layout = $(this).attr('data-value');
                if (layout == 'boxed') {
                    $('body').addClass('boxed');
                } else {
                    $('body').removeClass('boxed');
                }
            })
        },
        background : function() {
           $('.panel-primary-background li',G5PlusPanelStyleSelector.htmlTag.wrapper).click(function(event){
               event.preventDefault();
               var name = $(this).data('name');
               var type = $(this).data('type');

               $('body').css({
                   'background-image': 'url(' + zorka_theme_url + 'assets/images/' + name + ')',
                   'background-repeat': 'repeat',
                   'background-position': 'center center',
                   'background-attachment': 'scroll',
                   'background-size': 'auto'
               });

           })
        },
        primary_color : function() {
            $('ul.panel-primary-color li',G5PlusPanelStyleSelector.htmlTag.wrapper).click(function(event){
                event.preventDefault();
                var $this = $(this);
                if (G5PlusPanelStyleSelector.vars.isLoading) return;
                G5PlusPanelStyleSelector.vars.isLoading = true;
                var color = $(this).data('color');
                $('.panel-selector-open i',G5PlusPanelStyleSelector.htmlTag.wrapper).addClass('fa-spin');
                $.ajax({
                    url : zorka_ajax_url,
                    data : {
                        action: 'custom_css_selector',
                        primary_color : color
                    },
                    success : function(response) {
                        G5PlusPanelStyleSelector.vars.isLoading = false;

                        $('ul.panel-primary-color li',G5PlusPanelStyleSelector.htmlTag.wrapper).removeClass('active');
                        $this.addClass('active');

                        if ($('style#color_ss').length == 0) {
                            $('head').append('<style type="text/css" id="color_ss"></style>');
                        }

                        $('style#color_ss').html(response);
                        $('.panel-selector-open i',G5PlusPanelStyleSelector.htmlTag.wrapper).removeClass('fa-spin');
                    },
                    error : function(){
                        G5PlusPanelStyleSelector.vars.isLoading = false;
                        $('.panel-selector-open i',G5PlusPanelStyleSelector.htmlTag.wrapper).removeClass('fa-spin');
                    }
                });

            });
        },
        reset : function(){
            $('#panel-selector-reset',G5PlusPanelStyleSelector.htmlTag.wrapper).click(function(event){
                event.preventDefault();
                document.location.reload(true);
            })
        }
    };

    $(document).ready(function(){
        G5PlusPanelStyleSelector.initialize();
    });
})(jQuery);