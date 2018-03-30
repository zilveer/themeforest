(function($) {
    "use strict";
    var G5Plus_Install_DemoData = {
        htmlTag: {
            wrapper: '.g5plus-demo-data-wrapper'
        },
        vars: {
            is_install: false,
            try_install_count: 0,
            try_install_slider: 0
        },
        initialize: function() {
            $('span.install-button', G5Plus_Install_DemoData.htmlTag.wrapper).click(function(){
	            if (G5Plus_Install_DemoData.vars.is_install) {
		            alert('Data demo is installed!');
		            return;
	            }

                if (!confirm('Are you sure install demo data from demo site?')){
                    return;
                }

                $('.install-message', G5Plus_Install_DemoData.htmlTag.wrapper).removeClass('updated');
                $('.install-message', G5Plus_Install_DemoData.htmlTag.wrapper).removeClass('error');
                $('.install-message', G5Plus_Install_DemoData.htmlTag.wrapper).text('');
	            $('span.install-button', G5Plus_Install_DemoData.htmlTag.wrapper).addClass('not-install');
				$(this).removeClass('not-install');
	            $(this).prepend('<i class="fa fa-spin fa-spinner"></i>');

                G5Plus_Install_DemoData.vars.is_install = true;
                $('.install-progress-wrapper', G5Plus_Install_DemoData.htmlTag.wrapper).slideDown('fast');

                var method = 'livesite';
	            var demo_site = $(this).attr('data-demo');
	            var demo_path = $(this).attr('data-path');
                G5Plus_Install_DemoData.install('init',method, demo_site, demo_path, '');

                window.onbeforeunload = function(e){
                    if(!e) e = window.event;
                    e.cancelBubble = true;
                    e.returnValue = 'The install demo you made will be lost if you navigate away from this page.'; //This is displayed on the dialog

                    if (e.stopPropagation) {
                        e.stopPropagation();
                        e.preventDefault();
                    }
                };
            });
            $('.fix_install_demo_error').click(function() {
                if (!confirm('Are you sure fix demo data error?')){
                    return;
                }
	            var demo_site = $(this).attr('data-demo');
	            var demo_path = $(this).attr('data-path');
                G5Plus_Install_DemoData.install('fix-data', 'livesite', demo_site, demo_path, '');
            });
        },
        install: function(type, method, demo_site, demo_path, other_data) {
            var data = {
                type: type,
                method : method,
	            demo_site: demo_site,
	            demo_path: demo_path,
                action: 'g5plus_install_demo',
                security: true,
                other_data: other_data
            };

            var percent = 0;
            $.ajax({
                type: 'POST',
                data: data,
                url: g5plus_install_demo_meta.ajax_url,
                success: function (data) {
                    G5Plus_Install_DemoData.vars.try_install_count = 0;
	                try {
		                data = $.parseJSON(data);
	                }
	                catch (e) {
		                G5Plus_Install_DemoData.install(type, method, demo_site, demo_path, other_data);
		                return;
	                }

                    switch (data.code) {
                        case 'error':
                        case 'fileNotFound':
                            $('.install-message', G5Plus_Install_DemoData.htmlTag.wrapper).addClass('error');
                            $('.install-message', G5Plus_Install_DemoData.htmlTag.wrapper).text(data.message);
                            window.onbeforeunload = null;
                            G5Plus_Install_DemoData.vars.is_install = false;
                            break;

                        case 'setting':
                            G5Plus_Install_DemoData.animate_percent('#g5plus_reset_option > span');
                            G5Plus_Install_DemoData.install(data.code, method, demo_site, demo_path, '');
                            break;

                        case 'core':
                            $('#g5plus_reset_option > span').css({width : '100%'});
                            $('#g5plus_reset_option').addClass('nostripes');
                            var arr_core_progress = data.message.split('|');
                            if (arr_core_progress.length >= 2) {
                                percent = arr_core_progress[0]/arr_core_progress[1] * 100;
                            }

                            G5Plus_Install_DemoData.animate_percent('#g5plus_install_demo > span', percent);
                            G5Plus_Install_DemoData.install(data.code, method, demo_site, demo_path, data.message);
                            break;

                        case 'slider':
                            G5Plus_Install_DemoData.vars.try_install_slider = 0;
                            jQuery('#g5plus_install_demo > span').css({width : '100%'});
                            jQuery('#g5plus_install_demo').addClass('nostripes');

                            G5Plus_Install_DemoData.animate_loading('#g5plus_import_slider > span');
                            G5Plus_Install_DemoData.install(data.code, method, demo_site, demo_path, data.message);
                            break;

                        case 'done':
                            jQuery('#g5plus_import_slider > span').css({width : '100%'});
                            jQuery('#g5plus_import_slider').addClass('nostripes');

                            $('.install-message', G5Plus_Install_DemoData.htmlTag.wrapper).addClass('updated');
                            G5Plus_Install_DemoData.vars.is_install = false;
                            window.onbeforeunload = null;
	                        $('span.install-button i.fa', G5Plus_Install_DemoData.htmlTag.wrapper).attr('class', 'fa fa-check');

                            break;
                        default:
                            if (type == 'slider') {
                                G5Plus_Install_DemoData.vars.try_install_slider +=1;
                                if (G5Plus_Install_DemoData.vars.try_install_slider < 10) {
                                    G5Plus_Install_DemoData.install(type, method, demo_site, demo_path, other_data);
                                }
                                else {
                                    G5Plus_Install_DemoData.install('fix-data', method, demo_site, demo_path, '');
                                }
                            }
                            else {
                                G5Plus_Install_DemoData.install(type, method, demo_site, demo_path, other_data);
                            }
                            break;
                    }
                },
	            error: function() {
		            G5Plus_Install_DemoData.vars.try_install_count = 0;
		            G5Plus_Install_DemoData.install(type, method, demo_site, demo_path, other_data);
	            }
            });
        },

        animate_percent: function(processbar, percent) {
            if (percent > 100) return;
            $(processbar).css({width:  percent + '%'});
        },
        animate_loading: function(processbar) {
            if ($(processbar).attr('style') == 'width: 100%;') {
                return;
            }
            var width = parseInt(jQuery(processbar).width(),10);
            var parentWidth = parseInt($(processbar).parent().width(),10);
            var percent = (width*1.0  / parentWidth) * 100  + 1;

            if (percent > 100) return;
            if (percent < 98)
            {
                $(processbar).css({width:  percent + '%'});
                setTimeout(function() {
                    G5Plus_Install_DemoData.animate_loading(processbar);
                },500);
            }
        }
    }
    $(document).ready(function(){
        G5Plus_Install_DemoData.initialize();
    });
})(jQuery);