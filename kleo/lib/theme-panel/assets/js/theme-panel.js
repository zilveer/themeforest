(function ($) {
    $.themePanel = function () {
        this.scope = $(document);
        this.init();
    };

    $.themePanel.prototype = {
        init : function() {
            var fw = this;

            fw.init_tabs();
            // Init theme registration form
            fw.init_theme_registration();
            // Init tooltips
            fw.init_tooltips();
            // Init plugin ajax actions
            fw.init_addons_ajax();
        },

        init_tooltips : function(){
            $( '.tooltip-me' ).tooltip({
                position : { my: 'center bottom', at: 'center top-10' }
            });
        },

        init_tabs : function(){

            var tabs = $('.cd-tabs');

            tabs.each(function(){
                var tab = $(this),
                    tabItems = tab.find('ul.cd-tabs-navigation'),
                    tabContentWrapper = tab.children('ul.cd-tabs-content'),
                    tabNavigation = tab.find('nav');

                tabItems.on('click', 'a', function(event){
                    event.preventDefault();
                    var selectedItem = $(this);
                    if( !selectedItem.hasClass('selected') ) {
                        var selectedTab = selectedItem.data('content'),
                            selectedContent = tabContentWrapper.find('li[data-content="'+selectedTab+'"]');
                            //slectedContentHeight = selectedContent.innerHeight();

                        tabItems.find('a.selected').removeClass('selected');
                        selectedItem.addClass('selected');
                        selectedContent.addClass('selected').siblings('li').removeClass('selected');
                        //animate tabContentWrapper height when content changes
                        /*tabContentWrapper.animate({
                            'height': slectedContentHeight
                        }, 200);*/

                        /* change hash */

                        window.location.hash = selectedTab;
                    }
                });

            });

            // Activate specific link on new page
            var hash = window.location.hash;
            var nav_li = $('.cd-tabs-navigation > li');
            var string = hash.replace('-link', '');

            if ( hash !== '' && nav_li.find('a[href="' + string + '"]').length ) {
                nav_li.find('a[href="' + string + '"]').trigger('click');
            }

        },

        init_theme_registration : function(){
            $('.sq-panel-register-form').submit(function(e) {
                e.preventDefault();

                var username = $('#tf_username', this).val(),
                    api_key = $('#tf_apikey', this).val(),
                    nonce = $('#sq_nonce', this).val(),
                    form = $(this),
                    responseEl = $('.response-area', this);

                if (form.hasClass('sq-submitting')) {
                    return;
                }

                // bail out
                if (!username.length || !api_key.length || !nonce.length) {
                    $(this).addClass('sq-panel-register-form-error');
                    return;
                }

                var data = {
                    'action': 'sq_theme_registration',
                    'username': username,
                    'api_key': api_key,
                    'sq_nonce': nonce
                };

                // Perform the Ajax call
                $.ajax({
                    url: ajaxurl,
                    data: data,
                    type: 'POST',
                    success: function (response) {
                        // If we received an error, display it
                        if (response.success === false) {
                            if (response.data.error) {
                                responseEl.html("ERROR: " + response.data.error).removeClass('hidden');
                            }
                        }
                        else if (response.success === true) {
                            responseEl.html(response.data.message).removeClass('hidden');
                        }
                        else {
                            responseEl.html('Something went wrong. Please try again later.').removeClass('hidden');
                        }
                    },
                    beforeSend : function() {
                        form.addClass('sq-submitting');
                        responseEl.addClass('hidden').html('');

                    },
                    complete : function() {
                        form.removeClass('sq-submitting');
                    }
                });
            });
        },


        init_addons_ajax : function(){
            var fw = this;

            $( document ).on( 'click', '.sq-extension-button', function(e){
                e.preventDefault();

                // Perform the ajax call based on action
                var config = {};
                config.button			= $( this );
                // config.button			= config.button.find('.spinner');
                config.status_classes	= 'sq-active sq-inactive sq-not-installed';
                config.el_container	= config.button.closest('.sq-extension');
                config.status_holder	= config.el_container.find( '.sq-extension-status' );
                config.action			= config.button.data( 'action' );
                config.nonce			= config.button.data( 'nonce' );
                config.slug				= config.button.data( 'slug' );

                if( config.el_container.hasClass('sq-addons-disabled') ){
                    return false;
                }

                var data = {
                    security 		: config.nonce,
                    action 			: 'sq_do_plugin_action',
                    plugin_action 	: config.button.data( 'action' ) 		|| false,
                    slug 			: config.button.data( 'slug' ) 			|| false,
                };

                // Don't allow the user to click the button multiple times
                if( config.button.hasClass('is-active') ) { return false; }

                // Add the loading class
                config.button.addClass( 'is-active' );

                fw.perform_ajax_call( data, config );

                return false;
            });
        },

        perform_ajax_call : function( data, config, callback ){
            // Perform the ajax call
            $.ajax({
                'type' : 'post',
                'dataType' : 'json',
                'url' : ajaxurl,
                'data' : data,
                'success' : function( response ){

                    // If we received an error, display it
                    if( response.data.error ){
                        alert( response.data.error );
                    }

                    // Update the plugin status
                    config.el_container.removeClass( config.status_classes );
                    config.el_container.addClass( response.data.status );
                    config.status_holder.text( response.data.status_text );

                    // Update the plugin
                    config.button.data( 'action', response.data.action );
                    config.button.text( response.data.action_text );

                    if( typeof callback != 'undefined' ){
                        callback();
                    }

                    config.button.removeClass( 'is-active' );
                },
                'error' : function(response){
                    if( typeof callback != 'undefined' ){
                        callback();
                    }
                  
                    alert( 'There was a problem performing the action.' );
                    config.button.removeClass( 'is-active' );
                }
            });
        }
    };

    $(document).ready(function() {
        // Call this on document ready
        $.themePanel = new $.themePanel();
    });

})(jQuery);