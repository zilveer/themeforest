<?php

$title = yiw_get_option('popup_title');
$message = yiw_get_option('popupmessage');

$image = yiw_get_option('popup_image');
$newsletter = yiw_get_option('popup_newsletter_form_action');

if(!$title && !$message && !$image && !$newsletter)
    return;

$site_name = sanitize_title(get_bloginfo( 'name' ));
$cookie_name = 'yit-popup-'.$site_name;
$cookie_access = 'yit-popup-access-'.$site_name;

//add_action('wp_enqueue_scripts', array(&$this, 'add_popup_css_js'));

$access_cookie = !isset( $_COOKIE[ $cookie_access ] ) ? false : $_COOKIE[ $cookie_access ];
$no_popup_cookie = !isset( $_COOKIE[ $cookie_name ] ) ? false : $_COOKIE[ $cookie_name ];

/** action for append popup html **/
if ( !$access_cookie && !$no_popup_cookie )
    add_action('yit_after_wrapper', array( &$this, 'get_html' ));




?>

<div class="popupOverlay"></div>
<div id="popupWrap" class="popupWrap two-fourth">
    <div class="popup">
        <?php if($title) : ?>
            <h3 class="title"><?php echo $title ?></h3>
        <?php endif ?>
        <?php if( ($image) || ($message) || $newsletter) : ?>
            <div class="row">
                <?php if($image) : ?>
                    <div class="popup_img two-fourth"><img alt="popup-image" src="<?php echo $image ?>" /></div>
                <?php endif ?>
                <div class="popup_message <?php echo ($image) ? 'two-fourth last' : ' no-image' ?> ">
                    <?php echo yiw_addp( stripslashes( $message ) ); ?>
                    <?php if($newsletter) :
                        $action = yiw_get_option('popup_newsletter_form_action');
                        $email = yiw_get_option('popup_newsletter_form_email');
                        $email_label = yiw_get_option('popup_newsletter_form_label_email');
                        $hidden_fields =yiw_get_option('popup_newsletter_form_label_hidden_fields');
                        $submit =yiw_get_option('popup_newsletter_form_label_submit');
                        $method = yiw_get_option('popup_newsletter_form_method');
                        ?>

                        <div class="popup-newsletter-section group">
                            <form method="<?php echo $method ?>" action="<?php echo $action ?>">
                                <fieldset class="row">
                                    <ul class="group">
                                        <li class="two-third">
                                            <input type="text" name="<?php echo $email ?>" id="<?php echo $email ?>" class="email-field text-field autoclear" placeholder="<?php echo $email_label ?>" />
                                        </li>
                                        <li class="one-third last">
                                            <?php // hidden fileds
                                            if ( $hidden_fields != '' ) {
                                                $hidden_fields = explode( '&', $hidden_fields );
                                                foreach ( $hidden_fields as $field ) {
                                                    list( $id_field, $value_field ) = explode( '=', $field );
                                                    echo '<input type="hidden" name="' . $id_field . '" value="' . $value_field . '" />';
                                                }
                                            }

                                            echo wp_nonce_field( 'mc_submit_signup_form', '_mc_submit_signup_form_nonce', false, false );
                                            ?>
                                            <div class="input-prepend">
                                                <input type="submit" value="<?php echo $submit ?>" class="submit-field" />
                                            </div>
                                        </li>
                                    </ul>
                                </fieldset>
                            </form>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        <?php endif ?>
        <div class="clear"></div>
        <div class="box-no-view">
            <label for="no-view"><input type="checkbox" name="no-view" class="no-view" /><?php echo __('Do not show again', 'yiw') ?></label>
        </div>

    </div>
    <div class="close-popup"></div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($){

        /** Center popup on the screen **/
        jQuery.fn.center = function () {
            this.css("position","absolute");
            this.css("top", Math.max(0, (($(window).height() - this.outerHeight()) / 2) ) + "px");
            this.css("left", Math.max(0, (($(window).width() - this.outerWidth()) / 2) ) + "px");
            return this;
        }

        /** Check Cookie */
        var access_cookie = ( $.cookie('<?php echo $cookie_access ?>') == null ) ? false : $.cookie('<?php echo $cookie_access ?>');
        var noview_cookie = ( $.cookie('<?php echo $cookie_name ?>') == null ) ? false : $.cookie('<?php echo $cookie_name ?>');
        if ( !access_cookie && !noview_cookie ) {
            $('.popupWrap').center();
            $('.popupOverlay').css( { display: 'block', opacity:0 } ).animate( { opacity:0.7 }, 500 );
            $('.popupWrap').css( { display: 'block', opacity:0 } ).animate( { opacity:1 }, 500 );

            /** Close popup function **/
            var close_popup = function() {
                if ( $('.no-view').is(':checked') ) {
                    $.cookie( '<?php echo $cookie_name ?>', 1, { expires: 365, path: '/' } );
                }

                $.cookie( '<?php echo $cookie_access ?>', 1, { path: '/' } );

                $('.popupOverlay').animate( {opacity:0}, 200);
                $('.popupOverlay').remove();
                $('.popupWrap').animate( {opacity:0}, 200);
                $('.popupWrap').remove();
            }

            /**
             *	Close popup on:
             *	- 'X button' click
             *   - wrapper click
             *   - esc key pressed
             **/
            $('.close-popup').click(function(){
                close_popup();
            });

            $(document).bind('keydown', function(e) {
                if (e.which == 27) {
                    if($('.popupOverlay')) {
                        close_popup();
                    }
                }
            });

            $('.popupOverlay').click(function(){
                close_popup();
            });

            $('.submit-field').parents('form').on( 'submit', function(){
                $.cookie( '<?php echo $cookie_name ?>', 1, { expires: 365, path: '/' } );
            });

            /** Center popup on windows resize **/
            $(window).resize(function(){
                $('#popupWrap').center();
            });
        }
    });
</script>