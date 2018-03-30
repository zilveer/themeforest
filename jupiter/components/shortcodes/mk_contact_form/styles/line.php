
<div class="mk-form-row clearfix">

    <div class="mk-form-half s_form-all">
        <input type="text" required="required" name="name" id="name" class="text-input s_txt-input" value="" tabindex="<?php echo $view_params['id']++; ?>" />
        <label class="ls-text-label">
        <span class="ls-text-label--content"><?php _e( 'First Name*', 'mk_framework' ); ?></span>
        </label>
    </div>


    <div class="mk-form-half s_form-all">
        <input type="text" required="required" name="last_name" id="last_name" class="text-input s_txt-input" value="" tabindex="<?php echo $view_params['id']++; ?>" />
        <label class="ls-text-label">
            <span class="ls-text-label--content"><?php _e( 'Last Name*', 'mk_framework' ); ?></span>
        </label>
    </div>


</div>


<div class="mk-form-row clearfix">

    <div class="<?php echo (($view_params['phone'] == 'true')? 'mk-form-third s_form-all' : 'mk-form-half s_form-all'); ?>">
        <input type="email" data-type="email" required="required" name="email" id="email" class="text-input s_txt-input" tabindex="<?php echo $view_params['id']++; ?>" />
        <label class="ls-text-label">
            <span class="ls-text-label--content"><?php _e( 'Email*', 'mk_framework' ); ?></span>
        </label>
    </div>

    <div class="<?php echo (($view_params['phone'] == 'true')? 'mk-form-third s_form-all' : 'mk-form-half s_form-all'); ?>">
        <input type="text" name="website" id="website" class="text-input s_txt-input" value="" tabindex="<?php echo $view_params['id']++; ?>" />
        <label class="ls-text-label">
            <span class="ls-text-label--content"><?php _e( 'Website', 'mk_framework' ); ?></span>
        </label>
    </div>

    <?php if($view_params['phone'] == 'true') { ?>
        <div class="<?php echo (($view_params['phone'] == 'true')? 'mk-form-third s_form-all' : 'mk-form-half s_form-all'); ?>">
            <input type="text" name="phone" class="text-input s_txt-input two-third" tabindex="<?php echo $view_params['id']++; ?>" />
            <label class="ls-text-label">
                <span class="ls-text-label--content"><?php _e( 'Phone', 'mk_framework' ); ?></span>
            </label>
        </div>
    <?php } ?>

</div>


<div class="mk-form-row clearfix">

    <div class="mk-form-full s_form-all">
        <textarea required="required" name="content" class="mk-textarea s_txt-input" tabindex="<?php echo $view_params['id']++; ?>"></textarea>
        <label class="ls-text-label full">
             <span class="ls-text-label--content"><?php _e( 'Message*', 'mk_framework' ); ?></span>
        </label>
    </div>

</div>

<?php
if($view_params['captcha'] == 'true') { ?>
    <div class="mk-form-row">
        <div class="mk-form-full s_form-all">

            <input type="text" data-type="captcha" name="captcha" class="captcha-form text-input s_txt-input full" data-placeholder=" " required="required" autocomplete="off" tabindex="<?php echo $view_params['id']++; ?>" />
            <label class="ls-text-label"><span class="ls-text-label--content"><?php _e( 'Enter Captcha', 'mk_framework' ); ?></span></label>
                <span class="captcha-image-holder"></span>
                <span class="captcha-change-image-box"><a href="#" class="captcha-change-image"><?php _e( 'Not readable? Change text.', 'mk_framework' ); ?></a></span>
        </div>
    </div>

<?php }

$button_class = 'mk-progress-button contact-submit contact-form-button mk-button--dimension-flat mk-button--size-large skin-'.$view_params['line_button_text_color'];

echo mk_get_shortcode_view('mk_contact_form', 'components/button', true, array('tab_index' => $view_params['id']++,'button_text' => $view_params['button_text'], 'button_class' => $button_class));

echo mk_get_shortcode_view('mk_contact_form', 'components/security', true, array('id' => $view_params['id'], 'email' => $view_params['email']));