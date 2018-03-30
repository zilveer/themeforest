<?php 
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

  
function udesign_add_icon_fonts_button() {

    // the title of the modal lightbox
    $title = esc_attr__( 'uDesign: Select an Icon Font', 'udesign' );
    
    // the icon for the button
    $icon_img = '<img src="' . get_template_directory_uri() . '/scripts/admin/icon-fonts/check-square.png" alt="check-square" width="18" height="18" />';

    //the container id where all the popup content will be stored
    $container_id = 'udesign_icon_fonts_popup_container';

    $select_icon_font_link   = '/?TB_inline&amp;width=753&amp;height=850&amp;inlineId=' . $container_id;

    // construct the thickbox button link
    $thickbox_popup_link = '<a '
            . 'href="' . esc_url( $select_icon_font_link ) . '" '
            . 'class="thickbox button udesign-icon-font-button" '
            . 'title="' . $title . '">'
            //. '<span class="fa fa-check-square-o"></span> Add Icon</a>';
            . '<span class="udesign-icon-fonts-btn-img">' . $icon_img . '</span> Add Icon</a>';

    echo $thickbox_popup_link;
}
add_action('media_buttons', 'udesign_add_icon_fonts_button', 12);


// The content below will be shown in the inline modal (Thickbox)
function udesign_icon_fonts_popup_content() { ?>

    <div id="udesign_icon_fonts_popup_container" style="display:none;">

<?php 

        function udesign_add_icon_select_option() {
            /* Include the Font Awesome array, if Font Awesome is enabled of course */
            global $udesign_font_awesome_options;
            $udesign_fa_icons = '';
            if ( ! $udesign_font_awesome_options['udesign_disable_font_awesome'] ) {
                include( get_template_directory() . '/styles/common-css/font-awesome/udesign-font-awesome-icons.php' );
                $udesign_fa_icons = udesign_fa_icons();
            }
            $udesign_fontello_icons = ( udesign_is_fontello_installed() ) ? udesign_get_fontello_fonts_transient( true ) : ''; ?>

            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><?php esc_html_e('Choose an Icon Font:', 'udesign'); ?></th>
                        <td>
                            <div id="udesign-icon-fonts-select-wrapper">
                                <select id="udesign-icon-fonts-select" data-placeholder="Select an Icon" style="width: 314px">
                                    <option value=""></option>
<?php                               if ( $udesign_fa_icons ) : ?>
                                        <optgroup label="<?php esc_html_e('Font Awesome Icons:', 'udesign'); ?>" class="fa-optgroup" role="fa-optgroup">
<?php                                   foreach ( $udesign_fa_icons as $fa_icon ) : ?>
                                            <option data-css-prefix="fa "><?php echo $fa_icon; ?></option>
<?php                                   endforeach; ?>
                                        </optgroup>
<?php                               endif; ?>
<?php                               if ( $udesign_fontello_icons ) : ?>
                                        <optgroup label="<?php esc_html_e('Fontello Icons:', 'udesign'); ?>" class="fontello-optgroup" role="fontello-optgroup">
<?php                                   foreach ( $udesign_fontello_icons as $icon ) : ?>
                                            <option data-css-prefix="icon-"><?php echo $icon; ?></option>
<?php                                   endforeach; ?>
                                        </optgroup>
<?php                               endif; ?>
                                </select>
                            </div>
                            <div class="clear"></div>
<?php                       $num_udesign_fa_icons = ( $udesign_fa_icons == '' ) ? '0' : count( $udesign_fa_icons );
                            $num_fontello_icons = ( $udesign_fontello_icons == '' ) ? '0' : count( $udesign_fontello_icons ); ?>
                            <span class="description" style="margin-top: 10px; display: inline-block;"><?php printf( __('Total Icons: %1$s  (Font Awesome) + %2$s  (Fontello)', 'udesign'), 
                                    '<strong>' . $num_udesign_fa_icons . '</strong>', 
                                    '<strong>' . $num_fontello_icons . '</strong>' ); ?></span>
                        </td>
                    </tr>
                </tbody>
            </table>
<?php   }
        echo udesign_add_icon_select_option(); ?>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e('Icon Font Color:', 'udesign'); ?></th>
                    <td>
                        <div id="udesign-icon-font-color-picker-wrapper">
                            <label>
                                <input type="checkbox" id="udesign-icon-font-color-inherit" value="inherit" checked /> <?php esc_html_e('Inherit default color or:', 'udesign'); ?> 
                            </label>
                            <div class="clear"></div>
                            <input type="text" value="#4C4C4C" id="udesign-icon-font-color-picker-field" data-default-color="#4C4C4C" />
                        </div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e('Icon Font Size:', 'udesign'); ?></th>
                    <td>
                        <span id="udesign-icon-font-size-wrapper"><span id="udesign-icon-font-size">1</span> em</span> <span id="udesign-icon-font-size-slider"></span><br />
                        <span class="description" style="margin-top: 6px; display: inline-block;"><?php esc_html_e('"1 em" is the default (inherit) text size, hence it will not be included in the code/shortcode.', 'udesign'); ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e('Other Options:', 'udesign'); ?></th>
                    <td>
                        <fieldset style="margin-top:5px;"><legend class="screen-reader-text"><span><?php esc_html_e("Animated Spin:", 'udesign'); ?></span></legend>
                            <label>
                                <input type="checkbox" id="udesign-fontello-icons-animate-spin" value="animate" />
                                <?php esc_html_e('Add animated spin', 'udesign'); ?>
                            </label>
                        </fieldset>

                        <fieldset style="margin-top:5px;"><legend class="screen-reader-text"><span><?php esc_html_e("Wrap In Circle:", 'udesign'); ?></span></legend>
                            <label>
                                <input type="checkbox" id="udesign-fontello-icons-wrap-in-circle" value="animate" />
                                <?php esc_html_e('Wrap in a circle', 'udesign'); ?>
                            </label>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <div id="udesign-preview-icon-fonts-container">
            <div id="udesign-close-review-button"><a id="udesign-close-review-button-link" href="#"><div class="ud-if-close-icon"></div></a></div>
            <input type="button" id="preview-icon-font-btn" class="button-secondary preview-closed" value="<?php echo __('Show Preview', 'udesign'); ?>" />
            <div class="clear"></div>
            <div id="udesign-preview-icon-fonts-wrapper">
                <div id="udesign-preview-icon-fonts-html-wrapper">
                    <div id="udesign-preview-icon-font"></div>
                </div>
                <div class="clear"></div>
                <strong>Shortcode:</strong>
                <div id="udesign-preview-icon-fonts-shortcode"></div>
                <div class="clear"></div>
                <strong>HTML:</strong>
                <div id="udesign-preview-icon-fonts-html"></div>
            </div>
        </div>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <td>
                        <fieldset style="margin-top:5px;"><legend class="screen-reader-text"><span><?php esc_html_e("HTML Version:", 'udesign'); ?></span></legend>
                            <label>
                                <input type="checkbox" id="udesign-fontello-icons-as-html" value="animate" />
                                <?php esc_html_e('Insert as HTML (shortcode version is used by default, see the preview above for details)', 'udesign'); ?>
                            </label>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>


        <p id="udesign-icon-font-insert-button" class="submit">
            <input type="button" id="insert-icon-font-btn" class="button-primary" value="<?php echo __('Insert Icon', 'udesign'); ?>" />
            <a id="cancel-icon-insertion" class="button-secondary" onclick="tb_remove();" title="<?php _e('Cancel', 'udesign'); ?>"><?php _e('Cancel', 'udesign'); ?></a>
        </p>


        <?php $udesign_fontello_css_prefix_text = udesign_fontello_css_prefix_text(); ?>
        
        <script type="text/javascript">
        // <![CDATA[
        jQuery(document).ready(function ($) {
            
            function addIcontoListItem(item) {
                var classPrefix = item.element;
                if (!item.id) return item.text; // optgroup
                return "<span class=\"icon-font-item\"><i class='" + $(classPrefix).data('css-prefix') + item.text + "'></i> " + item.text + '</span>';
            }
            $("#udesign-icon-fonts-select").select2({
                theme: "classic",
                placeholder: "Choose an Icon Font",
                allowClear: true,
                templateResult: addIcontoListItem,
                templateSelection: addIcontoListItem,
                escapeMarkup: function(m) { return m; }
            })
            .on("change", function(e) {
                // update preview on font change if preview is opened of course
                if ( $('#preview-icon-font-btn').hasClass('preview-opened') ) {
                    displayIconPreviewContent();
                }
            }).on("select2-removed", function(e) {
                $('#udesign-preview-icon-fonts-wrapper').delay(100).fadeOut(400, function(){
                        $('#preview-icon-font-btn').removeClass('preview-opened').addClass('preview-closed');
                 });
                 $('#udesign-close-review-button').css("display", "none");
            });
            
            // deal with the color picker
            var myOptions = {
                // you can declare a default color here,
                // or in the data-default-color attribute on the input
                defaultColor: false,
                // a callback to fire whenever the color changes to a valid color
                change: function(event, ui){
                    // uncheck the "inherit default color" checkbox:
                    $('#udesign-icon-font-color-inherit').prop('checked', false);
                    // update preview on color change if preview is opened of course
                    if ( $('#preview-icon-font-btn').hasClass('preview-opened') ) {
                        var selectedColor = ui.color.toString();
                        $('.wp-picker-input-wrap input#udesign-icon-font-color-picker-field').val( selectedColor );
                        displayIconPreviewContent();
                    }
                },
                // a callback to fire when the input is emptied or an invalid color
                clear: function() {},
                // hide the color picker controls on load
                hide: true,
                // show a group of common colors beneath the square
                // or, supply an array of colors to customize further
                palettes: true
            };
            $('#udesign-icon-font-color-picker-field').wpColorPicker( myOptions );


            // Preview section
            $('#preview-icon-font-btn').on( "click", function() {
                var thePreviewButton = $( this );
                var selectedIcon = $('#udesign-icon-fonts-select').val();
                if ( ! selectedIcon ) { alert( "Please select an icon..." ); return false; }
                displayIconPreviewContent();
                $('#udesign-preview-icon-fonts-wrapper').delay(100).fadeIn(400, function(){
                    thePreviewButton.removeClass('preview-closed').addClass('preview-opened');
                    $('#udesign-close-review-button').css("display", "block");
                 });
            });

            // close the preview popup
            $('#udesign-close-review-button a').on( "click", function() {
                $('#udesign-preview-icon-fonts-wrapper').delay(100).fadeOut(400, function(){
                        $('#preview-icon-font-btn').removeClass('preview-opened').addClass('preview-closed');
                 });
                 $('#udesign-close-review-button').css("display", "none");
            });
            // update on "inherit default color" checkbox
            $('#udesign-icon-font-color-inherit').change(function() {
                if ( $('#preview-icon-font-btn').hasClass('preview-opened') ) {
                    displayIconPreviewContent();
                }
            });
            // update on animate-change-spin checkbox
            $('#udesign-fontello-icons-animate-spin').change(function() {
                if ( $('#preview-icon-font-btn').hasClass('preview-opened') ) {
                    displayIconPreviewContent();
                }
            });
            // update on circle-wrap checkbox
            $('#udesign-fontello-icons-wrap-in-circle').change(function() {
                if ( $('#preview-icon-font-btn').hasClass('preview-opened') ) {
                    displayIconPreviewContent();
                }
            });

            // Construct the final HTML or Shortcode of a selected icon font
            function getTheIconFontCode( htmlOrShortcode ) {
                var selectedIcon = $('#udesign-icon-fonts-select').val();
                var selectedIsFontAwesome = $('#udesign-icon-fonts-select :selected').closest('optgroup').hasClass('fa-optgroup');
                var classPrefix = ( selectedIcon.substring(0, 3) === 'fa-' ) ? 'fa ' : '<?php echo $udesign_fontello_css_prefix_text; ?>';
                var iconColorInherit = ( $('#udesign-icon-font-color-inherit').is(':checked') ) ? 'inherit' : '';
                var iconColor = ( iconColorInherit === '' ) ? $('.wp-picker-input-wrap input#udesign-icon-font-color-picker-field').val() : '';
                var iconSize = $('#udesign-icon-font-size').text();
                if ( $('#udesign-fontello-icons-animate-spin').is(':checked') ) {
                    var iconAnimateSpin = ( selectedIsFontAwesome ) ? ' fa-spin' : ' animate-spin';
                } else {
                    var iconAnimateSpin = '';
                }
                var iconCircleWrap = ( $('#udesign-fontello-icons-wrap-in-circle').is(':checked') ) ? ' circle-wrap' : '';

                if ( htmlOrShortcode === 'html' ) {
                    // when html version requested:
                    iconSize = ( iconSize !== '1' ) ?  'font-size:' + iconSize + 'em;' : '';
                    var iconColorForHTML = ( iconColor !== '' ) ?  'color:' + iconColor + ';' : '';
                    var inlineStyles = ( iconColorForHTML !== '' || iconSize !== '' ) ?  ' style="' + iconColorForHTML + iconSize + '"' : '';
                    return ' <i class="' + classPrefix + selectedIcon + iconAnimateSpin + iconCircleWrap + '"' + inlineStyles + '><!-- icon --></i> ';
                }
                // when shortcode version requested:
                iconSize = ( iconSize !== '1' ) ?  ' size="' + iconSize + 'em"' : '';
                iconColor = ( iconColor !== '' ) ?  ' color="' + iconColor + '"' : '';
                return '[udesign_icon_font name="' + classPrefix + selectedIcon + iconAnimateSpin + iconCircleWrap + '"' + iconColor + iconSize + '] ';
            }
            // Display the preview content function
            function displayIconPreviewContent() {
                var htmlString = getTheIconFontCode( 'html' );
                var shortcodeString = getTheIconFontCode( 'shortcode' );
                $('#udesign-preview-icon-font').html( htmlString );
                $('#udesign-preview-icon-fonts-html').text( htmlString );
                $('#udesign-preview-icon-fonts-shortcode').text( shortcodeString );
            }

            // Handle the Insert and Cancel buttons
            $('#insert-icon-font-btn').on( "click", function() {
                var selectedIcon = $('#udesign-icon-fonts-select').val();
                if ( ! selectedIcon ) { alert( "Please select an icon..." ); return false; }

                if ( $('#udesign-fontello-icons-as-html').is(':checked') ) {
                    window.send_to_editor( getTheIconFontCode( 'html' ) );
                    return false;
                }
                window.send_to_editor( getTheIconFontCode( 'shortcode' ) );
                return false;
            });


            // Slide bar for the fonts size option
            var udesignIconFontSize = $( "#udesign-icon-font-size" );
            var udesignIconFontSizeSlider = $( "#udesign-icon-font-size-slider" );
            udesignIconFontSizeSlider.slider({
                range: "max",
                min: 0.7,
                max: 10.00,
                step: 0.1,
                value: [ udesignIconFontSize.text() ],
                slide: function( event, ui ) {
                    udesignIconFontSize.text( ui.value );
                    // update preview on the following options change if preview is opened of course
                    if ( $('#preview-icon-font-btn').hasClass('preview-opened') ) {
                        displayIconPreviewContent();
                    }
                }
            });


        });
        // ]]>
        </script>

    </div>
<?php
}
add_action('admin_footer', 'udesign_icon_fonts_popup_content');


function udesign_icon_fonts_color_picker( ) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
    
    global $wp_scripts;
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-slider');
    // get the jquery ui object
    $queryui = $wp_scripts->query('jquery-ui-core');
    // load the jquery ui theme
    $scheme = is_ssl() ? 'https://' : 'http://';
    $url = $scheme . "code.jquery.com/ui/".$queryui->ver."/themes/flick/jquery-ui.min.css";
    wp_enqueue_style('jquery-ui-smoothness', $url, false, null);
}
add_action( 'admin_enqueue_scripts', 'udesign_icon_fonts_color_picker' );





