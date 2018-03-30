<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();

$form_skin = ($style == 'modern' || $style == 'outline') ? 'contact-'.$skin.' '.$skin : '';


echo mk_get_view('global', 'shortcode-heading', true, ['title' => $title]);
?>

<div class="mk-contact-form-wrapper s_contact <?php echo $style; ?>-style s_<?php echo $style; ?> <?php echo $form_skin; ?> <?php echo $el_class; ?>">
    <form id="mk-contact-form-<?php echo $id; ?>" class="mk-contact-form clearfix" method="post" novalidate="novalidate" enctype="multipart/form-data">

        <?php
        $atts =  array(
                    'id' => ($id * 6), // Used in tab index
                    'button_text' => $button_text, 
                    'phone' => $phone, 
                    'captcha' => $captcha,
                    'email' => $email,
                    'skin' => $skin,
                    'line_button_text_color' => $line_button_text_color
                );

        echo mk_get_shortcode_view('mk_contact_form', 'styles/' . $style, true, $atts);
        ?>
    <div class="contact-form-message clearfix"></div>   
    </form>
</div>

<?php 

if($style == 'classic') {
    
    Mk_Static_Files::addCSS('
       .s_contact.s_classic .s_txt-input {
            background: url('.THEME_IMAGES.'/contact-inputs-bg.png) left top repeat-y #ffffff;
        }
    ', $id);

} else if($style == 'corporate') {
    
    $rgba = mk_hex2rgba($font_color, 0.6);

    Mk_Static_Files::addCSS( '
        .s_corporate #mk-contact-form-'.$id.' .text-input,
        .s_corporate #mk-contact-form-'.$id.' .mk-textarea {
            background-color: '.$bg_color.';
            border-color: '.$border_color.';
            color: '.$font_color.';

        }

        .s_corporate #mk-contact-form-'.$id.' ::-webkit-input-placeholder {
           color: '.$rgba.';
        }

        .s_corporate #mk-contact-form-'.$id.' :-moz-placeholder { /* Firefox 18- */
           color: '.$rgba.';
        }

        .s_corporate #mk-contact-form-'.$id.' ::-moz-placeholder {  /* Firefox 19+ */
           color: '.$rgba.';
        }

        .s_corporate #mk-contact-form-'.$id.' :-ms-input-placeholder {
           color: '.$rgba.';
        }

        .s_corporate #mk-contact-form-'.$id.' .contact-submit {
            background-color: '.$button_color.';
            color: '.$button_font_color.';
        }
        .s_corporate #mk-contact-form-'.$id.' .mk-progress-inner {
            background-color: '.$button_font_color.';
            opacity: .4;
    }', $id);

}else if ($style == 'line') {

    Mk_Static_Files::addCSS( '
        #mk-contact-form-'.$id.' .mk-form-row .text-input,
        #mk-contact-form-'.$id.' .mk-form-row .mk-textarea,
        #mk-contact-form-'.$id.' .mk-form-row .ls-text-label {
            color: '.$line_skin_color.';
        }
        #mk-contact-form-'.$id.' .mk-form-row .ls-text-label::after {
            background-color: '.$line_skin_color.';
        }
        #mk-contact-form-'.$id.' .mk-form-row .contact-submit {
            background-color: '.$line_skin_color.';
            border: 0;
        }
        #mk-contact-form-'.$id.' .mk-form-row a.captcha-change-image {
            color: '.$line_skin_color.';
        }
        .mk-contact-form-wrapper.s_line .mk-form-row .text-input:focus + .ls-text-label .ls-text-label--content,
        .mk-contact-form-wrapper.s_line .mk-form-row .mk-textarea:focus + .ls-text-label .ls-text-label--content {
            color: '.$line_skin_color.';
        }
    ', $id);

    if ($line_button_text_color == 'light' ){

        Mk_Static_Files::addCSS( '
            .s_line #mk-contact-form-'.$id.' .mk-form-row .contact-submit {
                color: #222 !important;
            }
        ', $id);

    }else if($line_button_text_color == 'dark') {

        Mk_Static_Files::addCSS( '
            .s_line #mk-contact-form-'.$id.' .mk-form-row .contact-submit {
                color: #fff !important;
            }
        ', $id);

    }
}
