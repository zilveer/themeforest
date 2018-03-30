 (function($) {
    //alert(ajaxurl);
    $(document).ready(function($) {
        setupSignupForm();
    });

    function addMessage( type, message, duration ) {
        // create message
        var message = $( '<div id="setting-error-settings_updated" class="' + type + ' settings-error below-h2"><p><strong>' + message + '</strong></p></div>' );
        message.hide();
        // add message to the page and fade in
        $( '#ajax-errors-here').append( message );
        message.fadeIn();

        if( duration !== undefined ) {
            setTimeout(function() {
                message.fadeOut();
            }, duration);  // will work with every browser
        }
    }


    function setupSignupForm() {
        $("input[name='caelus-options[ajax_list]']").click( function() {
            // get a handle on the button and the list
            var $updateListButton = $(this);
            var $listSelectBox = $( "select[name='caelus-options[list_id]']" );
            // get the api key
            var api_key = $("input[name='caelus-options[api_key]']").val();

            if( api_key != '' ) {
                // add loading spinner next to the list select
                $listSelectBox.after( '<span id="updateListMessage"><img src="images/wpspin_light.gif" style="vertical-align:middle;padding: 0px 5px;" /><span>Fetching...</span></div>' );
                // disable the fetch list button
                $updateListButton.attr( 'disabled', true );

                $.post( localData.ajaxurl,
                    {
                        action: 'fetch_api_lists',
                        nonce: localData.nonce,
                        api_key: api_key
                    },
                    function( data ) {
                        switch( data.status ) {
                            case 'ok':
                                var options='';
                                $.each(data.lists ,function(key , val){
                                    options +='<option value="' + val + '">' + key + '</option>';
                                });
                                $listSelectBox.html(options);
                                addMessage( 'updated' , 'Mailchimp lists fetched successfully.' , 5000 );
                            break;
                            case 'error':
                                addMessage( 'error' , data.message , 10000 );
                            break;
                        }
                        // re enable the fetch list button
                        $updateListButton.removeAttr( 'disabled' );
                        // remove the text & spinner next to the select list box
                        $( '#updateListMessage' ).remove();
                    },
                    'json'
                );
            }
            else {
                addMessage( 'error' , 'You must provide an API key.' , 5000 );
            }
            // return false so the form is not sent
            return false;
        });

    };

})(jQuery);
