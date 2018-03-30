jQuery(document).ready(function() {
    jQuery('[id^=subscribe]').submit(function() {

        $response = $(this).find('[id^=response]');

        $response.html('<span class="notice_message">Adding email address...</span>');

        var name = $(this).find('.NewsletterName').val().split(' ');

        var provider = $(this).find('.provider').val() || 'mailchimp';
        var apiKey = $(this).find('.apiKey').val() || '';
        var listId = $(this).find('.listId').val() || '';
        var dopt = $(this).find('.dopt').val() || '';

        var fname = name[0] || '';
        var lname = name[1] || '';

        var templateUrl = locale.templateUrl;

        // Prepare query string and send AJAX request
        jQuery.ajax({
            url: templateUrl + '/engine/mailing-list/mailing-list.php',

            data: 'ajax=true&email=' + escape($(this).find('.NewsletterEmail').val()) + '&fname=' + fname + '&lname=' + lname + '&akey=' + apiKey + '&lid=' + listId + '&dopt=' + dopt + '&provider=' + provider,

            success: function(msg) {
                if (msg.indexOf("Success") !=-1) {
                    $response.html('<span class="success_message">Success! You are now subscribed to our newsletter!</span>');
                } else {
                    $response.html('<span class="error_message">' + msg + '</span>');
                }
            }
        });

        return false;
    });
});